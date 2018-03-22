<?php

namespace App\Http\Controllers;

use App\Models\ArticleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tools;

class ArticleController extends Controller
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
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required'
        ]);

        $uuid = $this->tools->uuid();
        $now = $_SERVER['REQUEST_TIME'];
        $title = $request->input('title', '');
        $category_id = $request->input('category_id', '');
        if(empty($title)){
            return array(
                'success' => false,
                'msg' => '标题不能为空'
            );
        }
        if(empty($category_id)){
            return array(
                'success' => false,
                'msg' => '分类不能为空'
            );
        }
        $this->article->id = $uuid;
        $this->article->title = $title;
        $this->article->author = $request->input('author', '');
        $this->article->category_id = $category_id;
        $this->article->clicks = 0;
        $this->article->intro = $request->input('intro', '');
        $this->article->comment_id = $request->input('comment_id', '');
        $this->article->detail = $request->input('detail', '');
        $this->article->created_at = $now;
        $this->article->updated_at = $now;

        $res = $this->article->save();
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

    /**
     * 文章列表
     * @return mixed
     */
    public function all(Request $request){
        $page = $request->input('page', 1);
        $categoryId = $request->input('id', '');
        $keywords = $request->input('keywords', '');
        $pageSize = $request->input('pageSize', 10);
        $articleObj = DB::table('articles');
        if(!empty($categoryId) && $categoryId != '32AB068B-DF66-3D59-47BC-10C5F0132D52'){
            $articleObj= $articleObj->where('category_id', $categoryId);
        }
        if(!empty($keywords)){
            $articleObj = $articleObj->where('title', 'LIKE', $keywords);
        }
        $count =  $articleObj->count();
        $article = $articleObj->orderBy('updated_at', 'desc')->simplePaginate($pageSize, ['id','title','updated_at'], null, $page);
        $list = $article->toJson();
        $list = json_decode($list, true);
        $list['total'] = $count;
        foreach ($list['data'] as &$val){
            $val['date'] = date('Y-m-d H:i:s', $val['updated_at']);
        }
        return $list;
    }



    /**
     * 获取文章信息
     * @param $id
     * @return mixed
     */
    public function get($id){
        $article = \App\Models\ArticleModel::find($id);
        $info = $article->toArray();

        $article->clicks = $info['clicks'] + 1;
        $article->save();
        if(!empty($info['detail'])){

        }
        $info['time'] = date('Y-m-d H:i:s', $info['updated_at']);
        return $info;
    }
}
