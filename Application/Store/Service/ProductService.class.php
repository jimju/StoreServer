<?php
/**
 * Created by PhpStorm.
 * User: zhuzhu
 * Date: 2017/3/19
 * Time: 11:23
 */

namespace Store\Service;


use Store\Model\ProductModel;

class ProductService
{
    public function productList()
    {
        $m = new ProductModel();
        $data = $m ->  limit(5) ->select();
    }
}