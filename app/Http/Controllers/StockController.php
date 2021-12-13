<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uid)
    {
        $stocks = Stock::where('uid', $uid)->get();

        return response()->json([
            'error' => false,
            'message' => 'List Stocks',
            'data' => $stocks,
        ], 200);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required',
            'symbol' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Incomplete request',
            ], 400);
        }

        $savedStock = Stock::create([
            'uid' => $request->uid,
            'symbol' => $request->symbol,
            'description' => $request->description,
        ]);

        if ($savedStock) {
            return response()->json([
                'error' => false,
                'message' => 'Stock added to watchlist',
                'data' => $savedStock,
            ], 201);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Failed to add stock to watchlist',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $savedStock = Stock::find($id);

        if ($savedStock) {
            $savedStock->delete();

            return response()->json([
                'error' => false,
                'message' => 'Stock removed from watchlist',
            ], 200);
        }

        return response()->json([
            'error' => true,
            'message' => 'Watchlist not found',
        ], 400);
    }
}
