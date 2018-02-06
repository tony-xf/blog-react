<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/1/17
 * Time: 9:43
 */
namespace App;

class Tools{

    public function __construct(){

    }
    public function uuid($namespace = ''){
        static $guid = '';
        $uid = uniqid("", true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        //$data .= $_SERVER['LOCAL_ADDR'];
        //$data .= $_SERVER['LOCAL_PORT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = substr($hash, 0, 8) .
                '-' .
                substr($hash, 8, 4) .
                '-' .
                substr($hash, 12, 4) .
                '-' .
                substr($hash, 16, 4) .
                '-' .
                substr($hash, 20, 12);
        return $guid;
    }
}