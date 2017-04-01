<?php
namespace Store\Controller;

use Store\Service\ProductService;
use Think\Controller;
use Think\Exception;

class ProductController extends Controller
{
    public function index()
    {
//        echo "Product";
        $data["productName"] = '产品';
        $data["productNumber"] = 'CP9988666';
        $data["ProductPrice"] = 1000.00;
        echo json_encode($data);
        // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function getproduct($pageNum = 1, $pageSize = 10)
    {
        $model = M('Product');
        $json['status'] = 1;
        $json['resultCode'] = '';
        $json['message'] = '';
        $json['pageNum'] = $pageNum;
        $json['pageSize'] = $pageSize;
        $arr = array('product_name', 'product_number ', "price", "brand_price", "image");
        try {
            $json['totalNumber'] = (int)$model->count();
            $datas = $model->field($arr)->page($pageNum, $pageSize)->select();
            foreach ($datas as $data) {
                $carr['productName'] = $data['product_name'];
                $carr['productNumber'] = $data['product_number'];
                $carr['brandPrice'] = $data['brand_price'];
                $carr['image'] = $data['image'];
                $carr['test'] = $_SERVER['HTTP_HOST'];
                $jsonarr[] = $carr;
            }
            $json['data'] = $jsonarr;
        } catch (Exception $e) {
            $json['status'] = 2;
            $json['message'] = 'request error!';
        }
        echo json_encode($json);
    }

    public function getclassify($classifyLevel = 1, $parentClassifyId = -1)
    {
        $m = M('Classify');
        $json['status'] = 1;
        $json['resultCode'] = '';
        $json['message'] = '';
        try {
            $_map = array('classifyLevel=' . $classifyLevel);
            if ($parentClassifyId != -1)
                $_map = array('classifyLevel =' . $classifyLevel, 'parentClassifyId=' . $parentClassifyId);

            $json_data['data'] = $m->where($_map)->select();
            $json_data['maxLabelCount'] = 8;
            $json_data['pageNum'] = 1;
            $json_data['pageSize'] = 1000;
            $json_data['totalCount'] = (int)$m->where($_map)->count();
            $json_data['totalPage'] = 1;
            $json['data'] = $json_data;

        } catch (Exception $e) {
            $json['status'] = 2;
            $json['message'] = 'request error!';
        }
        echo json_encode($json);
    }

    public function test()
    {
//        $s = new ProductService();
//        echo json_encode($s);
        $m = D('Products');
        $data = $m -> limit(5) ->select();
        echo json_encode($data);
    }
    public function insert()
    {
        /*        $data['product_name'] = '立式十字龙头';
        $data['product_number'] = 'LSSZLT1001556651';
        $data['price'] = 99.00;
        $data['sale_price'] = 200.00;
        $data['product_price'] = 230.00;
        $data['brand_price'] = 160.00;
        $data['image'] = 'http://'.$_SERVER["SERVER_NAME"].'/think/images/pros1.jpg';*/
    }
}