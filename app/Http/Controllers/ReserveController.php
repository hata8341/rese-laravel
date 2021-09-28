<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;

class ReserveController extends Controller
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
        // $reserves = Reserve::select('id', 'user_id', 'store_id', 'datetime', 'number')
        //     ->where('datetime', $request->datetime)
        //     ->get();
        $item = Reserve::create($request->all());
        return response()->json([
            'message' => 'Reserve finished',
            'data' => $item
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $item = Reserve::where('user_id', $id)->with('store:id,store_name')->get();

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
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function checkReserve(Request $request)
    {
        $reserve = Reserve::select('id', 'store_id', 'datetime')
            ->where('store_id', $request->store_id)
            ->where('datetime', $request->datetime)
            ->exists();

        if ($reserve) {
            $result = true;
        } else {
            $result = false;
        }
        return response()->json([
            'result' => $result
        ]);
    }

    public function update(Request $request, Reserve $reserve)
    {
        $update = [
            'datetime' => $request->datetime,
            'number' => $request->number
        ];
        $item = Reserve::where('id', $reserve->id)->update($update);
        if ($item) {
            return response()->json([
                'message' => 'Updated success',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserve $reserve)
    {
        $item = Reserve::where('id', $reserve->id)->delete();
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

    public function reservedDatetime(Request $request)
    {
        $reserves = Reserve::select('id', 'store_id', 'datetime')
            ->where('store_id', $request->store_id)
            ->whereDate('datetime', $request->date)
            ->get();

        if ($reserves) {
            return response()->json([
                'message' => 'success',
                'data' => $reserves
            ], 201);
        } else {
            return response()->json([
                'message' => 'Not success'
            ], 404);
        }
    }
}