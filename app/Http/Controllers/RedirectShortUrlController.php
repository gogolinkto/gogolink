<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;

class RedirectShortUrlController extends Controller
{
    public function __invoke(ShortUrl $shortUrl)
    {
        $shortUrl->increment('visit_count', 1);
        return response()->redirectTo($shortUrl->redirect_to);
    }
}
