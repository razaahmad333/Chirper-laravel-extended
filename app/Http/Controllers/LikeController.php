<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Request $request, Chirp $chirp)
    {
        $user = $request->user();

        if ($chirp->isLikedBy($user)) {
            $chirp->likes()->where('user_id', $user->id)->delete();
            return response()->json(['liked' => false, 'likes_count' => $chirp->likes()->count()]);
        } else {
            $chirp->likes()->create(['user_id' => $user->id]);
            return response()->json(['liked' => true, 'likes_count' => $chirp->likes()->count()]);
        }
    }
}
