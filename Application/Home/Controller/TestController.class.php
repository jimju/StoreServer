<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class TestController extends Controller {
    public function index(){
        echo "1299993";
        // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
    public function test1($id = 1){
        $user = M('User');
        $u1['name'] = 'user02';
        $u1['password'] = '123';
        $u1['type'] = 'user';
//        $user ->  add($u1);
        $arr = array('_id','name','password');
        $data['name'] = 'jim';
        $json['status'] = 1;
        $json['message'] = '';
        $json['resultCode'] = '';
        try{
            $json['data'] = $user -> where('_id='.$id) -> select($arr) ;
        }catch (Exception $e){
            $json['status'] = 2;
            $json['message'] = $e;
        }
        echo json_encode($json);
    }

    public function test(){
        $data = file_get_contents('php://input');
        $json = json_decode($data);
        $url = $json -> url;
        print_r($url);

    }
}