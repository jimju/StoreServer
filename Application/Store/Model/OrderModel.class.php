<?php
/**
 * Created by PhpStorm.
 * User: zhuzhu
 * Date: 2017/3/19
 * Time: 20:27
 */

namespace Store\Model;


use Think\Model;

class OrderModel extends Model
{

    public function addOrder()
    {
        $m = M('Order');
        $in = file_get_contents('php://input');
        $json = json_decode($in);

        $data['accountId'] = $json->accountId;
        $data['address'] = $json->address;
        $data['assignments'] = json_encode($json->assignments);
        $data['channelId'] = $json->channelId;
        $data['customerName'] = $json->customerName;
        $data['customerNumber'] = $json->customerNumber;
        $data['description'] = $json->description;
        $data['distributorId'] = $json->distributorId;
        $data['isInstall'] = $json->isInstall;
        $data['orderLines'] = json_encode($json->orderLines);
        $data['orderType'] = $json->orderType;
        $data['pmName'] = $json->pmName;
        $data['pmNumber'] = $json->pmNumber;
        $data['salePerson'] = $json->salePerson;
        $data['salePersonId'] = $json->salePersonId;
        $data['shipToDate'] = $json->shipToDate;
        $data['shipToFlag'] = $json->shipToFlag;
        $data['shopId'] = $json->shopId;
        $data['shoppingCartIds'] = json_encode($json->shoppingCartIds);
        $data['status'] = $json->status;
        $data['totalPrice'] = $json->totalPrice;

        $data['orderNumber'] = $data['accountId'] . time();
        $m->add($data);

//            echo '<h2>Do not support this request!</h2>';

    }

    public function saveOrder()
    {
        $m = M('Order');
        $in = file_get_contents('php://input');
        $json = json_decode($in);

        $data['accountId'] = $json->accountId;
        $data['address'] = $json->address;
        $data['assignments'] = json_encode($json->assignments);
        $data['channelId'] = $json->channelId;
        $data['customerName'] = $json->customerName;
        $data['customerNumber'] = $json->customerNumber;
        $data['description'] = $json->description;
        $data['distributorId'] = $json->distributorId;
        $data['isInstall'] = $json->isInstall;
        $data['orderLines'] = json_encode($json->orderLines);
        $data['orderType'] = $json->orderType;
        $data['pmName'] = $json->pmName;
        $data['pmNumber'] = $json->pmNumber;
        $data['salePerson'] = $json->salePerson;
        $data['salePersonId'] = $json->salePersonId;
        $data['shipToDate'] = $json->shipToDate;
        $data['shipToFlag'] = $json->shipToFlag;
        $data['shopId'] = $json->shopId;
        $data['shoppingCartIds'] = json_encode($json->shoppingCartIds);
        $data['status'] = $json->status;
        $data['totalPrice'] = $json->totalPrice;

        $data['orderNumber'] = $json->orderNumber;
        $m->save($data);

    }
}