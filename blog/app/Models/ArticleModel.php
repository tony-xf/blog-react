<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/1/16
 * Time: 17:28
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model{
    /**
     * 表名
     * @var string
     */
    protected $table = 'article';
    /**
     * 主键类型String
     * @var
     */
    protected $keyType = 'string';

    /**
     * 添加文章
     * @param $param
     * @return array
     */
    public function insert($param){
        if(empty($param['title'])){
            return array(
                'success' => false,
                'msg' => '标题不能为空'
            );
        }
        if(empty($param['category_id'])){
            return array(
                'success' => false,
                'msg' => '文章分类不能为空'
            );
        }
        $res = $this->create($param);
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
     * 通过id查询文章信息
     * @param $id
     * @return mixed
     */
    public function select($id){
        return $this->where('id', $id)->first();
    }
}