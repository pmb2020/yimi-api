<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Menu extends BaseModel
{

    protected $guarded = [];

    public function children(): HasMany
    {
        return $this->hasMany(self::class,'p_id','id');
    }

    protected function meta(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value,true)
        );
    }

    public static function storeByRole($menuIds = [],$roleId){
        $insertData = [];
        foreach ($menuIds as $v){
            $insertData[] = ['role_id'=>$roleId,'menu_id' => $v];
        }
        DB::table('role_has_menus')->insert($insertData);
    }

    public static function getMenusByUser($admin){
        $roles = $admin->roles;
        if(count($roles) < 1){
            return [];
        }
        //暂时假定每个用户只对应一个角色
        $menuAll = self::with(['children:id,p_id,name,title,icon,component,path'])
            ->select('id','p_id','name','title','icon','component','path')
            ->where('p_id',0)
            ->get()->toArray();
        if($admin->username == 'admin'){
            $menuIds = Menu::query()->where('p_id','<>',0)->pluck('id')->toArray();
        }else{
            $menuIds = DB::table('role_has_menus')->where('role_id',13)->pluck('menu_id')->toArray();
        }
        foreach ($menuAll as $k=>&$v){
            foreach ($v['children'] as $ck=>$c){
                if(! is_numeric(array_search($c['id'],$menuIds))){
                    unset($v['children'][$ck]);
                }
            }
            if(count($v['children']) < 1){
                unset($menuAll[$k]);
            }
            if(count($v['children']) === 1 && empty($v['children']['title']) && empty($v['children']['icon'])){
                $v['id'] = $v['children'][0]['id'];
                $v['children'] = [];
            }
        }
        return array_values($menuAll);
    }
}
