<?php

use App\Models\ShortUrl;
use function Pest\Laravel\get;

it('redirects an existing short url to the desired location')
    ->hasShortUrlWith(['slug' => 'test', 'redirect_to' => 'https://gogolink.local/'])
    ->get('/test')
    ->assertRedirect('https://gogolink.local/');

it('should return 404 when short url doest not exist')
    ->get('/test')
    ->assertNotFound();
