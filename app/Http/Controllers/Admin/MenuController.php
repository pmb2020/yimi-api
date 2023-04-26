<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res1 = Menu::with('children')
            ->select('id','p_id','name','title','icon','component','path')
            ->where('p_id',0)
            ->get();
        $role = Role::find(2);
        $res = $role->menus()->orderBy('menus.sort','desc')->oldest('menus.id')->get();
        $menuArr = [];
        foreach ($res as $v){
            if($v->p_id == 0){
                $menuArr[$v->id] = [
                    'id' => $v->id,
                    'p_id' => $v->p_id,
                    'name' => $v->name,
                    'title' => $v->title,
                    'icon' => $v->icon,
                    'component' => $v->component,
                    'path' => $v->path,
                    'children' => []
                ];
            }else{
                $menuArr[$v->p_id]['children'][] = [
                    'id' => $v->id,
                    'p_id' => $v->p_id,
                    'name' => $v->name,
                    'title' => $v->title,
                    'icon' => $v->icon,
                    'component' => $v->component,
                    'path' => $v->path
                ];
            }
        }
        return apiResponse(data: $res1);
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
