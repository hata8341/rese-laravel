<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Store;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Review::create($request->all());
        return response()->json([
            'message' => 'success',
            'data' => $item
        ], 201);
    }
    public function postedReview(Request $request)
    {
        $review = Review::where('user_id', $request->user_id)
            ->where('store_id', $request->store_id)->exists();
        if ($review) {
            $state = true;
        } else {
            $state = false;
        }
        return response()->json([
            'state' => $state,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Review::where('store_id', $id)->with('user:id,user_name')->get();

        if ($item) {
            return response()->json([
                'message' => 'success',
                'data' => $item
            ], 201);
        } else {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Review $review)
    {
        $item = Review::where('id', $review->id)->delete();
        if ($item) {
            return response()->json([
                'message' => 'Deleted success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
}