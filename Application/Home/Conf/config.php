<?php
//模块配置
return array(
	//'配置项'=>'配置值'
	
    //数据库PDO配置
	"DSN"=>"mysql:host=localhost;dbname=sys",
    "DBUSER"=>"root",
    "DBPASS"=>"123456",
    "DBPORT"=>3306,
    "PDOOPTIONS"=>array(
        PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION
    ),
    
    //分页查询
    "PAGENO"=>1,
    "PAGESIZE"=>10,
    
    
);