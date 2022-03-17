<?php

namespace Tests;

use App\Models\ShortUrl;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function hasShortUrlWith(array $attributes, $count = 1): self
    {
        return tap($this, fn() => ShortUrl::factory()->times($count)->create($attributes));
    }
}
