<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function getShortenUrl(): string
    {
        return route('redirect', ['shortUrl' => $this->slug]);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
