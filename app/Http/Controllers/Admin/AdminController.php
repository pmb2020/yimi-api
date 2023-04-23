<?php

namespace App\Http\Controllers\Admin;

use App\Common\ErrorCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $res = Admin::getDataByQuery($this->getFormatRequest($request));
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
        Admin::create($params);
        return apiResponse();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Admin::query()->where('id',$id)->update(
            $this->getFormatRequest($request)
        );
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
