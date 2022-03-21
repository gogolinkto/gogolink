<?php

namespace Tests;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function actingAsTestUser()
    {
        return test()->actingAs(User::factory()->withPersonalTeam()->create());
    }

    public function hasShortUrlWith(array $attributes, $count = 1)
    {
        return test()->tap(fn() => ShortUrl::factory()->times($count)->create($attributes));
    }
}
