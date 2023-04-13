<?php

namespace App\Common;

class ErrorCode
{
    const UNAUTHORIZED = [1001,'Unauthorized'];

    const LOGIN_VERIFY_FAIL = [1002,'账号或密码错误'];

    const FORM_VERIFY_FAIL = [1003,'表单验证失败'];

    const MODELNOFOUND = [2001,'未找到该模型'];
}
