<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->only('title','status');
        $res = Banner::getDataByQuery($params);
        return apiResponse(data: $res);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        Banner::create(
            $this->getFormatRequest($request)
        );
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
        Banner::query()->where('id',$id)->update(
            $this->getFormatRequest($request)
        );
        return apiResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Banner::destroy($id);
        return apiResponse();
    }

    protected function getFormatRequest(Request $request): array
    {
        return $request->only('status','type','sort','title','link','image','note');
    }
}
