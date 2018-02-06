<?php
/**
 * author: tony_xf@foxmail.com
 * Date: 2018/2/6 15:38
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategoryModel extends Model{
    /**
     * 表名
     * @var string
     */
    protected $table = 'article_category';
    /**
     * 主键类型String
     * @var
     */
    protected $keyType = 'string';
    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}