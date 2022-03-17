<?php

use App\Models\ShortUrl;

it('should short a url and generate a custom 4 digit hash')
    ->post('/short-urls', [ 'redirect_to' => 'https://localhost/' ])
    ->assertRedirect('/short-urls')
    ->tap(fn () => expect(ShortUrl::firstOrFail())
        ->redirect_to->toBe('https://localhost/')
        ->slug->toHaveLength(4)
    );

it('should allow to create a short url with custom slug')
    ->post('/short-urls', [ 'redirect_to' => 'https://localhost/', 'slug' => 'custom' ])
    ->assertRedirect('/short-urls')
    ->tap(fn () => expect(ShortUrl::firstOrFail())->slug->toBe('custom'));

it('fails to create a short url if slug already exists')
    ->hasShortUrlWith(['slug' => 'custom'])
    ->post('/short-urls', [ 'redirect_to' => 'https://localhost/', 'slug' => 'custom' ])
    ->assertSessionHasErrors('slug');

it('fails to create a short url if redirect_to is not a url')
    ->post('/short-urls', [ 'redirect_to' => 'some_random_string' ])
    ->assertSessionHasErrors('redirect_to');
