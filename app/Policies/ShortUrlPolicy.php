<?php

namespace App\Policies;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShortUrlPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, ShortUrl $shortUrl): bool
    {
        return $user->belongsToTeam($shortUrl->team) &&
            $user->hasTeamPermission($shortUrl->team, 'delete');
    }
}
