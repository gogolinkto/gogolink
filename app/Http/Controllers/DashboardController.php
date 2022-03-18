<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Inertia\Inertia;

class DashboardController
{
    public function __invoke()
    {
        $teamId = request()->user()->currentTeam->id;

        $shortUrlCount = ShortUrl::where('team_id', $teamId)->count();
        $visitCount = ShortUrl::where('team_id', $teamId)->sum('visit_count');
        return Inertia::render('Dashboard', compact('visitCount', 'shortUrlCount'));
    }
}
