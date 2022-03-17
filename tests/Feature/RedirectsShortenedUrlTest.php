<?php

use App\Models\ShortUrl;

it('redirects an existing short url to the desired location')
    ->hasShortUrlWith(['slug' => 'test', 'redirect_to' => 'https://gogolink.local/'])
    ->get('/test')
    ->assertRedirect('https://gogolink.local/');

it('should return 404 when short url doest not exist')
    ->get('/test')
    ->assertNotFound();

it('should increment visit_count on visit /test')
    ->hasShortUrlWith(['slug' => 'test', 'redirect_to' => 'https://gogolink.local/'])
    ->tap(fn () => expect(ShortUrl::firstOrFail())->visit_count->toBe(0))
    ->get('/test')
    ->tap(fn () => expect(ShortUrl::firstOrFail())->visit_count->toBe(1));
