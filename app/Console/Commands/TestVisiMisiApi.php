<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class TestVisiMisiApi extends Command
{
    protected $signature = 'test:visi-misi-api';
    protected $description = 'Test VisiMisi API endpoints';

    public function handle()
    {
        $baseUrl = 'http://127.0.0.1:8000/api';
        
        // Test endpoint publik
        $this->info('Testing public endpoints...');
        
        // Test GET /visi-misi
        $response = Http::get($baseUrl . '/visi-misi');
        $this->info('GET /visi-misi: ' . $response->status());
        
        // Test GET /visi-misi/active
        $response = Http::get($baseUrl . '/visi-misi/active');
        $this->info('GET /visi-misi/active: ' . $response->status());
        
        // Test GET /visi-misi/1
        $response = Http::get($baseUrl . '/visi-misi/1');
        $this->info('GET /visi-misi/1: ' . $response->status());
        
        // Test dengan authentication
        $this->info('Testing protected endpoints...');
        
        // Get user dan buat token
        $user = User::first();
        if ($user) {
            $token = $user->createToken('test')->plainTextToken;
            
            // Test POST /visi-misi/1/deactivate
            $response = Http::withToken($token)->post($baseUrl . '/visi-misi/1/deactivate');
            $this->info('POST /visi-misi/1/deactivate: ' . $response->status());
            if ($response->failed()) {
                $this->error('Response: ' . $response->body());
            }
            
            // Test POST /visi-misi/1/activate
            $response = Http::withToken($token)->post($baseUrl . '/visi-misi/1/activate');
            $this->info('POST /visi-misi/1/activate: ' . $response->status());
            if ($response->failed()) {
                $this->error('Response: ' . $response->body());
            }
        } else {
            $this->error('No users found for testing');
        }
    }
}
