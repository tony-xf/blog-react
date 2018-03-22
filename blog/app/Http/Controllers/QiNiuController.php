<?php
/**
 * author: tony_xf@foxmail.com
 * Date: 2018/3/16 15:16
 */
namespace App\Http\Controllers;

use Qiniu\Auth;
use Illuminate\Http\Request;

class QiNiuController extends Controller{
    protected $auth = null;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $accessKey = 'ys6pIlaIYeqUrX9s3TZLUorKsLfdmV8y4CCmqlZv';
        $secretKey = 'Byt-2oOn32CpLZCtTNXxBfLOEl6mv-Ax5QY5fvYM';
        $this->auth = new Auth($accessKey, $secretKey);
    }

    /**
     * @return string
     */
    public function getToken(){
        $bucket = 'picture';
        // 生成上传Token
        $token = $this->auth->uploadToken($bucket);
        return $token;
    }

    /**
     * 获取图片链接
     * @param Request $request
     * @return array
     */
    public function getPicUrl(Request $request){
        $key = $request->input('key', '');
        if(empty($key)){
            return array(
                'success'=> false,
                'msg' => '图片上传失败'
            );
        }else{
            $baseUrl = 'http://p5mkv4je8.bkt.clouddn.com/'.$key;
            $url = $this->auth->privateDownloadUrl($baseUrl);
            return array(
                'success' => true,
                'url' => $url
            );
        }
    }
}