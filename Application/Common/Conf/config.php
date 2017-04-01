<?php
return array(
	//'配置项'=>'配置值'
    'URL_PARAMS_BIND'       =>  true, // URL变量绑定到操作方法作为参数
    // 开启路由
    'URL_ROUTER_ON'   => true,
    'DB_PARAMS' => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
    'MODULE_ALLOW_LIST' => array('Home','Store'),
//    'DB_SQL_BUILD_CACHE' => false,
    'URL_ROUTE_RULES'=>array(
        'test' => 'Home/Test/test',
        'product/productList' => 'Store/Product/getproduct',
        'resources/eih/baseClassify/search' => 'Store/Product/getclassify',
        'resources/eih/product/search' => 'Store/Products/productSearch',
        'resources/eih/address/search' => 'Store/Address/getAddress',
        'resources/eih/address/default' => 'Store/Address/setAddressDefault',
        'resources/eih/address' => 'Store/Address/saveOrUpdate',
        'resources/eih/order/search' => 'Store/Order/orderSearch',
        'resources/eih/order' => 'Store/Order/order',
        'resources/eih/eihBaseDistributor/search' => 'Store/Channel/getDisbutor',
        'resources/eih/eihBaseChannel/searchExt' => 'Store/Channel/getShop',
        'resources/eih/product' => 'Store/Products/product'
    ),
    //数据库配置1
        'DB_TYPE'               =>  'mysql',     // 数据库类型
        'DB_HOST'               =>  'localhost', // 服务器地址
        'DB_NAME'               =>  'eih',          // 数据库名
        'DB_USER'               =>  'root',      // 用户名
        'DB_PWD'                =>  '',          // 密码
        'DB_PORT'               =>  '3306',        // 端口
        'DB_PREFIX'             =>  'think_',    // 数据库表前缀
        'DB_CHARSET'            =>  'utf8',      // 数据库编码
        'DB_DEBUG'  =>  true, // 数据库调试模式 开启后可以记录SQL日志

    'SHOW_PAGE_TRACE' =>false,

);