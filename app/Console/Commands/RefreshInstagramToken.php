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
                            {--no-save : Do not automatically save to database}';

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
        $this->info('Refreshing Instagram access token...');
        
        $result = $instagram->refreshAccessToken();
        
        if ($result['success']) {
            $this->info('✓ Token refreshed successfully!');
            
            if (isset($result['expires_in'])) {
                $days = round($result['expires_in'] / 86400);
                $this->info("  Token expires in: {$days} days");
            }
            
            // Auto-save unless --no-save is specified
            if (!$this->option('no-save')) {
                if ($instagram->saveAccessToken($result['token'])) {
                    $this->newLine();
                    $this->info('✓ Token automatically saved to database!');
                } else {
                    $this->newLine();
                    $this->error('✗ Could not save token to database.');
                }
            } else {
                $this->newLine();
                $this->warn('⚠ Token not saved. New token:');
                $this->line($result['token']);
            }
            
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
}

