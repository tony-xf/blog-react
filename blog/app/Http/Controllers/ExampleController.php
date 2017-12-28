<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 显示指定用户的个人数据。
     * @param string $string
     * @return Response
     */
    public function hello($string){
        return 'hello '.$string;
    }
}
