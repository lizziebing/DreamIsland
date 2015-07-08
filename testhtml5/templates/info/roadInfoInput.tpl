<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Hello,world</title>
<style type="text/css">
html {
	height: 100%
}

body {
	height: 100%;
	margin: 0px;
	padding: 0px;
	text-align:center;
}
#container_body{
	width:1042px;
	margin:0,auto;
	text-align:left;
}

#top_area {
	position: relative;
	background: url(cn/img/weibo/road/bg1.png);
	background-repeat: repeat-x;
	z-index: 101;
	height: 54px;
}

.floatl {
	float: left;
}

.search_top_div {
	position: relative;
}

.search_top_div_item {
	padding-left: 0px;
	display: inline;
	float: left;
	padding-top: 10px;
}

.top_right_div_item {
	/*padding-left: 470px;*/
	display: inline;
	float: right;
	padding-top: 10px;
}

#result1 {
	position: absolute;
	z-index: 201;
	background-color: #fff;
	overflow: auto;
	width: 346px;
	border: 1px solid #dbd9da;
	margin: 0px 0 0 0px;
	display: none;
}

form {
	margin: 0;
	display: inline;
}

#r_title {
	width:476px;
	padding: 8px 0px 5px 0px;
}
#r_titlew{
	height:23px;
	width:476px;	
	margin: 8px 0px 5px 0px;
	background: url(cn/img/weibo/road/cydd.png) no-repeat;
}
#r_table {
	padding: 0px 0px 0px 0px;
}

#road_table {
	width: 480px;
	/*height:660px;  不能设置高度，快速搜索 */
	background: url(cn/img/weibo/road/bg.png);
	background-repeat: repeat-y;
	font-family: "Microsoft YaHei";
	font-size: 14px;
	color: #585858;
}

.txt300 {
	border: 1px solid #2fa603;
	width: 355px;
	font-family: "Microsoft YaHei";
	font-size: 14px;
	color: #585858;
	height: 30px;
	line-height: 30px;
	padding: 2px 5px;
	border-right: 0;
}

.txt200 {
	border: 1px solid #d2d2d2;
	width: 435px;
	font-family: "Microsoft YaHei";
	font-size: 12px;
	color: #bababa;
	height: 20px;
	line-height: 20px;
	padding: 2px 5px;
	border-right: 0;
}

input {
	outline: 0;
}

.magnifier_button {
	width: 115px;
	height: 36px;
	background: url(cn/img/weibo/road/zjcydd.png) no-repeat;
	cursor: pointer;
}

.quick_button {
	width: 30px;
	height: 26px;
	background: url(cn/img/weibo/road/icon_search.png) no-repeat;
	cursor: pointer;
}

.luru_selected {
	width: 160px;
	height: 32px;
	background: url(cn/img/weibo/road/luru_selected.png) no-repeat;
	cursor: pointer;
}

a,abbr,acronym,address,applet,article,aside,audio,b,big,blockquote,body,canvas,caption,center,cite,code,dd,del,details,dfn,div,dl,dt,em,embed,fieldset,figcaption,figure,font,footer,form,h1,h2,h3,h4,h5,h6,header,hgroup,html,i,iframe,img,input,ins,kbd,label,legend,li,mark,menu,nav,object,ol,output,p,pre,q,ruby,s,samp,section,select,small,span,strike,strong,sub,summary,sup,table,tbody,td,tfoot,th,thead,time,tr,tt,u,ul,var,video
	{
	margin: 0;
	padding: 0;
	border: 0;
	font: inherit;
	font-family: "Microsoft YaHei";
	vertical-align: baseline;
}

.clear {
	clear: both;
}

#main_left {
	width: 450px;
	height: 900px;
	float: left;
	positive:relative;
}

#main_right {
	position: relative;
	width: 540px;
	height: 900px;
	margin-left: 500px;
	
}

#container {
	height: 490px;
}

#result {
	position: absolute;
	z-index: 201;
	background-color: #fff;
	border: 1px solid #dbd9da;
	overflow: auto;
	width: 420px;
	height: 710px;
	margin: 0px 0px 0 0px;
	border-top: 0;
	display: none;
}

.delete_road_button {
	background: url(cn/img/weibo/road/delete.png) no-repeat;
	width: 16px;
	height: 16px;
	margin-right: 5px;
	margin-bottom: -3px;
	cursor: pointer;
	display: none;
}

.list_td {
	width: 202px;
	height: 30px;
	line-height: 30px;
	padding-left: 8px;
}

.selected_bg {
	width: 240px;
	height: 30px;
	background: url(cn/img/weibo/road/selected.png) no-repeat;
}

#main_below {
	
}

label {
	display: -moz-inline-block;
	display: inline-block;
	cursor: pointer;
	padding-left: 22px;
	line-height: 16px;
	background: url(cn/img/weibo/road/radio_selected.png) no-repeat left top;
}

.label_checked {
	background: url(cn/img/weibo/road/radio_selected.png) no-repeat left
		bottom;
}

#radio_id_1,#radio_id_2,#radio_id_3,#radio_id_4,#radioy_id_1,#radioy_id_2,#radioy_id_3,#radioy_id_4,#radioy_id_5
	{
	filter: alpha(opacity = 0);
	-moz-opacity: 0.0;
	-khtml-opacity: 0.0;
	opacity: 0.0;
}

#main_below {
	padding: 22px 0 5px 0px;
}

#luru_item {
	padding: 1px 0 0 0px;
}

#label_radio,#label_radioy {
	height: 28px;
	line-height: 28px;
	font-family: 'Microsoft YaHei';
	font-size: 14px;
	color: #585858;
}

#road_text {
	padding: 8px 0 0 0;
}

.roadtext_s {
	width: 530px;
	height: 82px;
	border: 1px solid #bababa;
	font-family: 'Microsoft YaHei';
	font-size: 14px;
	color: #585858;
}

#button_area {
	padding: 8px 0 0 0;
}

#b_submit {
	position: relative;
	margin-left: 127px;
	background: url(cn/img/weibo/road/submit_unselected.png) no-repeat;
	width: 78px;
	height: 30px;
	float: left;
	cursor: pointer;
}

#b_empty {
	position: relative;
	margin-left: 266px;
	background: url(cn/img/weibo/road/empty_unselected.png) no-repeat;
	width: 78px;
	height: 30px;
	cursor: pointer;
}

.shortcut {
	display: block;
	width: 50px;
	height: 22px;
	margin-top: 5px;
	background: url(cn/img/weibo/road/add_unselected.png) no-repeat;
	cursor: pointer;
}

.shortcut_add {
	display: block;
	width: 50px;
	height: 22px;
	margin-top: 5px;
	background: url(cn/img/weibo/road/add_selected.png) no-repeat;
	cursor: pointer;
}

#showMessage {
	position: fixed;
	z-index: 1000;
	top: 320px;
	left: 400px;
	overflow-x: hidden;
	overflow-y: auto;
}
</style>
<!--<link href="map.css" rel="stylesheet" type="text/css" />-->
<script src="<{$jscript}>/jquery.min.js"></script>
<script src="<{$jscript}>/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<{$jscript}>/formjs/jquery.form.js"></script>
<script language="javascript"
	src="http://webapi.amap.com/maps?v=1.3&key=7c77e30eeb5eed931e4e90e04b398137"></script>
<script language="javascript">

var mapObj;
var windowsArr = new Array(); 
var marker = new Array();

function mapInit(){
 
    mapObj = new AMap.Map("container", {
        view: new AMap.View2D({
            //center:new AMap.LngLat(123.436498,41.805331),//地图中心点
            zoom:11//地图显示的缩放级别
        }),
        keyboardEnable:false//键盘控制地图移动，地图跟随关键字移动，关键字也实时变化，选为false比较好
    });
	//加载IP定位插件
    mapObj.plugin(["AMap.CitySearch"], function() {
        //实例化城市查询类
        var citysearch = new AMap.CitySearch();
        //自动获取用户IP，返回当前城市
        citysearch.getLocalCity();
        AMap.event.addListener(citysearch, "complete", function(result){
            if(result && result.city && result.bounds) {
                var cityinfo = result.city;
                var citybounds = result.bounds;
//                alert(cityinfo);
                //地图显示当前城市
                mapObj.setBounds(citybounds);
            }
            else {
                alert(result.info);
            }
        });
        AMap.event.addListener(citysearch, "error", function(result){alert(result.info);});
    });
	
    //加载输入提示插件
    mapObj.plugin(["AMap.Autocomplete","AMap.ToolBar","AMap.OverView","AMap.Scale"], function() {
        //判断是否IE浏览器
        if (navigator.userAgent.indexOf("MSIE") > 0) {
            document.getElementById("keyword").onpropertychange = autoSearch;
        }
        else {
            document.getElementById("keyword").oninput = autoSearch;
        }
        
        //加载工具条
        tool=new AMap.ToolBar({
        	direction:true,//隐藏方向导航
        	ruler:true,//隐藏视野级别控制尺
        	autoPosition:true//禁止自动定位
        });
        mapObj.addControl(tool);
//        //加载鹰眼
//        view=new AMap.OverView();
//        mapObj.addControl(view);
//        //加载比例尺
//        scale=new AMap.Scale();
//        mapObj.addControl(scale);
    });
    
    //叠加实时路况图层
     trafficLayer = new AMap.TileLayer.Traffic({zIndex:10}); //实时路况图层
     trafficLayer.setMap(mapObj);
     
}

//关键字查询
function kwdDirectSearch(){
	var kwds = document.getElementById("keyword").value;
    document.getElementById("result1").style.display = "none";
	//根据输入的关键字进行查询
    mapObj.plugin(["AMap.PlaceSearch"], function() {       
        var msearch = new AMap.PlaceSearch();  //构造地点查询类
        AMap.event.addListener(msearch, "complete", placeSearch_CallBack); //查询成功时的回调函数
        msearch.search(kwds);  //关键字查询查询
    });
}

 
//输入提示
function autoSearch() {
    var keywords = document.getElementById("keyword").value;
    var auto; 
    var autoOptions = {
        pageIndex:1,
        pageSize:10,
        city: "024" //城市，默认沈阳
    };
    auto = new AMap.Autocomplete(autoOptions);
    //查询成功时返回查询结果
    AMap.event.addListener(auto, "complete", autocomplete_CallBack);
    auto.search(keywords);
}
 
//输出输入提示结果的回调函数
function autocomplete_CallBack(data) {
    var resultStr = "";
    var tipArr = data.tips;
    if (tipArr&&tipArr.length>0) {                 
        for (var i = 0; i < tipArr.length; i++) {
            resultStr += "<div id='divid" + (i + 1) + "' onmouseover='openMarkerTipById(" + (i + 1)
                        + ",this)' onclick='selectResult(" + i + ")' onmouseout='onmouseout_MarkerStyle(" + (i + 1)
                        + ",this)' style=\"font-size: 13px;cursor:pointer;padding:5px 5px 5px 5px;\">" + tipArr[i].name + "<span style='color:#C1C1C1;'>"+ tipArr[i].district + "</span></div>";
        }
    }
    else  {
        resultStr = " π__π 亲,人家找不到结果!<br />要不试试：<br />1.请确保所有字词拼写正确<br />2.尝试不同的关键字<br />3.尝试更宽泛的关键字";
    }
    document.getElementById("result1").curSelect = -1;
    document.getElementById("result1").tipArr = tipArr;
    document.getElementById("result1").innerHTML = resultStr;
    document.getElementById("result1").style.display = "block";
    //阻止消息上传
    event.cancelBubble=true;
}
 
//输入提示框鼠标滑过时的样式
function openMarkerTipById(pointid, thiss) {  //根据id打开搜索结果点tip 
    thiss.style.background = '#CAE1FF';
}
 
//输入提示框鼠标移出时的样式
function onmouseout_MarkerStyle(pointid, thiss) {  //鼠标移开后点样式恢复 
    thiss.style.background = "";
}
 
//从输入提示框中选择关键字并查询
function selectResult(index) {
    if(index<0){
        return;
    }
    if (navigator.userAgent.indexOf("MSIE") > 0) {
        document.getElementById("keyword").onpropertychange = null;
        document.getElementById("keyword").onfocus = focus_callback;
    }
    //截取输入提示的关键字部分
    var text = document.getElementById("divid" + (index + 1)).innerHTML.replace(/<[^>].*?>.*<\/[^>].*?>/g,"");;
    document.getElementById("keyword").value = text;
    document.getElementById("result1").style.display = "none";
    //根据选择的输入提示关键字查询
    mapObj.plugin(["AMap.PlaceSearch"], function() {       
        var msearch = new AMap.PlaceSearch();  //构造地点查询类
        AMap.event.addListener(msearch, "complete", placeSearch_CallBack); //查询成功时的回调函数
        msearch.search(text);  //关键字查询查询
    });
}
 
//定位选择输入提示关键字
function focus_callback() {
    if (navigator.userAgent.indexOf("MSIE") > 0) {
        document.getElementById("keyword").onpropertychange = autoSearch;
   }
}
 
//输出关键字查询结果的回调函数 - 左边的搜索结果
function placeSearch_CallBack(data) {
    //清空地图上的InfoWindow和Marker
    windowsArr = [];
    marker     = [];
    mapObj.clearMap();
    var resultStr1 = "";
    var poiArr = data.poiList.pois;
    var resultCount = poiArr.length; //搜索结果数目
    resultStr1 += "<div style=\"padding:8px 0 8px 5px;\"><div><table width=\"100%\"><tr><td width=\"60%\" align=\"left\"><h3 style=\"height:24px;\"><font color=\"#2fa603\" style=\"font-family:'Microsoft YaHei';font-size:15px;font-weight:700;\">" + resultCount + "条结果</font></h3></td><td width=\"40%\" align=\"right\"><img src=\"cn/img/weibo/road/close.png\" style=\"margin-right:10px;cursor:pointer;\" onclick=\"doClearSearch()\"></td></tr></table></div></div>";
    for (var i = 0; i < resultCount; i++) {
//    	alert(i);
        resultStr1 += "<div id='divid" + i + "' onmouseover='openMarkerTipById1(" + i + ",this)' onmouseout='onmouseout_MarkerStyle(" + (i + 1) + ",this)' onclick=\"openInfoWindow(" + i + ",this);getMarkInfo('"+poiArr[i].id+"','"+poiArr[i].name+"','"+poiArr[i].location+"',this);\" style=\"padding:8px 0 8px 5px;\"><div><table><tr><td><img src=\"cn/img/weibo/road/" + (i + 1) + ".png\" style=\"margin-top:2px;\"></td>" + "<td width=\"3px\"></td><td><h3 style=\"height:24px;\"><font id=\"ssjg"+i+"\" color=\"#585858\" style=\"font-family:'Microsoft YaHei';font-size:14px;\">" + poiArr[i].name + "</font></h3>";
//            resultStr1 += TipContents(poiArr[i].type, poiArr[i].address, poiArr[i].tel) + "</td></tr></table></div>";
            resultStr1 += "<font color=\"#585858\" style=\"font-family:'Microsoft YaHei';font-size:12px;\">" + TipContents(poiArr[i].type, poiArr[i].address, poiArr[i].tel) + "</font></td></tr></table></div></div>";
            addmarker(i, poiArr[i]);
//            alert(poiArr[i].location); //经纬度
    }
    mapObj.setFitView();
    document.getElementById("result").innerHTML = resultStr1;
    document.getElementById("result").style.display = "block";
}

//点击搜索结果的关闭按钮 - 关闭搜索结果，清空地图标记
function doClearSearch(){
	document.getElementById("result").style.display="none";
	windowsArr = [];
    marker     = [];
    mapObj.clearMap();
}

//鼠标滑过查询结果改变背景样式，根据id打开信息窗体
function openMarkerTipById1(pointid, thiss) {
    thiss.style.background = '#F5F5F5';
//    document.getElementById("divid"+pointid).style.background = '#F5F5F5';
    //    windowsArr[pointid].open(mapObj, marker[pointid]);
} 
var fontzy=0;
//鼠标点击查询结果改变背景样式，根据id打开信息窗体
function openInfoWindow(pointid, thiss) {
//	alert(pointid);
    document.getElementById("divid"+pointid).style.backgroundColor = '#F5F5F5';
    windowsArr[pointid].open(mapObj, marker[pointid]);
    if(pointid!=fontzy){
    	$("#ssjg"+fontzy).css({"color":"#585858"});
    	$("#ssjg"+pointid).css({"color":"#2fa603"});
    	fontzy=pointid;
    }else{
    	$("#ssjg"+pointid).css({"color":"#2fa603"});
    }
}

function getMarkInfo(id, name, location, thiss){
//	alert(name);
	document.getElementById("roadtext").value=""; //清空textarea
	document.getElementById("roadid_p").value=id; 
	document.getElementById("roadname_p").value=name; 
	document.getElementById("roadposi_p").value=location; 
	//document.getElementById("roadtext").value=name+"，"; //给textarea赋值
	comRInfo();
}

//添加查询结果的marker&infowindow - 给地图上
function addmarker(i, d) {
    var lngX = d.location.getLng();
    var latY = d.location.getLat();
    var markerOption = {
        map:mapObj,
        icon:"cn/img/weibo/road/s" + (i + 1) + ".png",
        position:new AMap.LngLat(lngX, latY)
    };
    var mar = new AMap.Marker(markerOption);         
    marker.push(new AMap.LngLat(lngX, latY));
 
    var infoWindow = new AMap.InfoWindow({
        content:"<div style=\"padding:0px 0 4px 2px;margin-left:5px;\"><table width=\"290px\"><tr><td><h3 style=\"height:24px;\"><font color=\"#585858\" style=\"font-family:'Microsoft YaHei';font-size:14px;\">" + d.name + "</font></h3><font color=\"#585858\" style=\"font-family:'Microsoft YaHei';font-size:12px;\">" + TipContents(d.type, d.address, d.tel) + "</font></td></tr><tr><td align=\"center\"><a class=\"shortcut\" id=\"shortcut_"+d.id+"\" title=\"添加到常用路段\" href=\"javascript:doAddRoad('"+d.id+"','"+d.name+"','"+d.location+"');\"></a></td></tr></table></div>",
        size:new AMap.Size(300, 0),
        autoMove:true, 
        offset:new AMap.Pixel(0,-30)
    });
    windowsArr.push(infoWindow);
    var aa = function (e) {infoWindow.open(mapObj, mar.getPosition());};
    AMap.event.addListener(mar, "click", aa);
}

//添加路段
function doAddRoad(id,name,location){
	$.getJSON("admin.php?op=baseinfomgr_roadInfoInput&action=addCommonRoad",{rid:id,roadname:name,position:location},function(data){
//		alert(data);
		if(data=="success"){
			$('#shortcut_'+id).removeClass("shortcut").addClass("shortcut_add");
			$.get("admin.php?op=baseinfomgr_roadInfoInput&action=quickSearch",{},function(data){

				$('#r_table').html(data);
				});
		}else{
//			alert("添加失败");
			$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">添加失败</div></div>').fadeOut(1500);
		}
	});
}
 
//infowindow显示内容
function TipContents(type, address, tel) {  //窗体内容
    if (type == "" || type == "undefined" || type == null || type == " undefined" || typeof type == "undefined") {
        type = "暂无";
    }
    if (address == "" || address == "undefined" || address == null || address == " undefined" || typeof address == "undefined") {
        address = "暂无";
    }
    if (tel == "" || tel == "undefined" || tel == null || tel == " undefined" || typeof address == "tel") {
        tel = "暂无";
    }
//    var str = "  地址：" + address + "<br />  电话：" + tel + " <br />  类型：" + type;
    var str = "地址：" + address;
    return str;
}
function keydown(event){
    var key = (event||window.event).keyCode;
    var result = document.getElementById("result1")
    var cur = result.curSelect;
    if(key===40){//down
        if(cur + 1 < result.childNodes.length){
            if(result.childNodes[cur]){
                result.childNodes[cur].style.background='';
            }
            result.curSelect=cur+1;
            result.childNodes[cur+1].style.background='#CAE1FF';
            document.getElementById("keyword").value = result.tipArr[cur+1].name;
        }
    }else if(key===38){//up
        if(cur-1>=0){
            if(result.childNodes[cur]){
                result.childNodes[cur].style.background='';
            }
            result.curSelect=cur-1;
            result.childNodes[cur-1].style.background='#CAE1FF';
            document.getElementById("keyword").value = result.tipArr[cur-1].name;
        }
    }else if(key === 13){
        selectResult(document.getElementById("result1").curSelect);
    }
}
var froad=0; //上一次选中的路段ID编号
//选中某一路段 样式变换
function select_road(x,id,name,posi){
	
	document.getElementById("roadid_p").value=id; 
	document.getElementById("roadname_p").value=name; 
	document.getElementById("roadposi_p").value=posi; 
	if(x!=froad){
		document.getElementById("roadtext").value=""; //清空textarea
		$("#table_road"+froad).removeClass("selected_bg");
		$("#table_road"+x).addClass("selected_bg");
		//document.getElementById("roadtext").value=name+"，"; //给textarea赋值
		comRInfo();
		froad=x;
	}
}
//组合路况信息zhb
function comRInfo(){
	var roadname_p = document.getElementById("roadname_p").value; 
	var roaddire_p = document.getElementById("roaddire_p").value;
	var roadsitu_p = document.getElementById("roadsitu_p").value;
    var dire="";
    var situ="";
	if(roaddire_p=='01'){
		var dire = '由东向西，';
	}else if(roaddire_p=='02'){
		var dire = '由西向东，';
	}else if(roaddire_p=='03'){
		var dire = '由南向北，';
	}else if(roaddire_p=='04'){
		var dire = '由北向南，';
	}

	if(roadsitu_p=='01'){
		var situ = '畅通！';
	}else if(roadsitu_p=='02'){
		var situ = '缓行！';
	}else if(roadsitu_p=='03'){
		var situ = '拥堵！';
	}else if(roadsitu_p=='04'){
		var situ = '事故！';
	}else if(roadsitu_p=='05'){
		var situ = '禁行！';
	}
	document.getElementById("roadtext").value=roadname_p+","+dire+situ;
}

function direction(x){
	document.getElementById("roaddire_p").value=x;
	comRInfo();
// 	if(x=='01'){
// 		var dire = '由东向西，';
// 	}else if(x=='02'){
// 		var dire = '由西向东，';
// 	}else if(x=='03'){
// 		var dire = '由南向北，';
// 	}else if(x=='04'){
// 		var dire = '由北向南，';
// 	}
// 	document.getElementById("roadtext").value+=dire; //给textarea赋值
}
function situation(x){
	document.getElementById("roadsitu_p").value=x;
	comRInfo();
// 	if(x=='01'){
// 		var dire = '畅通！';
// 	}else if(x=='02'){
// 		var dire = '缓行！';
// 	}else if(x=='03'){
// 		var dire = '拥堵！';
// 	}else if(x=='04'){
// 		var dire = '事故！';
// 	}else if(x=='05'){
// 		var dire = '禁行！';
// 	}
// 	document.getElementById("roadtext").value+=dire; //给textarea赋值
}
function addRoadInfo(){
	var roadid_p = document.getElementById("roadid_p").value; 
	var roadname_p = document.getElementById("roadname_p").value; 
	var roadposi_p = document.getElementById("roadposi_p").value;
	var roaddire_p = document.getElementById("roaddire_p").value;
	var roadsitu_p = document.getElementById("roadsitu_p").value;
	var roadtext_p = document.getElementById("roadtext").value;
//如果选择信息不全，对其分类加以提醒zhb
	if(roadname_p=="")
		{
		$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">请选择路段</div></div>').fadeOut(1500);
        return false;
		}
	 if(roaddire_p=="")
			{
			$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">请选择方向</div></div>').fadeOut(1500);
			return false;
			}
	 if(roadsitu_p=="")
			{
				$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">请选择拥堵情况</div></div>').fadeOut(1500);
				return false;
				}
	
	$.getJSON("admin.php?op=baseinfomgr_roadInfoInput&action=addRoadInfo",{roadname:roadname_p,position:roadposi_p,direction:roaddire_p,situation:roadsitu_p,roadtext:roadtext_p},function(data){
//		alert(data);
		if(data=="success"){
//			alert("提交成功");
			$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">提交成功</div></div>').fadeOut(1500);
		}else{
// 			alert("提交失败");
			$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">提交失败</div></div>').fadeOut(1500);
		}
	});
}
function doEmpty(){
	//zhb
    var labels = document.getElementById("label_radio").getElementsByTagName("label");
	var radios = document.getElementById("label_radio").getElementsByTagName("input");
			
	for(var j=0;j<labels.length;j++){
		labels[j].className = "";
		radios[j].checked = false;
		}
							
	var labelsy = document.getElementById("label_radioy").getElementsByTagName("label");
	var radiosy = document.getElementById("label_radioy").getElementsByTagName("input");	
				for(var j=0;j<labelsy.length;j++){
					labelsy[j].className = "";
					radiosy[j].checked = false;
				}
				document.getElementById("roadtext").value="";
				
			    document.getElementById("roaddire_p").value="";
			    document.getElementById("roadsitu_p").value="";
			    document.getElementById("roadname_p").value=""; 				
}
function changeFace(x){
	if(x==0){
		window.location.href="admin.php?op=baseinfomgr_roadInfoList";
	}else{
		window.location.href="admin.php?op=baseinfomgr_roadInfoInput";
	}
}
function before_delete(x,id){
   var is_confirmed=confirm("您确定删除该路段吗？");
   if(is_confirmed){
      $.getJSON("admin.php?op=baseinfomgr_roadInfoInput&action=delCommomRoad",{rid:id},function(data){
		if(data=="success"){
//			alert("删除成功");
			$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">删除成功</div></div>').fadeOut(1500);
			window.location.href="admin.php?op=baseinfomgr_roadInfoInput";
//			 location.reload("admin.php?op=baseinfomgr_roadInfoInput");
		}else{
//			alert("删除失败");
			$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">删除失败</div></div>').fadeOut(1500);
		}
      });
   }else{
      return false;
   }
} 
function changeRadio(){
	var labels = document.getElementById("label_radio").getElementsByTagName("label");
	var radios = document.getElementById("label_radio").getElementsByTagName("input");
	for(var i=0;i<labels.length;i++){
		labels[i].onclick=function(){
			if(this.className==""){
				for(var j=0;j<labels.length;j++){
					labels[j].className = "";
					radios[j].checked = false;
				}
				this.className='label_checked';
				try{
					document.getElementById(this.name).checked = true;
				} catch (e) {}
			}
		}
	}
	
	var labelsy = document.getElementById("label_radioy").getElementsByTagName("label");
	var radiosy = document.getElementById("label_radioy").getElementsByTagName("input");
	for(var i=0;i<labelsy.length;i++){
		labelsy[i].onclick=function(){
			if(this.className==""){
				for(var j=0;j<labelsy.length;j++){
					labelsy[j].className = "";
					radiosy[j].checked = false;
				}
				this.className='label_checked';
				try{
					document.getElementById(this.name).checked = true;
				} catch (e) {}
			}
		}
	}
	
}

var ys_kwd = "";
function queryCommon(){
	var x_kwd = document.getElementById("quickkwd").value;
	if(x_kwd != ys_kwd){
		$("#uploadform").ajaxSubmit({
			url: "admin.php?op=baseinfomgr_roadInfoInput&action=quickSearch",
			success: function(rta){
				//alert(rta);
				$('#r_table').html(rta);
			}
		});
		ys_kwd = x_kwd;
	}
}

//常用路段快速查找 - 异步处理
function quickSearch(){
	setTimeout("queryCommon()", 1000);
}
</script>
</head>
<body onload="mapInit();changeRadio();">
<div id="container_body">
	<div id="top_area">
		<div class="search_top_div">
			<!-- style="background-color:blue" -->
			<div class="search_top_div_item floatl">
				<!-- style="background-color:red" -->
				<input class="txt300 floatl" id="keyword" name="keyword" value=""
					onkeydown="keydown()" />
				<!-- srh box -->
				<span class="magnifier_button floatl" onclick="kwdDirectSearch()" ></span>
				<!-- srh btn -->
				<div class="clear"></div>
			</div>
			<div class="top_right_div_item"
				onclick="document.getElementById('result1').style.display='none';">
				<!-- style="background-color:red" -->
				<span class="luru_selected floatl" onclick="changeFace(0)" ></span>
				<!-- srh btn -->
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div id="result1" name="result1"></div>
		<!-- kwd tips -->
		<div class="clear"></div>
	</div>
	<div id="main"
		onclick="document.getElementById('result1').style.display='none';">
		<form method="POST" name="uploadform" id="uploadform">
			<div id="main_left">
				<div id="result"></div>
				<div id="r_titlew"></div>
				<div id="r_title">
					<input class="txt200 floatl" id="quickkwd" name="quickkwd" value="常用地点快速检索"  onfocus="javascript:if(this.value=='常用地点快速检索')this.value='';"
						onkeydown="quickSearch()" />
					<!-- srh box -->
					<!-- onkeydown="keydown1()"-->
					<span class="quick_button floatl" onclick="quickSearch()" ></span>
					<!-- srh btn -->
					<div class="clear"></div>
				</div>
				<div id="r_table">
					<table id="road_table" border="0" align="left" cellpadding="0"
						cellspacing="0">
						<{section name=index loop=$commonroadList}> <{if
						$commonroadList[index].num%2 != 0}>
						<tr>
							<td><{else}>
							
							<td><{/if}>
								<table width="240px" border="0" cellpadding="0" cellspacing="0"
									id="table_road<{$commonroadList[index].num}>">
									<tr
										onmouseover="document.getElementById('delete_road<{$commonroadList[index].num}>').style.display='block';"
										onmouseout="document.getElementById('delete_road<{$commonroadList[index].num}>').style.display='none';">
										<td align="left" class="list_td"
											onclick="select_road('<{$commonroadList[index].num}>','<{$commonroadList[index].rid}>','<{$commonroadList[index].roadname}>','<{$commonroadList[index].position}>')"><{$commonroadList[index].roadname}>
										</td>
										<td align="right">
											<div class="delete_road_button"
												id="delete_road<{$commonroadList[index].num}>"
												onclick="before_delete('<{$commonroadList[index].num}>','<{$commonroadList[index].rid}>')"></div>
										</td>
									</tr>
								</table> <{if $commonroadList[index].num%2 == 0}>
							</td>
						</tr>
						<{else}>
						</td> <{/if}> <{/section}>
					</table>
					<div class="clear"></div>
				</div>
			</div>
		</form>
		<div id="showMessage"></div>
		<div id="main_right">
			<div id="container"></div>
			<div id="main_below">
				<div id="luru_item">
					<div id="label_radio">
						<input type="hidden" id="roadid_p" name="roadid_p" value="" /> <input
							type="hidden" id="roadname_p" name="roadname_p" value="" /> <input
							type="hidden" id="roadposi_p" name="roadposi_p" value="" /> <input
							type="hidden" id="roaddire_p" name="roaddire_p" value="" /> <input
							type="hidden" id="roadsitu_p" name="roadsitu_p" value="" /> <span style="font-weight:bold;">方  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;向:</span>&nbsp;
						<label for="radio_id_1" name="radio_id_1" class="" />由东向西</label>
						<input type="radio" id="radio_id_1" name="you_select1"
							checked="true" value="01" onclick="direction('01')" /> 
							<label for="radio_id_2" name="radio_id_2" class="" />由西向东</label>
							 <input type="radio" id="radio_id_2" name="you_select1" value="02"
							onclick="direction('02')" /> <label for="radio_id_3"
							name="radio_id_3" class="" />由南向北</label> <input type="radio"
							id="radio_id_3" name="you_select1" value="03"
							onclick="direction('03')" /> <label for="radio_id_4"
							name="radio_id_4" class="" />由北向南</label> <input type="radio"
							id="radio_id_4" name="you_select1" value="04"
							onclick="direction('04')" />
					</div>
					<div id="label_radioy">
						<span style="font-weight:bold;">拥堵情况:</span> &nbsp;<label for="radioy_id_1" name="radioy_id_1"
							class="" />畅通</label> <input type="radio"
							id="radioy_id_1" name="you_select2" checked="true" value="01"
							onclick="situation('01')" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label for="radioy_id_2"
							name="radioy_id_2" class="" />缓行</label> <input type="radio"
							id="radioy_id_2" name="you_select2" value="02"
							onclick="situation('02')" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<label for="radioy_id_3"
							name="radioy_id_3" class="" />拥堵</label> <input type="radio"
							id="radioy_id_3" name="you_select2" value="03"
							onclick="situation('03')" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="radioy_id_4"
							name="radioy_id_4" class="" />事故</label> <input type="radio"
							id="radioy_id_4" name="you_select2" value="04"
							onclick="situation('04')" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="radioy_id_5"
							name="radioy_id_5" class="" />禁行</label> <input type="radio"
							id="radioy_id_5" name="you_select2" value="05"
							onclick="situation('05')" />
					</div>
					<div id="road_text">
						<textarea id="roadtext" name="roadtext" class="roadtext_s"></textarea>
					</div>
					<div id="button_area">
						<div id="b_submit" onclick="addRoadInfo()"></div>
						<div id="b_empty" onclick="doEmpty()"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>