<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;

class RedirectShortUrlController extends Controller
{
    public function __invoke(ShortUrl $shortUrl)
    {
        return response()->redirectTo($shortUrl->redirect_to);
    }
}
