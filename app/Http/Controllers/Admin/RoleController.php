<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = Role::query()->paginate(20)->toArray();
        $adminRoles = auth('admin')->user()->roles;
//        return Menu::getMenusByUser(auth('admin')->user());
        $res['options'] = [
            'menus' => Menu::getMenusByUser(auth('admin')->user())
        ];
        return apiResponse(data: $res);
        //根据用户获取角色
        $admin = Admin::find(1);
//        return $admin[1]->menus;
        foreach ($admin->roles as $role) {
            echo $role->pivot->created_at;
        }

        //根据角色获取菜单
        $role = Role::find(2);
        $res = $role->menus()->orderBy('menus.sort','desc')->oldest('menus.id')->get();
        $menuArr = [];
        foreach ($res as $k=>$v){
            if($v->p_id == 0){
                $v['children'] = [];
                $menuArr[$v->id] = $v;
            }else{
                $menuArr[$v->p_id]['children'] = $v;
            }
        }
//        foreach ($role->menus as $menu) {
//            echo $menu->pivot->created_at;
//        }
        return apiResponse(data: array_values($menuArr));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $this->getFormatRequest($request);
        $role=Role::create(
            $this->getFormatRequest($request)
        );
        if($role->id && $menu_ids = $request->menu_ids){
            Menu::storeByRole(explode(',',$menu_ids),$role->id);
        }
        return apiResponse(data: $role);
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
        Role::query()->where('id',$id)->update(
            $this->getFormatRequest($request)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
        return apiResponse();
    }

    protected function getFormatRequest(Request $request): array
    {
        return $request->only('name','description');
    }
}
