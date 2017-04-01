<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/28
 * Time: 11:58
 */

namespace Store\Controller;


class ChannelController
{
    public function getDisbutor($channelId = 1003)
    {
        $ojson['data'] = null;
        $ojson['status'] = 1;
        $ojson['resultCode'] = '';
        $ojson['message'] = '';

        $m = M('Distributor');
        $data = $m->where('channelId=' . $channelId)->select();
        $json_data['data'] = $data;
        $json_data['maxLabelCount'] = 8;
        $json_data['pageNum'] = 1;
        $json_data['pageSize'] = 1000;
        $json_data['totalCount'] = (int)$m->where('channelId=' . $channelId)->count();
        $json_data['totalPage'] = 1;
        $ojson['data'] = $json_data;
        echo json_encode($ojson);
    }


    public function getShop($bdrDistributorId, $bspShopId = -100)
    {
        $ojson['data'] = null;
        $ojson['status'] = 1;
        $ojson['resultCode'] = '';
        $ojson['message'] = '';

        $m = M('Shop');
        $sid = $bspShopId == -100 ? '1' : 'bspShopId=' . $bspShopId;
        $data = $m->where('bdrDistributorId=' . $bdrDistributorId, $sid)->select();
        $json_data['data'] = $data;
        $json_data['maxLabelCount'] = 8;
        $json_data['pageNum'] = 1;
        $json_data['pageSize'] = 1000;
        $json_data['totalCount'] = (int)$m->where('bdrDistributorId=' . $bdrDistributorId, $sid)->count();
        $json_data['totalPage'] = 1;
        $ojson['data'] = $json_data;
        echo json_encode($ojson);
    }

}