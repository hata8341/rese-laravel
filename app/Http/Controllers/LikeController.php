<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $store = Store::find($request->store_id);
        $store->users()->attach($request->user_id);
        $state = true;
        return response()->json([
            'state' => $state,
        ], 201);
    }

    public function destroy(Request $request)
    {
        $store = Store::find($request->store_id);
        $store->users()->detach($request->user_id);
        $state = false;
        return response()->json([
            'state' => $state,
        ], 200);
    }

    public function haslike(Request $request)
    {
        $store = Store::find($request->store_id);
        $hasLike = $store->users()->where('user_id', $request->user_id)->exists();
        if ($hasLike) {
            $state = true;
        } else {
            $state = false;
        }
        return response()->json([
            'state' => $state,
        ], 200);
    }

    public function myHaslike(Request $request)
    {
        $user = User::find($request->user_id);
        $myHasLike = $user->stores()->with(['area', 'genre'])->get();
        return response()->json([
            'data' => $myHasLike
        ], 200);
    }
}
