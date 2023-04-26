<?php

namespace App\Models;

use DateTimeInterface;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * 用户所拥有的角色
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class,'model_has_roles','model_id','role_id');
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * 根据查询条件获取数据
     * @param $params
     */
    public static function getDataByQuery($params = []): array
    {
        return self::query()->leftJoin('model_has_roles','id','=','model_id')
            ->when($params['username'] ?? '',function ($query,$username){
                return $query->where('username','like',"%{$username}%");
            })->when($params['nickname'] ?? '' ,function ($query,$nickname){
                return $query->where('nickname','like',"%{$nickname}%");
            })->when($params['tel'] ?? '' ,function ($query,$tel){
                return $query->where('tel','like',"%{$tel}%");
            })->when($params['email'] ?? '' ,function ($query,$email){
                return $query->where('email','like',"%{$email}%");
            })->when(is_numeric($params['status'] ?? ''),function ($query) use ($params) {
                return $query->where('status',$params['status']);
            })->oldest()
            ->paginate(Request('limit',20))->toArray();
    }
}
