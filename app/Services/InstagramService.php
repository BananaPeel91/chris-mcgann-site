<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class InstagramService
{
    protected string $accessToken;
    protected string $apiUrl = 'https://graph.instagram.com';
    protected int $cacheHours = 12;
    
    public function __construct()
    {
        // Get token from database
        $this->accessToken = $this->getAccessToken();
    }
    
    /**
     * Get access token from database only
     */
    protected function getAccessToken(): string
    {
        try {
            if (Schema::hasTable('settings')) {
                $dbToken = Setting::get('instagram_access_token');
                if (!empty($dbToken)) {
                    return $dbToken;
                }
            }
            
            Log::warning('No Instagram token found in database');
        } catch (\Exception $e) {
            Log::error('Database error getting Instagram token', [
                'message' => $e->getMessage(),
            ]);
        }
        
        return '';
    }
    
    /**
     * Save access token to database
     */
    public function saveAccessToken(string $token): bool
    {
        try {
            if (Schema::hasTable('settings')) {
                Setting::set('instagram_access_token', $token);
                
                // Update the current instance
                $this->accessToken = $token;
                
                return true;
            }
        } catch (\Exception $e) {
            Log::error('Failed to save Instagram token to database', [
                'message' => $e->getMessage(),
            ]);
        }
        
        return false;
    }
    
    /**
     * Refresh the long-lived access token
     * Long-lived tokens are valid for 60 days and can be refreshed
     * Run: php artisan instagram:refresh-token
     */
    public function refreshAccessToken(): array
    {
        try {
            $response = Http::get("{$this->apiUrl}/refresh_access_token", [
                'grant_type' => 'ig_refresh_token',
                'access_token' => $this->accessToken,
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['access_token'])) {
                    Log::info('Instagram access token refreshed successfully', [
                        'expires_in' => $data['expires_in'] ?? 'unknown',
                    ]);
                    
                    return [
                        'success' => true,
                        'token' => $data['access_token'],
                        'expires_in' => $data['expires_in'] ?? null,
                    ];
                }
            }
            
            Log::error('Failed to refresh Instagram token', [
                'response' => $response->json(),
            ]);
            
            return [
                'success' => false,
                'error' => $response->json()['error']['message'] ?? 'Unknown error',
            ];
            
        } catch (\Exception $e) {
            Log::error('Exception while refreshing Instagram token', [
                'message' => $e->getMessage(),
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
    
    /**
     * Get user media from Instagram
     * Cached for 12 hours to minimize API calls
     */
    public function getUserMedia(int $limit = 12): array
    {
        $cacheKey = 'instagram_media';
        $cacheSeconds = $this->cacheHours * 3600; // 12 hours = 43200 seconds
        
        return Cache::remember($cacheKey, $cacheSeconds, function () use ($limit) {
            try {
                if (empty($this->accessToken)) {
                    Log::warning('Instagram access token is empty');
                    return $this->getPlaceholderMedia($limit);
                }
                
                $response = Http::get("{$this->apiUrl}/me/media", [
                    'fields' => 'id,caption,media_type,media_url,thumbnail_url,permalink,timestamp',
                    'access_token' => $this->accessToken,
                    'limit' => $limit,
                ]);
                
                if ($response->successful()) {
                    $data = $response->json();
                    Log::info('Instagram media fetched and cached for 12 hours');
                    return $data['data'] ?? [];
                }
                
                Log::error('Failed to fetch Instagram media', [
                    'response' => $response->json(),
                ]);
                
                return $this->getPlaceholderMedia($limit);
                
            } catch (\Exception $e) {
                Log::error('Exception while fetching Instagram media', [
                    'message' => $e->getMessage(),
                ]);
                
                return $this->getPlaceholderMedia($limit);
            }
        });
    }
    
    /**
     * Get placeholder media when Instagram API is not configured
     */
    protected function getPlaceholderMedia(int $limit = 12): array
    {
        $placeholders = [];
        $descriptions = [
            'Beautiful interior painting project',
            'Exterior house transformation',
            'Kitchen cabinet refinishing',
            'Living room feature wall',
            'Commercial office painting',
            'Residential hallway refresh',
            'Bathroom renovation painting',
            'Deck staining project',
            'Bedroom accent wall',
            'Garage floor coating',
            'Fence staining and sealing',
            'Crown molding installation',
        ];
        
        for ($i = 0; $i < min($limit, 12); $i++) {
            $placeholders[] = [
                'id' => 'placeholder_' . ($i + 1),
                'caption' => $descriptions[$i] ?? 'Professional painting services',
                'media_type' => 'IMAGE',
                'media_url' => "https://picsum.photos/seed/paint{$i}/600/600",
                'permalink' => '#',
                'timestamp' => now()->subDays($i)->toIso8601String(),
                'is_placeholder' => true,
            ];
        }
        
        return $placeholders;
    }
    
    /**
     * Clear the media cache
     */
    public function clearCache(): void
    {
        Cache::forget('instagram_media');
    }
    
    /**
     * Check if the token is valid
     */
    public function isTokenValid(): bool
    {
        if (empty($this->accessToken)) {
            return false;
        }
        
        try {
            $response = Http::get("{$this->apiUrl}/me", [
                'fields' => 'id,username',
                'access_token' => $this->accessToken,
            ]);
            
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}

