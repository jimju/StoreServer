<?php
/**
 * Created by PhpStorm.
 * User: zhuzhu
 * Date: 2017/3/19
 * Time: 20:26
 */

namespace Store\Controller;


use Think\Controller;
use Think\Exception;

class OrderController extends Controller
{

    public function order()
    {
        $ojson['data'] = null;
        $ojson['status'] = 1;
        $ojson['resultCode'] = '';
        $ojson['message'] = '';
        $d = D('Order');
        try {
            if (IS_POST)
                $d->addOrder();
            elseif (IS_PUT) {
                $d->saveOrder();
            }
        } catch (Exception $e) {
            $ojson['status'] = 2;
            $ojson['resultCode'] = '';
            $ojson['message'] = '提交失败';
        }
        if (IS_GET) {
            echo '<h2>Do not support this request!</h2>';
        } else
            echo json_encode($ojson);
    }

    public function searchOrder()
    {
        $m = M('Order');
        $data = $m->select();
        foreach ($data as $k => $da) {
            foreach ($da as $k1 => $v) {
                if ($k1 == 'assignments' || $k1 == 'orderLines' || $k1 == 'shoppingCartIds') {
                    $da[$k1] = json_decode($v);
                }
            }
            $data[$k] = $da;
        }
//        $data[0]['assignments'] = json_decode($data[0]['assignments']);
        echo json_encode($data);
    }

    public function orderSearch($accountId, $orderNumber = null, $status = null, $pageNum = 1, $pageSize = 10, $hasDetailFlag = 'N')
    {
        $ojson['data'] = null;
        $ojson['status'] = 1;
        $ojson['resultCode'] = '';
        $ojson['message'] = '';
        $m = M('Order');
        $mf = M('Files');
        $where = array('accountId=' . $accountId, $status ? 'status=' . $status : '1', $orderNumber ? 'orderNumber=' . $orderNumber : '1');
        $data = $m->where($where)->page($pageNum, $pageSize)->select();
        foreach ($data as $k => $da) {
            foreach ($da as $k1 => $v) {
                if ($hasDetailFlag == 'N') {
                    if ($k1 == 'assignments') {
                        $da[$k1] = json_decode($v);
                    } elseif ($k1 == 'orderLines') {
                        $da[$k1] = null;
                    } elseif ($k1 == 'shoppingCartIds') {
                        $da[$k1] = null;
                    }
                } else {
                    if ($k1 == 'assignments') {
                        $da[$k1] = json_decode($v);
                    } elseif ($k1 == 'orderLines') {
                        $cd = json_decode($v);
                        foreach ($cd as $k2 => $v2) {
                            $ff = $mf->where('attachId=' . $v2->productId)->select();
                            $v2->fileProperties = $ff?$ff:null;
                            $cd[$k2] = $v2;
                        }
                        $da[$k1] = $cd;
                    } elseif ($k1 == 'shoppingCartIds') {
                        $da[$k1] = null;
                    }
                }
            }
            $data[$k] = $da;
        }
        $json_data['data'] = $data;
        $json_data['maxLabelCount'] = 8;
        $json_data['pageNum'] = 1;
        $json_data['pageSize'] = 1000;
        $json_data['totalCount'] = (int)$m->where('accountId=' . $accountId, $status ? 'status=' . $status : '1')->count();
        $json_data['totalPage'] = 1;
        $ojson['data'] = $json_data;
//        $data[0]['assignments'] = json_decode($data[0]['assignments']);
        echo json_encode($ojson);
    }
}