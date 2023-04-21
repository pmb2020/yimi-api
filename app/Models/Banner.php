<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Banner extends BaseModel
{
    use HasFactory;
    protected $guarded = [];

    /**
     * 返回完成图片链接
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => asset($value)
        );
    }

    /**
     * 根据查询条件获取数据
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getDataByQuery($params = []){
        return self::query()->when($params['title'] ?? '',function ($query,$title){
            return $query->where('title','like',"%{$title}%");
        })->when(is_numeric($params['status'] ?? ''),function ($query) use ($params) {
            return $query->where('status',$params['status']);
        })->paginate(Request('limit',20));
    }
}
