<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShortUrl extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function newSlug(): string
    {
        do {
            $slug = Str::random(4);
        } while(self::where('slug', $slug)->exists());

        return $slug;
    }
}
