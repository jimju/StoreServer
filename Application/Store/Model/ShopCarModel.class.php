<?php
/**
 * Created by PhpStorm.
 * User: zhuzhu
 * Date: 2017/3/19
 * Time: 20:29
 */

namespace Store\Model;


use Think\Model;

class ShopCarModel extends Model{
    public function shopcarList()
    {

    }


    public function addShopcar($json)
    {
        $data = json_decode($json);
        $m = M('ShopCar');
        $arr = array();
        for ($i = 0;$i < count($data);$i++){
            $d['promotionFlag'] = $data->promotionFlag;
            $d['Status'] = $data->Status;
            $d['ShoppingDate'] = $data->ShoppingDate;
            $d['Price'] = $data->Price;
            $d['TotalPrice'] = $data->TotalPrice;
            $d['ProductId'] = $data->ProductId;
            $d['Quantity'] = $data->Quantity;
            $arr[] = $d;
        }
        $m -> data($arr) ->add();
    }
}