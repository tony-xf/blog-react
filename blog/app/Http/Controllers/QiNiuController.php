<?php
/**
 * author: tony_xf@foxmail.com
 * Date: 2018/3/16 15:16
 */
namespace App\Http\Controllers;

use Qiniu\Auth;

class QiNiuController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getToken(){
        $accessKey = 'ys6pIlaIYeqUrX9s3TZLUorKsLfdmV8y4CCmqlZv';
        $secretKey = 'Byt-2oOn32CpLZCtTNXxBfLOEl6mv-Ax5QY5fvYM';
        $auth = new Auth($accessKey, $secretKey);
        $bucket = 'picture';
        // 生成上传Token
        $token = $auth->uploadToken($bucket);
        return $token;
    }
}