
<?php
require"main.inc.php";
require 'uploadimg.php';
// header("Content-Type:text/plain; charset=utf-8");
if ($_FILES["upfile"]) {
	$tp = array("application/octet-stream","audio/mpeg","audio/mp3","video/mpeg");//MIME类型
	$tpname = array("amr","mp3","s48");//MIME类型
	//mp2 video/mpeg  s48
    //mp3 audio/mpeg
    //amr application/octet-stream
// 	file_put_contents("/home/zcr.txt",$_FILES["upfile"]["type"]."20150504*******url\n".$_FILES["upfile"]["name"],FILE_APPEND);	
	list($maintype,$subtype)=explode("/", $_FILES["upfile"]["type"]);//获取上传文件的MIME类型中的主类型和子类型
	 
	$typenamear=explode('.', $_FILES["upfile"]["name"]);
	$typecount=count($typenamear)-1;
	$typename=$typenamear[$typecount];
	file_put_contents("/home/zcr.txt",$typename."20150505*******typename\n",FILE_APPEND);
	
	$type=$_FILES["upfile"]["type"];
	
	
// 	file_put_contents("/home/zcr.txt",$subtype."20150504*******subtype\n",FILE_APPEND);
		if ($_FILES["upfile"]["error"]>0) {
			echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' /><script language='javascript' charset='utf-8'>";			
			echo "parent.error_file(2);";		//超过大小	 
			echo"</script>";
			exit;
		}
		
		///判断文件格式是否正确Start
		$istype=true;
		if(!in_array($type,$tp)){
				
			$istype=false;
				
		}	
		if(!in_array($typename,$tpname)){
			
			$istype=false;
			
		}
// 		else {			
// 			switch ($type){
// 				case "application/octet-stream" :
// 					$istype=judgetype($_FILES["upfile"]["tmp_name"],'amr');
// 					break;
// 				case "audio/mpeg" :
// 					$istype=judgetype($_FILES["upfile"]["tmp_name"],'mp3');
// 					break;
// 				case "audio/mp3" :
// 					$istype=judgetype($_FILES["upfile"]["tmp_name"],'mp3');
// 					break;
// 				case "video/mpeg" :
// 					$istype=judgetype($_FILES["upfile"]["tmp_name"],'s48');
// 					break;
// 			}
// 		}

		 if (!$istype) {
		 	echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' /><script language='javascript' charset='utf-8'>";
	
			//echo "window.parent.document.getElementById('single_image_div".$_POST["upload_img_id"]."').style.display='none';";
			echo "parent.error_file(1);";//格式不正确
			 
			echo"</script>";
			exit;
		 }
		
		 ///判断文件格式是否正确END
		if($_FILES["upfile"]["name"]){			
			
			// 	    	file_put_contents("/home/zsc.txt","20150414zreturnsrc".$src,FILE_APPEND);	
			if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {//判断是否为上传文件
				
			if ($typename!='amr') {
// 			if ($subtype!='mp3') {
				$upfile='./upfile/'.time().'.'.$typename;//定义上传后的位置和文件名
				file_put_contents("/home/zcr.txt",$upfile."*******upfile\n",FILE_APPEND);
				if (!file_exists($upfile)) {
									
				if (!move_uploaded_file($_FILES["upfile"]["tmp_name"], $upfile)) {
					file_put_contents("/home/zcr.txt","*******movewrong\n",FILE_APPEND);
					exit;
				}
				}
				$file=transtoamr($upfile,$typename);//将音频文件转码为amr格式
				
			}else 
				$file=$_FILES["upfile"]["tmp_name"];
			
			$file=uploadImg($file);
			$file= str_replace(PHP_EOL, '', $file);
			
// 			if (file_exists($src)) {
// 				if (!unlink($src)) {
// 					file_put_contents("/home/zsc.txt","delete_error".$src,FILE_APPEND);
// 				}
// 			} 
			echo "<script language='javascript'>";
			echo "parent.error_file(3);";//上传成功
// 			echo "window.parent.document.getElementById('audioname".$_POST["upload_img_id"]."').src='".$file."';";
			echo "window.parent.document.getElementById('audioname').innerHTML='".$file."';";
			echo "</script>";
			exit;
			}else 
				exit;
		}//END IF
}
$tpl->display('upfile.tpl');
?>