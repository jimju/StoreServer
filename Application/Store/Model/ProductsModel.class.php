<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/17
 * Time: 11:13
 */

namespace Store\Model;


use Think\Model;

class ProductsModel extends Model
{
    public function productsSearch($pageNum, $pageSize, $key, $catSegment3)
    {
        $where = array($key != 'null' ? 'productName like \'%' . $key . '%\' or productNumber like \'%' . $key . '%\'' : '1',
            $catSegment3 != 'null' ? 'catSegment3=' .$catSegment3 : '1');


        $data = $this-> where($where)->page($pageNum, $pageSize)->select();

        return $data;
    }

    public function productsDetail($productHeaderId)
    {
        $data = $this-> where('`productHeaderId`='.$productHeaderId) -> find();

        return $data;
    }


    public function productsCount( $key, $catSegment3)
    {
        $where = array($key != 'null' ? 'productName like \'%' . $key . '%\' or productNumber like \'%' . $key . '%\'' : '1',
            $catSegment3 != 'null' ? 'catSegment3=' .$catSegment3 : '1');

        $data = $this-> where($where) -> count();

        return $data;
    }
}