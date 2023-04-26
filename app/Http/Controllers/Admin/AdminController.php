<?php

namespace App\Http\Controllers\Admin;

use App\Common\ErrorCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $res = Admin::getDataByQuery($this->getFormatRequest($request));

        $roles = Role::query()->select('id','name')->get()->toArray();
        $res['options'] = [
            'roles' => $roles
        ];
        return apiResponse(data: $res);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $params = $this->getFormatRequest($request);
        $params['password'] = bcrypt($params['password']);
        $params['register_ip'] = $request->getClientIp();
        $admin=Admin::create($params);
        if($admin->id && $roleId = $request->role_id){
            DB::table('model_has_roles')->insert([
               'model_id' => $admin->id,
               'model' => 'Admin',
                'role_id' => $roleId
            ]);
        }
        return apiResponse();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $params = $this->getFormatRequest($request);
        if($id == 1 && $params['username'] != 'admin'){
            return apiResponseError(ErrorCode::ADMIN_NOT_EDIT);
        }
        Admin::query()->where('id',$id)->update($params);
        if($roleId = $request->role_id){
            DB::table('model_has_roles')->updateOrInsert(['model_id'=>$id,'model'=>'Admin'],['role_id' => $roleId]);
        }
        return apiResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id == 1){
            return apiResponseError(ErrorCode::ADMIN_NOT_DEL);
        }
        Admin::destroy($id);
        return apiResponse();
    }

    protected function getFormatRequest(Request $request): array
    {
        return $request->only('status','username','password','nickname','email','tel');
    }
}
