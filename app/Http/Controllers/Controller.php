<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //这个方法只应该在接口顺利完成了对请求业务的处理之后调用
    public function response($data=null, $msg="request successful")
    {
        return response()->horesp(200, $data, $msg);
    }
}
