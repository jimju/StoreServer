<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/17
 * Time: 11:13
 */

namespace Store\Model;


use Think\Model;

class ProductModel extends Model {
    public function productss(){
        $data = $this -> limit(10) ->select();
        return $data;
    }
}