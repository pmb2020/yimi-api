<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
