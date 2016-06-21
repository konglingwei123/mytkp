<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;
class ClassController extends Controller{
    private $classModel;
    
    

    public function __construct(){
        parent::__construct();
        //直接实例化Model类，用来完成简单的增删改查操作
        //         $this->classModel = new Model("class","",C("DB_DSN"));
        $this->classModel = M("class");//new Model("class");
    }
    
    
    public function classManage(){
        $this->display();
    }
    
    /**
     * 分页查询班级列表
     * @param number $pageNo  参数绑定
     * @param number $pageSize参数绑定
     */
    public function loadClassByPage($pageNo=1, $pageSize=10,
        $className=null, $createtime1=null, $createtime2=null,
        $headerName=null, $begintime1=null, $begintime2=null,
        $managerName=null, $endtime1=null, $endtime2=null, $status=-1){
    
    
            $sql = " from class c,tb_user u1,tb_user u2 where c.headerid=u1.uid and c.managerid=u2.uid";
            //第一行
            if(null != $className){
                $sql .= " and c.name like '%$className%'";
            }
            if(null != $createtime1){
                $sql .= " and c.createTime >= '".$createtime1."'";
            }
            if(null != $createtime2){
                $sql .= " and c.createTime <= '".$createtime2."'";
            }
            //第二行
            if(null != $headerName){
                $sql .= " and u1.trueName like '%$headerName%'";
            }
            if(null != $begintime1){
                $sql .= " and c.beginTime >= '".$begintime1."'";
            }
            if(null != $begintime2){
                $sql .= " and c.beginTime <= '".$begintime2."'";
            }
            //第三行
            if(null != $managerName){
                $sql .= " and u2.trueName like '%$managerName%'";
            }
            if(null != $endtime1){
                $sql .= " and c.endTime >= '".$endtime1."'";
            }
            if(null != $endtime2){
                $sql .= " and c.endTime <= '".$endtime2."'";
            }
            //状态
            if($status > 0){
                $sql .= " and c.status = $status";
            }
    
            $count = $this->classModel->query("select count(*) as cc".$sql)[0]["cc"];
            $page["total"] = $count;
    
    
            $begin = ($pageNo-1)*$pageSize;
            $rows = $this->classModel->query("select c.cid,c.name,c.classtype,c.status,
            c.createtime,c.begintime,c.endtime,u1.truename headername,
            u2.truename managername,c.stucount,c.remark".$sql." limit $begin,$pageSize");
            $page["rows"] = $rows;
    
            $this->ajaxReturn($page);
    }
    
    
    /**
     * 检查所选班级今天是否有考试
     * @param unknown $cids 参数绑定 格式为1,2,3
     */
    public function checkExamToday($cids=null){
        $d = date("Y-m-d");
        $db = $d." 00:00:00";
        $de = $d." 23:59:59";
        $data = $this->classModel->table("exam")->where("classid in($cids) and beginTime between '$db' and '$de'")->select();
        if(count($data) > 0){
            //获取到今天有考试的班级id，用于提示哪些班有考试
            $classids = array();
            foreach($data as $exam){
                array_push($classids, $exam["classid"]);
            }
            $str = implode(",",$classids);
            //查询今天有考试的班级名称
            $cnames = $this->classModel->field("name")->where("cid in($str)")->select();
            //存放今天有考试的班级名称的数组
            $names = array();
            foreach($cnames as $n){
                array_push($names, $n["name"]);
            }
            $this->ajaxReturn("对不起，".implode(",",$names)."今天有考试，不能参与班级合并！","EVAL");
        }else{
            $this->ajaxReturn("ok","EVAL");
        }
    }
    
    public function hebingclass($cids=null,$combinedClassid=-1,$combinedHeaderid=-1,$combinedManagerid=-1){
        try{
            $this->classModel->setProperty(\PDO::ATTR_AUTOCOMMIT, false);
            $this->classModel->startTrans();//开启事务
            
            $classes = $this->classModel->table("class")->where("cid in($cids)")->select();
            foreach ($classes as $c){
                if ($c["cid"] == $combinedClassid){
                    //要保留的班级
//                     $c["headerid"] = $combinedHeaderid;
                }else {
                    //不保留的班级
                    $totalCount += $c["stucount"];
                    $c["stucount"] = 0;//被合并之后人数清零
                    $c["status"] = 2;
                    $this->classModel->save($c);
                    $sql = "update tb_user set classid=%d where classid=%d";
                    $this->classModel->execute($sql,$combinedClassid,$c["cid"]);
                }
            }
            
            //查询合并后要保留的班级信息
            $combinedClass = $this->classModel->table("class")->where("cid = %d",$combinedClassid)->find();
            $combinedClass["headerid"] = $combinedHeaderid;
            $combinedClass["managerid"] = $combinedManagerid;
            $combinedClass["stucount"] += $totalCount;
            $this->classModel->save($combinedClass);
            
            $this->classModel->commit();//提交事务
        }catch(\Exception $e){
            $this->classModel->rollback();//事务回滚到上一次提交后的数据状态
        }
        $this->loadClassByPage();
    }
    
//     //数组类型格式
//     public static $mysql =array(
//         'db_type'               =>  'mysql',     // 数据库类型
//         'db_host'               =>  'localhost', // 服务器地址
//         'db_user'               =>  'root',      // 用户名
//         'db_pwd'                =>  '123456',          // 密码
//         'db_port'               =>  '3306',        // 端口
//         'db_name'               =>  'sys',
//         'db_charset'            =>  'utf8'
//     );
    
    
//     public function __construct(){
//         parent::__construct();
// //         $this->classModel= new Model("class","",C("THINKPHP_DSN"));//字符串格式
// //             $this->classModel = new Model("class","",self::$mysql);//数组格式
//             $this->classModel = M("class","",C("THINKPHP_DSN")); //配置格式
//     }
    
//     public function loadAllClasses(){
//         $data = $this->classModel->select();
//         print_r($data);
//     }

//     public function reg(){
//         //保存一个索引数组
//         $arr = array(aa,bb,cc,dd);
//         $this->assign("arr",$arr);
        
//         //保存一个关联数组
//         $arr1 = array("11"=>"大哥","22"=>"小弟");
//         $this->assign("arr1",$arr1);
        
//         //保存一个二维数组
// //         $data = $this->classModel->where("cid>2")->select();//查询表格条件判断
//         $data = $this->classModel->select();
//         $this->assign("data",$data);
//         $this->assign("arrayLength",count($data));
//         $this->assign("msg","<b style='color:red'>对不起，没查到任何数据!</b>");
        
//         //演示模板中的运算符
//         $this->assign("j",2);
//         $this->assign("j",3);
        
        
//         $this->assign("tttt","好累累");
//         $this->display();//查找默认的模板进行展示
//         $this->display("index");//查找另一个模板进行展示
//         $this->display("User/user");//跨目录查找另一个模板进行展示
//     }

//     public function classManage(){
//         $this->display();
//     }
    
}

?>