<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/20
 * Time: 10:05
 */

namespace Store\Controller;


use Think\Controller;
use Think\Exception;

class ProductsController extends Controller
{

    public function productSearch($pageNum = 1, $pageSize = 10, $key = 'null', $catSegment3 = 'null')
    {
        $model = D('Products');
        $fm = M('Files');
        $json['status'] = 1;
        $json['resultCode'] = '';
        $json['message'] = '';
        $fa = array('aliasFileName', 'attachedDocumentId', 'documentId', 'entityName', 'existFlag', 'fileName', 'folderPath', 'lookupCode', 'lookupType', 'pageNum', 'pageSize', 'publishFlag', 'scaleExistFlag', 'scaleFileName', 'seqNum', 'url');

        try {
            $data = $model->productsSearch($pageNum, $pageSize, $key, $catSegment3);
            if($data) {
                foreach ($data as $k => $da) {
                    $fi = $fm->field($fa)->where('attachId=' . $da['productHeaderId'])->find();
                    $da['fileProperties'] = array($fi);
                    $arr[] = $da;
                }
                $json_data['data'] = $arr;
                $json_data['maxLabelCount'] = 8;
                $json_data['pageNum'] = $pageNum;
                $json_data['pageSize'] = $pageSize;
                $count = (int)$model->productsCount($key, $catSegment3);
                $json_data['totalCount'] = $count;
                $json_data['totalPage'] = (int)($count != 0 && $count % $pageSize == 0 ? $count / $pageSize : $count / $pageSize + 1);
                $json['data'] = $json_data;
            }else{
                $json['data'] = null;
            }
        } catch (Exception $e) {
            $json['status'] = 2;
            $json['message'] = 'request error!';
        }
        echo json_encode($json);

    }

    public function product($productHeaderId)
    {
        $model = D('Products');
        $fm = M('Files');
        $json['status'] = 1;
        $json['resultCode'] = '';
        $json['message'] = '';
        $json['data'] = null;
        $fa = array('aliasFileName', 'attachedDocumentId', 'documentId', 'entityName', 'existFlag', 'fileName', 'folderPath', 'lookupCode', 'lookupType', 'pageNum', 'pageSize', 'publishFlag', 'scaleExistFlag', 'scaleFileName', 'seqNum', 'url');

//        try {
        $data = $model->productsDetail($productHeaderId);
        if ($data) {
            $files = $fm->field($fa)->where('attachId=' . $productHeaderId)->select();
            $data['fileProperties'] = $files?$files:null;
            $json_data['data'] = $data;
            $json_data['maxLabelCount'] = 8;
            $json_data['pageNum'] = 1;
            $json_data['pageSize'] = 1000;

            $json_data['totalCount'] = 1;
            $json_data['totalPage'] = 1;
            $json['data'] = $json_data;

        } else {
            $json_data['totalCount'] = 0;
        }
        echo json_encode($json);
    }

}