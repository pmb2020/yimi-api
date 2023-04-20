<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends BaseModel
{

    protected $guarded = [];

    public function children(): HasMany
    {
        return $this->hasMany(self::class,'p_id','id');
    }
}
