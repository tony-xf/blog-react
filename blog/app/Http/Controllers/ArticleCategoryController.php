<?php
/**
 * Created by PhpStorm.
 * User: tony_xf@foxmail.com
 * Date: 2018/1/6
 * Time: 11:24
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleCategoryModel;
use App\Tools;

class ArticleCategoryController extends Controller{

    protected $tools = null;
    protected $articleCategory = null;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->tools = new Tools();
        $this->articleCategory = new ArticleCategoryModel;
    }
    /**
     * 添加文章分类
     * @param Request $request
     * @return array
     */
    public function add(Request $request){
        $uuid = $this->tools->uuid();
        $now = $_SERVER['REQUEST_TIME'];
        $this->articleCategory->id =  $uuid;
        $this->articleCategory->name =  $request['name'];
        $this->articleCategory->p_id =  $request['p_id'];
        $this->articleCategory->created_at =  $now;
        $this->articleCategory->updated_at =  $now;
        $res = $this->articleCategory->save();
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
     * 查询所有文章分类
     * @return array
     */
    public function all(){
        $categorys = \App\Models\ArticleCategoryModel::all();
        return $categorys->toArray();
    }

    /**
     * 通过id删除分类
     * @param $id
     * @return array
     */
    public function del($id){
        $category = \App\Models\ArticleCategoryModel::find($id);
        $res = $category->delete();
        if($res){
            $resp = array(
                'success' => $res,
                'msg' => '删除成功'
            );
        }else{
            $resp = array(
                'success' => $res,
                'msg' => '删除失败'
            );
        }
        return $resp;
    }

    /**
     * 通过id修改分类信息
     * @param $id
     * @param Request $request
     * @return array
     */
    public function edit($id, Request $request){
        $category = \App\Models\ArticleCategoryModel::find($id);
        $category->name = $request['name'];
        $category->p_id = $request['p_id'];
        $res = $category->save();
        if($res){
            $resp = array(
                'success' => $res,
                'msg' => '修改成功'
            );
        }else{
            $resp = array(
                'success' => $res,
                'msg' => '修改失败'
            );
        }
        return $resp;
    }
}