<?php
//应用配置  全局配置
return array(
	//'配置项'=>'配置值'
// 	"THINKPHP_DSN" => "mysql://root:123456@localhost:3306/sys#utf8",//字符串格式
	
    //修改默认模板目录结构为类名称_操作方法名
//     'TMPL_FILE_DEPR'=>'_',
    
    //开启路由
    'URL_ROUTER_ON'=>true,
    'URL_ROUTE_RULES'=>array(
        'ttt/:uid/:name' => "Home/Index/index",   //静态规则路由
        'login'=>"Home/User/login"
    ),
    
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'sys',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '123456',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
// //     'DB_PREFIX'             =>  '',    // 数据库表前缀
//     'DB_PARAMS'          	=>  array(), // 数据库连接参数
//     'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
//     'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
//     'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
//     'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
//     'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
//     'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
//     'DB_SLAVE_NO'           =>  '', // 指定从服务器序号
    
    
    //控制器级别设置
//     "CONTROLLER_LEVEL"=>2,
    
    //Action参数绑定
//     "URL_PARAMS_BIND" => true,
    
    //设置参数绑定方式为按顺序
//     "URL_PARAMS_BIND_TYPE" => 1
    
);