<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ShortUrlController extends Controller
{
    public function index(): \Inertia\Response
    {
        $urls = ShortUrl::where('team_id', \request()->user()->currentTeam->id)
            ->orderByDesc('id')
            ->get()
            ->map(fn ($url) => [
                'id' => $url->getKey(),
                'redirect_to' => $url->redirect_to,
                'url' => $url->getShortenUrl(),
                'visit_count' => $url->visit_count,
            ]);

        return Inertia::render('ShortUrl/Index', compact('urls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'redirect_to' => 'required|url',
            'slug' => 'sometimes|string|unique:short_urls,slug',
        ]);

        $shortUrl = new ShortUrl([
            'redirect_to' => $request->get('redirect_to'),
            'slug' => $request->get('slug', ShortUrl::newSlug()),
        ]);

        if ($request->user()) {
            $shortUrl->fill([
                'team_id' => $request->user()->currentTeam->id,
            ]);
        }

        $shortUrl->save();

        return to_route('short-urls.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShortUrl  $shortUrl
     * @return \Illuminate\Http\Response
     */
    public function show(ShortUrl $shortUrl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShortUrl  $shortUrl
     * @return \Illuminate\Http\Response
     */
    public function edit(ShortUrl $shortUrl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShortUrl  $shortUrl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShortUrl $shortUrl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShortUrl  $shortUrl
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ShortUrl $shortUrl)
    {
        $shortUrl->delete();

        return to_route('short-urls.index');
    }
}
