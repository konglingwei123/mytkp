<?php 
session_start();
// use model\MenuModel;
// require_once 'autoload.php';
// $menuModel = new MenuModel();
// //取出当前登录用户的主键uid，用来查询他拥有的那些菜单
$uid = $_SESSION['loginUser'][0];
// $secondMenu = $menuModel->loadTreeMenu($uid);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>光华软件培训欢迎您！</title>
		<meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="Public/easyui/themes/bootstrap/easyui.css"/>
		<link type="text/css" rel="stylesheet" href="Public/easyui/themes/icon.css" />
		<script type="text/javascript" src="Public/easyui/jquery.min.js"></script>
		<script type="text/javascript" src="Public/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="Public/easyui/locale/easyui-lang-zh_CN.js"></script>
		<style type="text/css">
        #top-left{
	         float: left;
        	 height:80px;
        	 width:300px;
        	 margin-left:25px;
        	 margin-top:10px;
        }
        #top-left img{
	         max-width:300px;
        	 max-height:80px;
        	 line-height:100px;
        }
        #top-right{
	        float: right;
        	height:80px;
        	width:330px;
        	margin-right:0px;
        	margin-top:12px;
        }
        #p{
	       margin-right:80px;
        }
        #logo{
        	margin-top:250px;
        	margin-left:400px;
        }
        </style>
		<script type="text/javascript">
		function addTabs(url,name){
			if($('#tabs').tabs("exists",name)){
				//如果当前选项卡已存在，则直接选中它
				$("#tabs").tabs("select",name);
			}else{
				// 添加一个未选中状态的选项卡面板
				$('#tabs').tabs('add',{
					title: name,
					selected: true,
					closable: true,
					content: "<iframe name='"+name+"' src='"+url+"' width='100%' height='100%' frameborder='0' scrolling='no'></iframe>"
				});
			}
		}
		</script>
	</head>
	<body class="easyui-layout">   
        <div data-options="region:'north',split:true,iconCls:'icon-ok',collapsible:false" style="height:100px;">
        	<div id="top-left">
        		
        	</div>
        	<div id="top-right">
        		<p style="font-size: 16px" id="p">
        			<?php 
                        if(array_key_exists("loginUser",$_SESSION)){
            			    if ($_SESSION["loginUser"][3] == 1){
            			        echo "欢迎您，校长："."<span style='color: red; font-size:16px;'>".$_SESSION["loginUser"][4]."</span>";
            			        echo "&nbsp;&nbsp;&nbsp;<a href='index.php' style='text-decoration:none;'>
                                 <span style='color: red; font-size:16px;'>退出登录</span></a>";
            			    }elseif ($_SESSION["loginUser"][3] == 2){
            			        echo "欢迎您，老师："."<span style='color: red; font-size:16px;'>".$_SESSION["loginUser"][4]."</span>";
            			        echo "&nbsp;&nbsp;&nbsp;<a href='index.php' style='text-decoration:none;'>
                                 <span style='color: red; font-size:16px;'>退出登录</span></a>";
            			    }elseif ($_SESSION["loginUser"][3] == 3){
            			        echo "欢迎您，经理："."<span style='color: red; font-size:16px;'>".$_SESSION["loginUser"][4]."</span>";
            			        echo "&nbsp;&nbsp;&nbsp;<a href='index.php' style='text-decoration:none;'>
                                 <span style='color: red; font-size:16px;'>退出登录</span></a>";
            			    }elseif ($_SESSION["loginUser"][3] == 4){
            			        echo "欢迎您，学生："."<span style='color: red; font-size:16px;'>".$_SESSION["loginUser"][4]."</span>";
            			        echo "&nbsp;&nbsp;&nbsp;<a href='index.php' style='text-decoration:none;'>
                                 <span style='color: red; font-size:16px;'>退出登录</span></a>";
            			    }
        			    }
        			?>
        		</p>
        	</div>
        </div>   
        
        <div data-options="region:'west',title:'菜单',split:true" style="width:200px;">
        	<ul id="tree" class="easyui-tree">   
				<?php 
        			if(array_key_exists("secondMenu", $_SESSION)){
        			    $secondMenu = $_SESSION["secondMenu"];
        			    foreach ($secondMenu as $menu2){
        			        echo "<li><span>{$menu2[1]}</span><ul>";
        			        foreach ($menu2[5] as $menu3){
        			            echo "<li><span><a href=\"javascript:addTabs('{$menu3[2]}','{$menu3[1]}');\">{$menu3[1]}</a></span></li>";
        			        }
        			        echo "</li></ul>";
        			    }
        			}
                ?>
            </ul> 
        </div>   
        
        <div data-options="region:'center'" style="padding:5px;background:#eee;">
        	<div id="tabs" class="easyui-tabs" data-options="fit:true">
        		<div title="欢迎" data-options="closable:true">   
                       
                </div>    
            </div>
        </div>   
    </body> 
</html>