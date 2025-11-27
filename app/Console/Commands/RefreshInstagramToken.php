<?php

namespace App\Console\Commands;

use App\Services\InstagramService;
use Illuminate\Console\Command;

class RefreshInstagramToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:refresh-token 
                            {--exchange : Exchange a short-lived token for a long-lived token}
                            {--token= : The short-lived token to exchange (used with --exchange)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the Instagram Basic Display API access token';

    /**
     * Execute the console command.
     */
    public function handle(InstagramService $instagram): int
    {
        if ($this->option('exchange')) {
            return $this->exchangeToken($instagram);
        }
        
        return $this->refreshToken($instagram);
    }
    
    /**
     * Refresh an existing long-lived token
     */
    protected function refreshToken(InstagramService $instagram): int
    {
        $this->info('Refreshing Instagram access token...');
        
        $result = $instagram->refreshAccessToken();
        
        if ($result['success']) {
            $this->info('✓ Token refreshed successfully!');
            
            if (isset($result['expires_in'])) {
                $days = round($result['expires_in'] / 86400);
                $this->info("  Token expires in: {$days} days");
            }
            
            $this->newLine();
            $this->warn('⚠ IMPORTANT: Update your .env file with the new token:');
            $this->newLine();
            $this->line("INSTAGRAM_ACCESS_TOKEN={$result['token']}");
            $this->newLine();
            
            // Clear the cache so new requests fetch fresh data
            $instagram->clearCache();
            $this->info('Instagram media cache cleared.');
            
            return Command::SUCCESS;
        }
        
        $this->error('✗ Failed to refresh token');
        $this->error("  Error: {$result['error']}");
        
        return Command::FAILURE;
    }
    
    /**
     * Exchange a short-lived token for a long-lived token
     */
    protected function exchangeToken(InstagramService $instagram): int
    {
        $shortToken = $this->option('token');
        
        if (empty($shortToken)) {
            $shortToken = $this->ask('Enter your short-lived Instagram access token');
        }
        
        if (empty($shortToken)) {
            $this->error('No token provided.');
            return Command::FAILURE;
        }
        
        $this->info('Exchanging short-lived token for long-lived token...');
        
        $result = $instagram->exchangeForLongLivedToken($shortToken);
        
        if ($result['success']) {
            $this->info('✓ Token exchanged successfully!');
            
            if (isset($result['expires_in'])) {
                $days = round($result['expires_in'] / 86400);
                $this->info("  Token expires in: {$days} days");
            }
            
            $this->newLine();
            $this->warn('⚠ IMPORTANT: Add this token to your .env file:');
            $this->newLine();
            $this->line("INSTAGRAM_ACCESS_TOKEN={$result['token']}");
            $this->newLine();
            $this->info('Then run: php artisan config:clear');
            $this->warn('Remember to set up a scheduled task to refresh this token before it expires!');
            
            return Command::SUCCESS;
        }
        
        $this->error('✗ Failed to exchange token');
        $this->error("  Error: {$result['error']}");
        
        return Command::FAILURE;
    }
}

