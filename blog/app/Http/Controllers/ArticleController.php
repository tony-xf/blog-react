<?php

namespace App\Http\Controllers;

use App\Models\ArticleModel;
use Illuminate\Http\Request;
use App\Tools;

class ExampleController extends Controller
{
    protected $tools = null;
    protected $article = null;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->tools = new Tools();
        $this->article = new ArticleModel;
    }

    /**
     * 添加文章
     * @param Request $request
     * @return array
     */
    public function add(Request $request){
        $uuid = $this->tools->uuid();
        $now = $_SERVER['REQUEST_TIME'];
        $res = $this->article->insert(array(
            'id' => $uuid,
            'title' => $request['title'],
            'author' => $request['author'],
            'category_id' => $request['category_id'],
            'clicks' => 0,
            'intro' => $request['intro'],
            'comment_id' => $request['comment_id'],
            'detail' => $request['detail'],
            'created_at' => $now,
            'updated_at' => $now
        ));
        if($res){
            $resp = array(
                'success' => $res,
                'msg' => '添加成功'
            );
        }else{
            $resp = array(
                'success' => $res,
                'msg' => '添加失败'
            );
        }
        return $resp;
    }
}
