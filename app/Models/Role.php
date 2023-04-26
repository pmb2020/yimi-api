<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends BaseModel
{
    protected $guarded = [];

    /**
     * 用户所拥有的角色
     * @return BelongsToMany
     */
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class,'role_has_menus','role_id','menu_id');
    }

    public static function getAllMenus(){

    }

}
