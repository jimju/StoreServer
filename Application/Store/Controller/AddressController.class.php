<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/27
 * Time: 11:29
 */

namespace Store\Controller;


use Think\Exception;

class AddressController
{
    public function getAddress($accountId, $assignmentType = 'ADDR', $defaultFlag = 'A', $pageNum = 1, $pageSize = 10, $status = 'VALID')
    {

        $json['data'] = array();
        $json['status'] = 1;
        $json['resultCode'] = '';
        $json['message'] = '';
        $model = M('Address');
        $_where = array('accountId=' . $accountId, 'assignmentType=\'' . $assignmentType . '\'', 'status=\'' . $status . '\'', $defaultFlag == 'A' ? '1' : 'defaultFlag=\'' . $defaultFlag . '\'');
        $sd = $model->where($_where)->order('defaultFlag  desc')->page($pageNum, $pageSize)->select();
        $json_data['data'] = $sd;
        $json_data['maxLabelCount'] = 8;
        $json_data['pageNum'] = $pageNum;
        $json_data['pageSize'] = $pageSize;
        $count = (int)$model->where($_where)->count();
        $json_data['totalCount'] = $count;
        $json_data['totalPage'] = (int)($count != 0 && $count % $pageSize == 0 ? $count / $pageSize : $count / $pageSize + 1);
        $json['data'] = $json_data;
        echo json_encode($json);
    }

    public function setAddressDefault($accountId,$assignmentId)
    {
        $json['data'] = array();
        $json['status'] = 1;
        $json['resultCode'] = '';
        $json['message'] = '';
        $model = M('Address');
        $data['defaultFlag'] = 'N';
        $model ->where( 'accountId='.$accountId)-> save($data);
        $data['defaultFlag'] = 'Y';
        $model ->where( ['accountId='.$accountId,'assignmentId='.$assignmentId])-> save($data);
        echo json_encode($json);
    }

    public function saveOrUpdate()
    {
        /**
         * "telephone": "13312875485",
         * "shipToAddr": "广西壮族自治区贺州市钟山县啦啦啦JBL大多发生的范德萨",
         * "province": "广西壮族自治区",
         * "Status": "VALID",
         * "fullName": "廖小师",
         * "assignmentId": "64449",
         * "assignmentType": "ADDR",
         * "city": "贺州市",
         * "county": "钟山县",
         * "defaultFlag": "Y",
         */
        $ojson['data'] = null;
        $ojson['status'] = 1;
        $ojson['resultCode'] = '';
        $ojson['message'] = '';
        $m = M('Address');
        $in = file_get_contents('php://input');
        $json = json_decode($in);
        $data['telephone'] = $json->telephone;
        $data['province'] = $json->province;
        $data['accountId'] = $json->accountId;
        $data['status'] = $json->status?$json->status:'VALID';
        $data['shipToAddr'] = $json->shipToAddr;
        $data['fullName'] = $json->fullName;
        if ($json->assignmentId)
            $data['assignmentId'] = $json->assignmentId;
        $data['assignmentType'] = $json->assignmentType;
        $data['city'] = $json->city;
        $data['county'] = $json->county;
        $data['defaultFlag'] = $json->defaultFlag;
        try {
            if (IS_POST) {
                $m->add($data);
            } elseif (IS_PUT) {
                $m->save($data);
            } else {
                echo 'Do not support this request!';
            }
        }catch (Exception $e){
            $ojson['status'] = 2;
            $ojson['resultCode'] = '';
            $ojson['message'] = '保存失败';
        }
        echo json_encode($ojson);
    }
}