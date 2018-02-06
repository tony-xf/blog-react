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

        $this->article->id = $uuid;
        $this->article->title = $request['title'];
        $this->article->author = $request['author'];
        $this->article->category_id = $request['category_id'];
        $this->article->clicks =  0;
        $this->article->intro = $request['intro'];
        $this->article->comment_id = $request['comment_id'];
        $this->article->detail = $request['detail'];
        $this->article->created_at =  $now;
        $this->article->updated_at =  $now;
        $res = $this->article->save();
        return $res;
    }
}
