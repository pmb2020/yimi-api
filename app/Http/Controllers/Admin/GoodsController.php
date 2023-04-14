<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoodsRequest;
use App\Models\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = Goods::query()->simplePaginate(20);
        return apiResponse(data: $res);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GoodsRequest $request)
    {
        return apiResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Goods::destroy($id);
        return apiResponse();
    }
}
