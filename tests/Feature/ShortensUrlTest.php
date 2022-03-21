<?php

use App\Models\ShortUrl;

it('should short a url and generate a custom 4 digit hash')
    ->actingAsTestUser()
    ->post('/short-urls', [ 'redirect_to' => 'https://localhost/' ])
    ->assertRedirect('/short-urls')
    ->tap(fn () => expect(ShortUrl::firstOrFail())
        ->redirect_to->toBe('https://localhost/')
        ->slug->toHaveLength(4)
        ->team_id->not()->toBeNull()
    );

it('should allow to create a short url with custom slug')
    ->actingAsTestUser()
    ->post('/short-urls', [ 'redirect_to' => 'https://localhost/', 'slug' => 'custom' ])
    ->assertRedirect('/short-urls')
    ->tap(fn () => expect(ShortUrl::firstOrFail())->slug->toBe('custom'));

it('fails to create a short url if slug already exists')
    ->actingAsTestUser()
    ->hasShortUrlWith(['slug' => 'custom'])
    ->post('/short-urls', [ 'redirect_to' => 'https://localhost/', 'slug' => 'custom' ])
    ->assertSessionHasErrors('slug');

it('fails to create a short url if redirect_to is not a url')
    ->actingAsTestUser()
    ->post('/short-urls', [ 'redirect_to' => 'some_random_string' ])
    ->assertSessionHasErrors('redirect_to');

it('should short a url associated with a team when logged in')
    ->actingAsTestUser()
    ->post('/short-urls', [ 'redirect_to' => 'https://localhost/' ])
    ->tap(fn () => expect(ShortUrl::firstOrFail())->team_id->not()->toBeNull());

test('can delete existing short url without login')
    ->tap(fn () => ShortUrl::factory()->create())
    ->delete('/short-urls/1')
    ->tap(fn () => expect(ShortUrl::count())->toBe(1));

test('can delete existing short url')
    ->actingAsTestUser()
    ->tap(fn () => ShortUrl::factory()->create(['team_id' => 1]))
    ->delete('/short-urls/1')
    ->tap(fn () => expect(ShortUrl::count())->toBe(0));
