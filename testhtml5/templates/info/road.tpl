<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>获取地图中心点</title>
<style type="text/css">
.autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
.Limage {
         position:fixed;
         z-index:101;
         top:0px;
         left:0px;
         width:100%;
         height:100%;
         overflow-x:hidden;
         overflow-y:auto;
         background:url(cn/img/weibo/zsc/background.png);
}


.closebutton{
        position:fixed;
        top:54px;
        width:26px;
        border:0px;
        background-color:#BEBFC3;
}





</style>

<link rel="stylesheet" type="text/css" href="http://developer.amap.com/Public/css/demo.Default.css" />
<script type="text/javascript"  src="js/jquery.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

<script type="text/javascript"  src="jquery.form.js"></script>
<script language="javascript" src="http://webapi.amap.com/maps?v=1.3&key=33fbb9c0e4b27b260ff62a5d02305aa9"></script>





<script language="javascript">
var mapObj;
//初始化地图对象，加载地图
function mapInit(){
    mapObj = new AMap.Map("iCenter");
}
//获取中心点坐标，边界经纬度坐标
function  getBound()
{
	var mapCenter = mapObj.getCenter();//获取地图中心点
    document.getElementById("centerInfo").innerHTML = "当前地图中心点坐标："+mapCenter.getLng()+","+mapCenter.getLat();
    
    
	var bounds=mapObj.getBounds();//地物对象的经纬度矩形范围。
	var northeast=bounds.getNorthEast( );//获取东北角坐标
	var sourthwest=bounds.getSouthWest( );//获取西南角坐标。LngLat类型地物对象的经纬度矩形范围。
	var lng="("+sourthwest.getLng().toString()+","+northeast.getLng().toString()+")";//经度组（西经，东经）
	var lat="("+sourthwest.getLat().toString()+","+northeast.getLat().toString()+")";//纬度组（西纬，东纬）
	
	document.getElementById("northeastInfo").innerHTML = "当前东北角坐标："+northeast.getLng()+","+northeast.getLat();
	document.getElementById("sourthwestInfo").innerHTML = "当前 西南角坐标："+sourthwest.getLng()+","+sourthwest.getLat();
	document.getElementById("lnfInfo").innerHTML = "经度组："+lng;
	document.getElementById("latInfo").innerHTML = "纬度组："+lat;
}

<script language="javascript">

function showImage(src){
        document.getElementById('showImageImg').src = src;
        document.getElementById('showImage').style.display="";
}
function closeImage(){
        document.getElementById("showImage").style.display="none"
        document.getElementById('showImageImg').src = "img/pic.png";
}

function divscroll(id){
        var _div = document.getElementById(id);
        _div.onmousewheel = function(e){  
            e = e || window.event;  
            _div.scrollTop += e.wheelDelta>0?-100:100;  
            e.returnValue=false;  
        };  
}
function download_img(url){
    //var url = url.substr(0,url.length - 4);
   // window.location.href ='admin.php?op=baseinfomgr_download&url='+url;
   window.location.href=url;
}



function ref(){
	$("#uploadform").ajaxSubmit({
		url: "searchtest.php",
		success: function(rta){
//			alert(rta);
			var rew = $('#asdf').html();
			var azxc = rew+rta;
			$('#asdf').html(azxc);
		}
	});
}



function look(inputstring){
	$("#uploadform").ajaxSubmit({
		url: "searchtest.php",
		success: function(rta){
		
	//	$('#asdf').html(rta);
		
		var objs = eval(rta);
		$('#asdf').html(rta);
		var contents="";
		for(var i=0;i<objs.length;i++)
		{
			contents=contents+"<li class='suggest_li"+(i+1)+"'>"+objs[i]+"</li>";
			
		}
			
		
			$('#suggest_ul').html(contents);
		}
	});
}

//function ref(){
//	
//	$.ajax({
//		type:'post',
//        url:"./searchtest.php",
//        data:"action=ajax",
//        success:function(data){
//        	document.getElementById("word").innerHTML=data;},
//        	 dataType:"json"
//                 })
//}
//function ref(){
////	$.ajax({ url: "http://<{$site_url}>plug/do_ajax_add", 
//	$.ajax({ url: "http://localhost/test1/searchtest.php",
//		dataType:"json",
//		type: "POST",
//		data:"action=ajax",
//		success: function(data) {
//			  alert(data);
//           //  document.getElementById("word").innerHTML=data.msg;
//             $("#suggest_input").val(data);
//        },}
//        );
//}



//setInterval(ref,120);
</script>
</head>
<body onLoad="mapInit()">

<!--<body onload="setInterval('ref()',5000)">
<img style="padding-bottom:8px;cursor:url('img/cursor_jia.cur')" id='imagei' src='img/1.small.jpg'/>
-->
<!-- <body> -->
<form id="uploadform" name="uploadform" method="POST" style="">
<input type="text" name="qwert" id="qwert" onkeyup="look(this.value);"/> 

<img style="cursor:pointer" id="image"src="img/picture.png" onClick="showImage('http://192.168.139.130/image/2013/4/17/82dc7564c9e2f523.jpg')"/> 
<span style='position:relative;top:-1px;'><a 
style="cursor:pointer;" href="http://192.168.139.130/weixin/2013/4/17/7ac569b2f236ac99.amr" ><img src="img/voice.png"/></a></span>
<span><a title="下载语音"style='color:#25690c;cursor:pointer' onclick="download_img('http://192.168.139.130/weixin/2013/4/17/7ac569b2f236ac99.amr">下载语音</a></span>

<div id="showImage" align="center" class ="Limage" style="display:none" OnMouseWheel='divscroll
("showImage")'>
         <button class="closebutton" type="button" onClick='closeImage()'><font 
color="#FFFFFF">&times;</font></button>
        <img  style="margin-top:80px;height:50%" id="showImageImg" src="img/pic.png" />
       
       
</div>                               
<ul id="suggest_ul"></ul>
<div id="asdf"></div>
<!--</div><br/><br/>
<h1>系统时间：</h1>-->

  <div id="iCenter"></div>
    <div style="padding:2px 0px 0px 5px;font-size:12px;height:40px"> 
        <input type="button" value="获取地图边界坐标组" onClick="javascript:getBound()"/> 
        <div id="northeastInfo"></div>
        <div id="centerInfo"></div>
        <div id="sourthwestInfo"></div>
        <div id="lnfInfo"></div>
        <div id="latInfo"></div>
    </div>
</form>

<div>
<input type="text" name="country" id="autocomplete"/>
</div>
</body>
</html>