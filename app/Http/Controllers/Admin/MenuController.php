<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = Menu::with('children')
            ->where('p_id',0)
            ->paginate(20);
        return apiResponse(data: $res);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        Menu::create(
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
    public function update(MenuRequest $request, string $id)
    {
        Menu::query()->where('id',$id)->update(
            $this->getFormatRequest($request)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Menu::destroy($id);
        return apiResponse();
    }

    protected function getFormatRequest(Request $request): array
    {
        $params = $request->only('name','path','p_id','status','description');
        $params['meta'] = json_encode([
            'title' => $request->title,
            'icon' => $request->icon
        ]);
        return $params;
    }
}
