<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\MenuModel;
class MenuController extends Controller{
    
    private $menuModel;
    
    public function __construct(){
        parent::__construct();
        $this->menuModel = new MenuModel();
    }
    
    public function menuManage(){
//         $this->assign("root",ROOT);
        $this->display();
    }
    
    
    public function loadMenuBypage($pageNo=1,$pageSize=10){
        $page = $this->menuModel->loadMenuByPage($pageNo, $pageSize);
        $this->ajaxReturn($page);
    }
    
    public function load12Menu(){
        $load = $this->menuModel->load12Menu();
        $this->ajaxReturn($load);
    }
    
    public function loadMenuByID($menuid){
        $loadBy = $this->menuModel->loadMenuByID($menuid);
        $this->ajaxReturn($loadBy);
    }
    
    public function saveOrUpdateMenu($menuid,$name, $url, $parentid, $isshow){
        if($menuid == ""){
            $update = $this->menuModel->saveOrUpdateMenu($name, $url, $parentid, $isshow, 0);
            $this->ajaxReturn("insertok","eval");
        }else{
            $update = $this->menuModel->saveOrUpdateMenu($name, $url, $parentid, $isshow, (int)$menuid);
            $this->ajaxReturn("updatetok","eval");
       }
    }
    
    
}

?>