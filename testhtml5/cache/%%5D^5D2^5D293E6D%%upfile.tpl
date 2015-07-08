132
a:4:{s:8:"template";a:1:{s:10:"upfile.tpl";b:1;}s:9:"timestamp";i:1430215327;s:7:"expires";i:1430301727;s:13:"cache_serials";a:0:{}}<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>upfile</title>


<style type="text/css">
</style>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

function upfile(){
	alert("上传");
	document.upload_form.submit();
}
function error_file(re){
var mes="";
if(re==1){
	mes="文件格式不正确";
}else if(re==2){
	mes="上传文件过大,建议上传小于6M的图片";
}else if(re==3){
	mes="文件上传成功";
}
var info='<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">'+mes+'</div></div>';
$('#showMessage').show().html(info).fadeOut(5000);
}
</script>
</head>
<body>
<form name="upload_form" id="upload_form" method="post" target="upload_frame" enctype="multipart/form-data">
<iframe id="upload_frame" name="upload_frame" style="display:none"></iframe>
<input type="hidden" name="MAX_FILE_SIZE" value="6291456">
<input type="file" id="upfile"  name="upfile" onchange="upfile();">
<input type="submit">
</form>
<div id='showMessage' style="display: none;"> </div>
<div id='audio'><img id='audioimg' src="./img/audioimg.jpg"></div>
</body>
</html>