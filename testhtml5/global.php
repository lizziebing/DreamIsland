<?php
//�趨����ѶϢ�ر��ĵȼ�
error_reporting(7);
//Returns the type of interface between web server and PHP
define('SAPI_NAME',php_sapi_name());
define('SIPSYS_DIR',"C:/wamp/www/testhtml5/");
if (!defined('SIPSYS_DIR')) define('SIPSYS_DIR',dirname(__FILE__));
date_default_timezone_set("Asia/Shanghai");
$current_time=date("F j,Y,g:i:s a");
//��ʼ���Ự·��
ini_set("session.save_path",SIPSYS_DIR.'/tmp/session');
//表情显示
useclass("weiboinfo");
$weibo_obj = new weiboinfo();
$weibo_obj->weiboinfo();

function putheader($addgeaders=1,$noheader=0,$nocacheheaders=1){
   if ($addheaders and !$noheader){
      //������������@�������������һ�� PHP ���ʽ֮ǰ���ñ��ʽ���ܲ�����κδ�����Ϣ�������Ե�
      @header("HTTP/1.0 200 OK");
      @header("HTTP/1.1 200 OK");
      @header("Content-type:text/html");
   }
   if ($nocacheheaders and !$noheader) {
      @header("Expires:Mon,26 Jul 1997 05:00:00 GMT");
      @header("Last-Modified:".gmdate("D,d M Y H:i:s")." GMT");
      @header("Cache-Control:no-store,no-cache,must-revalidate");
      @header("Cache-Control:private,post-check=0,pre-check=0",false);
      @header("Pragma:no-cache");
   }
}
function getblackSet(){
	  global $userdb;
	  $q="select value from SysParameters where  name='check_address_flag'";
      $recordSet=$userdb->Execute($q);
      $blackSet=0;
      if($recordSet){
         $blackSet=$recordSet->fields[0];
      }
      $recordSet->Close();
      return $blackSet;
}
putheader();
unset($addheaders,$noheader,$nocacheheaders);
session_start();
if(!empty($_SESSION['lang'])){  
      $template=$_SESSION['lang'];
   
}else{
	$template='cn';
}
// include_once(SIPSYS_DIR.'/'.$template."/lang/constant.inc.php");
function useclass($classname){
	global $constant;
    if(!include_once(SIPSYS_DIR."/class/class_$classname.inc.php")){
       echo $constant["global"][0].",class_$classname.inc.php ".$constant["global"][1];
       exit;
    }elseif(!class_exists($classname)){
            echo $constant["global"][0].$classname.$constant["global"][1];
            exit;
    }
    return true;
}
// include_once('config.php');
//���ò�������
useclass("CSmarty");
useclass("sipsysforms");
useclass("sipsyspowerweb");
useclass("admininfo");
useclass("admininfo");
useclass("friendlist");
//������ݿ� �û��� ����
// include_once('conn.php');
function mytime(){
   global $timezone;
   return time()+($timezone*3600);
}
$timestamp=mytime();
//�Զ�ȫ�ֱ� $_REQUEST���������� GET��POST��COOKIE �� FILE �����
global $sipforms,$adminuser,$a,$remoteAddr,$imgurl,$title,$remoteAddr;
$OpResult=array("�ɹ�","ʧ��");
$op=$_REQUEST['op'];
$action=$_REQUEST['action'];
$remoteAddr=$_SERVER['REMOTE_ADDR'];
if(!isset($GLOBALS["imgurl"])) {
   $imgurl=SIPSYS_DIR."/image/";
}

$sipforms=new sipsysforms;
$a=new sipsyspowerweb();
if(!empty($op)){
   $op=$a->textconvert($op);
}
if(!empty($op)){ $op=$a->textconvert($op);}
if(!empty($action)){ $action=$a->textconvert($action);}
$adminuser=new admininfo();
//���ϵͳ�Ƿ���
if($loadlimit > 0 && PHP_OS=='Linux') {
   $a->loadlimit($loadlimit);
}
if($enablebanning==1&&$banip!=""){
   $a->checkipban($banip);
}
unset($loadlimit,$systemactive);
$b=new admininfo;
$tpl = new CSmarty($template); 
$tpl->assign("img", $tpl->img);//˽��ͼƬ·��
$tpl->assign("jscript", $tpl->js);
$tpl->assign("css", $tpl->css);
$tpl->assign("title", $title);
$tpl->assign("version", $ippbx_version);
$tpl->assign("images", $imgurl);//ȫ��ͼƬ·��
if($action=="logout"){
        $b->logout();       
        $sipforms->finishMessage("index.php",$constant["index"][2],1,2);
        exit;
}elseif($action=="login"){
        $username=trim($_REQUEST['username']);
        $password=trim($_REQUEST['passwd']);          
        $lang=trim($_REQUEST["lang"]);   
        $authnum=$_REQUEST['authnum'];        
        if(!$lang) $lang="cn";
        $b->setcookie("lang",$lang);  
        if($b->login($username,$password,$en_text_pw)){
        	    $b->setLanguge($lang);  
                $sipforms->finishMessage("admin.php?op=admain",$constant["index"][1],1,2);
        }else{ 
        	$sipforms->error($b->ErrorMsg);
        }
        exit;
}
// ��ȡ��ǰҳ��
if( isset($_REQUEST['page'])){
   $page = intval( $_REQUEST['page']);
}else{
   $page = 1;
}
$page_size =20;
$group_guid = "0";
?>
