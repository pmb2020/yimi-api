<?php

namespace App\Common;

class ErrorCode
{
    const UNAUTHORIZED = [40001,'请先登录'];

    const LOGIN_VERIFY_FAIL = [40002,'账号或密码错误'];

    const FORM_VERIFY_FAIL = [40003,'表单验证失败'];

    const ADMIN_NOT_DEL = [41001,'admin账户禁止删除'];
    const ADMIN_NOT_EDIT = [41002,'admin账户禁止编辑'];

    const MODELNOFOUND = [50001,'未找到该模型'];
}
