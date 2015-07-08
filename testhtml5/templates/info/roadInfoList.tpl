<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Hello,world</title>
<style type="text/css">
html{height:100%}
body{height:100%;margin:0px;padding:0px;}

/*body{height:100%;margin:0px;padding:0px;text-align:center;}
#container_body{
	width:1064px;
	margin:0,auto;
	text-align:left;
}*/

#top_area {
position: relative;
background: url(cn/img/weibo/road/bg1.png);
background-repeat: repeat-x;
z-index: 101;
height:54px;

}
.floatl {
float: left;
}
.search_top_div {
position: relative;
}
.search_top_div_item {
padding-left: 10px;
display: inline;
float: left;
padding-top: 10px;
display:none;
}
.top_right_div_item {
padding-left: 470px;
display: inline;
float: right;
padding-top: 10px;
}
#result1{
position:absolute;
z-index:501;
background-color:#fff;
overflow: auto;
width: 346px;
border: 1px solid #dbd9da;
margin:0px 0 0 10px;
display: none;
}
/*
form {
margin: 0;
display: inline;
}
*/
#leftup_area{
position:absolute;
z-index:300;
background-color:#fff;
padding: 0px 0px 0px 0px;
}
#r_title{
padding: 8px 0px 5px 0px;
border-bottom: 1px solid #2fa603;
margin-left:10px;
}
#r_title_2{
padding: 8px 0px 5px 4px;
}
#r_table{
padding: 0px 0px 0px 10px;
}
#r_table_content{
position:absolute;
z-index:300;
width:416px;
/*height:620px;
overflow: auto;
*/
height:82%;	
overflow: auto;
overflow-x: hidden;
margin: 78px 0px 0px 0px;
}
.r_item{
width:396px;
padding: 4px 0px 4px 0px;
border-bottom: 1px solid #838383;
}
.r_left{
width: 25px;
padding: 12px 0px 0px 0px;
float:left;
}
.r_middle{
width: 240px;
padding: 10px 0px 10px 0px;
float:left;
}
.r_right{
padding: 10px 0px 0px 0px;
float:left;
}
.xingbiao{
display:block;
width: 16px;
height: 16px;
background: url(cn/img/weibo/road/star_unselected.png) no-repeat;
cursor: pointer;
float:left;
}
.xingbiao_b{
display:block;
width: 16px;
height: 16px;
background: url(cn/img/weibo/road/star_selected.png) no-repeat;
cursor: pointer;
float:left;
}
.r_text{
font-family:"Microsoft YaHei";
font-size: 13px;
color:#585858;
}
.r_text_q{
font-family:"Microsoft YaHei";
font-size: 13px;
color:#d81919;
}
.r_up{
margin: 4px 0px 0px 70px;
display:block;
width: 60px;
height: 24px;
background: url(cn/img/weibo/road/unread.png) no-repeat;
cursor: pointer;
}
.r_up_y{
margin: 4px 0px 0px 70px;
display:block;
width: 60px;
height: 24px;
background: url(cn/img/weibo/road/read.png) no-repeat;
}
.r_below{
	float:left;
}
.r_nichen{
height:27px;
line-height:27px;
font-family:"Microsoft YaHei";
font-size: 13px;
color:#585858;
float:right;
}
.r_nichen_q{
height:27px;
line-height:27px;
font-family:"Microsoft YaHei";
font-size: 14px;
color:#d81919;
float:right;
}
.r_shijian{
margin-left:10px;
height:27px;
line-height:27px;
font-family:"Microsoft YaHei";
font-size: 13px;
color:#585858;
float:right;
}
.r_shijian_q{
margin-left:10px;
height:27px;
line-height:27px;
font-family:"Microsoft YaHei";
font-size: 14px;
color:#d81919;
float:right;
}
#road_table{
width: 430px;
height:660px;
background-repeat: repeat-y;
font-family:"Microsoft YaHei";
font-size: 14px;
color:#585858;
}
.txt300 {
border: 1px solid #2fa603;
width: 255px;
font-family:"Microsoft YaHei";
font-size: 14px;
color:#585858;
height: 30px;
line-height:30px;
padding: 2px 5px;
border-right: 0;
}
.txt200 {
padding-left:3px;
width: 128px;
height:25px;
font-family:"Microsoft YaHei";
font-size: 15px;
font-weight: 700;
color:#585858;
}
input {
outline: 0;
}
.magnifier_button {
width: 82px;
height: 36px;
background: url(cn/img/weibo/road/search_unselected.png) no-repeat;
cursor: pointer;
}
.quick_button {
margin-left:52px;
width: 232px;
height: 25px;
}
#zongtable{
width: 200px;
height: 25px;
float:left;
}
#zong_table{
width: 200px;
height: 25px;
font-family:'Microsoft YaHei';
font-size:14px;
color:#585858;
}
.zt_font{
font-family:'Microsoft YaHei';
font-size:14px;
color:#585858;
}
.zt_font_c{
font-family:'Microsoft YaHei';
font-size:14px;
font-weight:700;
color:#2fa603;
}
.ft_font{
font-family:'Microsoft YaHei';
font-size:13px;
color:#585858;
}
.ft_font_c{
font-family:'Microsoft YaHei';
font-size:13px;
font-weight:700;
color:#2fa603;
}
#futable{
width: 350px;
height: 22px;
}
#fu_table{
width: 350px;
height: 22px;
font-family:'Microsoft YaHei';
font-size:13px;
color:#838383;
}
.unrefresh{
display:block;
width: 22px;
height: 17px;
margin-top:2px;
background: url(cn/img/weibo/road/unrefresh.png) no-repeat;
cursor: pointer;
float:right;
}
.refresh{
display:block;
width: 22px;
height: 17px;
margin-top:2px;
background: url(cn/img/weibo/road/refresh.png) no-repeat;
cursor: pointer;
float:right;
}
.sanjiao{
position:absolute;
z-index:301;
display:block;
width: 14px;
height: 9px;
margin:30px 0 0 26px;
background: url(cn/img/weibo/road/arrow.png) no-repeat;
}
.luru_selected {
width: 160px;
height: 32px;
background: url(cn/img/weibo/road/xianshi_selected.png) no-repeat;
cursor: pointer;
}
a, abbr, acronym, address, applet, article, aside, audio, b, big, blockquote, body, canvas, caption, center, cite, code, dd, del, details, dfn, div, dl, dt, em, embed, fieldset, figcaption, figure, font, footer, h1, h2, h3, h4, h5, h6, header, hgroup, html, i, iframe, img, input, ins, kbd, label, legend, li, mark, menu, nav, object, ol, output, p, pre, q, ruby, s, samp, section, select, small, span, strike, strong, sub, summary, sup, table, tbody, td, tfoot, th, thead, time, tr, tt, u, ul, var, video {
margin: 0;
padding: 0;
border: 0;
font: inherit;
font-family:"Microsoft YaHei";
vertical-align: baseline;
}
.clear {
clear: both;
}


/*#main_left{width:430px;height:700px;float:left;}
#main_right{position: relative;width:600px;height:700px;float:right;}
#container{min-height:700px;height:auto;}
*/
/*margin-left: 434px;*/

#main_left{width:430px;height:auto;float:left;}
#main_right{position: relative;height:auto;margin-left:434px;width:auto;}
#container{height:90%;}


#result{
position:absolute;
z-index:201;
background-color:#fff;
border: 1px solid #dbd9da;
overflow:auto;
width:420px;
height:710px;
margin:-698px 0 0 10px;
border-top:0;
display:none;
}
.delete_road_button{
background: url(cn/img/weibo/road/delete.png) no-repeat;
width: 16px;
height: 16px;
margin-right:5px;
margin-bottom:-3px;
cursor: pointer;
display:none;
}
.list_td{
width:202px;
height:30px;
line-height:30px;
padding-left:8px;
}
.selected_bg{
width:240px;
height:30px;
background: url(cn/img/weibo/road/selected.png) no-repeat;
}
#luru_item{
padding:1px 0 0 40px;
}
#label_radio,#label_radioy{
height:28px;
line-height:28px;
font-family:'Microsoft YaHei';
font-size:14px;
color:#585858;
}
#road_text{
padding:8px 0 0 0;
}
.roadtext_s{
width:472px;
height:82px;
border:1px solid #bababa;
font-family:'Microsoft YaHei';
font-size:14px;
color:#585858;
}
#button_area{
padding:8px 0 0 0;
}
#b_submit{
position: relative;
margin-left:127px;
background:url(cn/img/weibo/road/submit_unselected.png) no-repeat;
width:78px;
height:30px;
float:left;
cursor: pointer;
}
#b_empty{
position: relative;
margin-left:266px;
background:url(cn/img/weibo/road/empty_unselected.png) no-repeat;
width:78px;
height:30px;
cursor: pointer;
}
.shortcut{
display: block;
width:50px;
height:22px;
margin-top:5px;
background:url(cn/img/weibo/road/add_unselected.png) no-repeat;
cursor: pointer;
}
.shortcut_add{
display: block;
width:50px;
height:22px;
margin-top:5px;
background:url(cn/img/weibo/road/add_selected.png) no-repeat;
cursor: pointer;
}

#showMessage {
         position:fixed;
         z-index:1000;
         top:320px;
         left:400px;
         overflow-x:hidden;
         overflow-y:auto;
}
/* ---------lichun---pics show-Start-20141109---- */
.Limage {
         position:fixed;
         z-index:1000;
         top:0px;
         left:0px;
		margin:0;
         padding:0;
         width:100%;
         height:100%;
         overflow-x:hidden;
         overflow-y:auto;
         background:url(cn/img/weibo/zsc/background.png);
}
.img_small_show {
	 	width:50%;
	 	height:50%;
}
.closebutton{
        position:fixed;
        top:54px;
        width:26px;
        border:0px;
        background-color:transparent;
}
/* ---------lichun---pics shows-End-20141109---- */
<!--图片声音样式2014.09.14 zhanghanbing-->
.showimage_d{
         position:absolute;
         z-index:1000;
         margin:0;
         padding:0;
         width:100%;
         height:756px;
         overflow-x:hidden;
         overflow-y:auto;
        background:url(cn/img/weibo/zsc/background.png);
         diplay:none;
}

.unshowloading{
color:#585858;
font-size:14px;
display:none;
}
.showloading{
color:#585858;
font-size:14px;
display:block;
}
<!-- 图片声音样式2014.09.14 zhanghanbing END   -->
</style>
<!--<link href="map.css" rel="stylesheet" type="text/css" />-->
<script src="<{$jscript}>/jquery.min.js"></script>
<script src="<{$jscript}>/jquery-1.8.3.js" ></script>
<!--<script type="text/javascript" src="<{$jscript}>/formjs/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<{$jscript}>/formjs/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="<{$jscript}>/formjs/script.js"></script>-->
<script type="text/javascript" src="<{$jscript}>/formjs/jquery.form.js"></script>
<script language="javascript" src="http://webapi.amap.com/maps?v=1.3&key=7c77e30eeb5eed931e4e90e04b398137"></script>
<script language="javascript">

var mapObj;
var windowsArr = new Array(); 
var marker = new Array();

function mapInit(){
 
    mapObj = new AMap.Map("container", {
        view: new AMap.View2D({
//          center:new AMap.LngLat(123.436498,41.805331),//地图中心点 ,烟台(0535)中心点：121.391382,37.539297,长春(0431)：125.3245,43.886841, 新疆中心点：87.617733,43.792818
            zoom:14//地图显示的缩放级别
        }),
        keyboardEnable:false//键盘控制地图移动，地图跟随关键字移动，关键字也实时变化，选为false比较好
    });

   // mapObj.setCity(cityName);//根据城市名定位中心点       
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
     
     
	 getLngLatValue(); 
     //监听-在停止拖拽地图时触发，获取视图内经纬度范围
     AMap.event.addListener(mapObj,'dragend',function(e){ 
			getLngLatValue(); 
     });
     //监听-在改变地图缩放级别时触发，获取视图内经纬度范围
     AMap.event.addListener(mapObj,'zoomchange',function(e){ 
			getLngLatValue(); 
     });
     
}

//获取视图内的经纬度范围，并且异步获取路况图标显示情况
function getLngLatValue(){
     	var bounds=mapObj.getBounds();//地物对象的经纬度矩形范围。
		var northeast=bounds.getNorthEast( );//获取东北角坐标
		var sourthwest=bounds.getSouthWest( );//获取西南角坐标。LngLat类型地物对象的经纬度矩形范围。
		var lng = sourthwest.getLng().toString()+","+northeast.getLng().toString();//经度组（西经，东经）
		var lat = sourthwest.getLat().toString()+","+northeast.getLat().toString();//纬度组（西纬，东纬）
		
		$.getJSON("admin.php?op=baseinfomgr_roadInfoList&action=mapMarkShow&lng="+lng+"&lat="+lat,{},function(data){ 
			var max_i = parseInt(data['coun']);
			var dataarray = new Array(); 
			var dataarray = data['info'];
			for(var i = 0; i < max_i; i++){
				var position_XY = dataarray[i].Position;
                var point_wz = position_XY.indexOf(",");
                var lng_X = position_XY.substring(0,point_wz);
                var lat_Y = position_XY.substring(point_wz+1);
				//$('#markmaparea').html(i); //加载提示隐藏
				showRoadMarker(lng_X,lat_Y,dataarray[i].Type,dataarray[i].Situation);
			}
		});
}

//添加路况图标的marker - 给地图上
function showRoadMarker(lngX, latY, rType, rSitu){
	//$('#markmaparea').html(lx+" - "+ly+" - "+rtype+" - "+rsitu); //加载提示隐藏
	
    var picture = "";
	if(rType == "1"){
		if(rSitu == "01"){
			picture = "cn/img/weibo/road/green1.png";
		}else if(rSitu == "02"){
			picture = "cn/img/weibo/road/orange1.png";
		}else if(rSitu == "03"){
			picture = "cn/img/weibo/road/yellow1.png";
		}else if(rSitu == "04"){
			picture = "cn/img/weibo/road/pink1.png";
		}else if(rSitu == "05"){
			picture = "cn/img/weibo/road/red1.png";
		}
	}else{
		if(rSitu == "01"){
			picture = "cn/img/weibo/road/green.png";
		}else if(rSitu == "02"){
			picture = "cn/img/weibo/road/orange.png";
		}else if(rSitu == "03"){
			picture = "cn/img/weibo/road/yellow.png";
		}else if(rSitu == "04"){
			picture = "cn/img/weibo/road/pink.png";
		}else if(rSitu == "05"){
			picture = "cn/img/weibo/road/red.png";
		}
	}
	
    var markerOption = {
        map:mapObj,
        icon:picture,
        position:new AMap.LngLat(lngX, latY)
    };
    var mar = new AMap.Marker(markerOption);         
    marker.push(new AMap.LngLat(lngX, latY));
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
        resultStr1 += "<div id='divid" + i + "' onmouseover='openMarkerTipById1(" + i + ",this)' onmouseout='onmouseout_MarkerStyle(" + (i + 1) + ",this)' onclick=\"openInfoWindow(" + i + ",this)\" style=\"padding:8px 0 8px 5px;\"><div><table><tr><td><img src=\"cn/img/weibo/road/" + (i + 1) + ".png\" style=\"margin-top:2px;\"></td>" + "<td width=\"3px\"></td><td><h3 style=\"height:24px;\"><font id=\"ssjg"+i+"\" color=\"#585858\" style=\"font-family:'Microsoft YaHei';font-size:14px;\">" + poiArr[i].name + "</font></h3>";
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
	$.getJSON("admin.php?op=baseinfomgr_getAjaxData&action=addCommonRoad",{rid:id,roadname:name,position:location},function(data){
//		alert(data);
		if(data=="success"){
			$('#shortcut_'+id).removeClass("shortcut").addClass("shortcut_add");
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

function changeFace(x){
	if(x==0){
		window.location.href="admin.php?op=baseinfomgr_roadInfoList";
	}else{
		window.location.href="admin.php?op=baseinfomgr_roadInfoInput";
	}
}

function turn_Read(no,name){
	if(name=='isread'){
		var fi_isread = document.getElementById("fi_isread"+no).value; 
		if(fi_isread=='0'){
			var op = '1'; 
		}else{
			var op = '0'; 
		}
	}else if(name=='ismark'){
		var fi_ismark = document.getElementById("fi_ismark"+no).value; 
		if(fi_ismark=='0'){
			var op = '1'; 
		}else{
			var op = '0'; 
		}
	}
//	alert(op);
	$.getJSON("admin.php?op=baseinfomgr_roadInfoList&action=modifyRoadInfo",{No:no,Name:name,Op:op},function(data){
//		alert(data);
		if(data=="success"){
//			alert("修改成功");
			$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">修改成功</div></div>').fadeOut(1500);
			if(name=='isread'){
				if(op=='1'){
					$('#r_up'+no).removeClass("r_up").addClass("r_up_y");
				}else{
					$('#r_up'+no).removeClass("r_up_y").addClass("r_up");
				}
				document.getElementById("fi_isread"+no).value = op;
			}else if(name=='ismark'){
				if(op=='1'){
					$('#xingbiao'+no).removeClass("xingbiao").addClass("xingbiao_b");
				}else{
					$('#xingbiao'+no).removeClass("xingbiao_b").addClass("xingbiao");
				}
				document.getElementById("fi_ismark"+no).value = op;
			}
		}else{
//			alert("修改失败");
			$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">修改失败</div></div>').fadeOut(1500);
		}
	});
}

var ys_up = "all";
var ys_down = "s_all";
function queryOption(op,va,situa,t){
	document.getElementById("pagevalue").value = "1";
	isload = 1;
	if(t!=ys_up){
		$('#'+ys_up).removeClass("zt_font_c").addClass("zt_font");
		$('#'+t).removeClass("zt_font").addClass("zt_font_c");
		ys_up = t;
	}
	$('#s_ct').removeClass("ft_font_c").addClass("ft_font");
	$('#s_hx').removeClass("ft_font_c").addClass("ft_font");
	$('#s_yd').removeClass("ft_font_c").addClass("ft_font");
	$('#s_sg').removeClass("ft_font_c").addClass("ft_font");
	$('#s_jx').removeClass("ft_font_c").addClass("ft_font");
	$('#s_all').removeClass("ft_font").addClass("ft_font_c");
	document.getElementById("queryOpB").value = op; 
	document.getElementById("queryOpVal").value = va; 
	document.getElementById("queryOpS").value = situa; 
	$("#uploadform").ajaxSubmit({
		url: "admin.php?op=baseinfomgr_roadInfoList&action=queryRoadOption",
		success: function(rta){
			//alert(rta);
			if(rta=="dataisnull"){
				$('#r_table_content').html("");
				$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">暂无数据</div></div>').fadeOut(1500);
			}else if(rta=="failure"){
				$('#r_table_content').html("");
				$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">获取失败</div></div>').fadeOut(1500);
			}else{
				$('#r_table_content').html(rta);
				if(op=='No' && va=='2' && situa=='00' && t=='all'){
					$('#mark_refresh').removeClass("refresh").addClass("unrefresh");
				}
			}
		}
	});
}

function querySituation(x,t){
	var queryOpB = document.getElementById("queryOpB").value; 
	var queryOpVal = document.getElementById("queryOpVal").value; 
	
	if(t!=ys_down){
		queryOption(queryOpB,queryOpVal,x,ys_up);//1128
		$('#'+ys_down).removeClass("ft_font_c").addClass("ft_font");
		$('#s_all').removeClass("ft_font_c").addClass("ft_font");
		$('#'+t).removeClass("ft_font").addClass("ft_font_c");
		ys_down = t;
	}
}

function ref(){
	var maxno = document.getElementById("maxno").value;
	var maxismark = document.getElementById("maxismark").value;
	$.getJSON("admin.php?op=baseinfomgr_roadInfoList&action=getRoadCount",{maxno:maxno,maxismark:maxismark},function(data){
		 
		if(data=="hasnew"){
			//alert("刷新成功");
			//$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">刷新成功</div></div>').fadeOut(1500);
			$('#mark_refresh').removeClass("unrefresh").addClass("refresh");
		}else if(data=="failure"){
			//alert("刷新失败");
			$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">刷新失败</div></div>').fadeOut(1500);
		}
	});
}





//------------------------------- 滚轮自动加载路况信息 -------------------------------------
var front_page = 1;
var isload = 1;
$(function (){ 
        var nScrollHight = 0; //滚动距离总长(注意不是滚动条的长度)
        var nScrollTop = 0;   //滚动到的当前位置
        var nDivHight = $("#r_table_content").height();
        $("#r_table_content").scroll(function(){
            nScrollHight = $(this)[0].scrollHeight;
            nScrollTop = $(this)[0].scrollTop;
            //alert(nScrollTop+" + "+nDivHight+" >= "+nScrollHight);
            if(nScrollTop + nDivHight >= nScrollHight)
            { 
          	    var op = document.getElementById("queryOpB").value;
          	    var opvalue = document.getElementById("queryOpVal").value;
          	    var situ = document.getElementById("queryOpS").value;
          	    var dq_page = document.getElementById("pagevalue").value;
          	    var pagex = parseInt(dq_page)+1;
          	    var pagec = 15;
          	    //alert(op+" - "+opvalue+" - "+situ+" - "+dq_page+" - "+pagex+" - "+pagec+" - "+isload);
          	    if(pagex != front_page){
          	    	if(isload == 1){
          	            $('#Loading').removeClass("unshowloading").addClass("showloading"); //加载提示
                        setTimeout(function(){
                            //这里就是异步获取内容的地方，这里简化成一句话，可以根据需要修改
                            $.get("admin.php?op=baseinfomgr_roadInfoList&action=loadRoadInfo&key="+op+"&value="+opvalue+"&situ="+situ+"&page="+pagex+"&pagec="+pagec,function(data){
                         	      $('#Loading').removeClass("showloading").addClass("unshowloading"); //加载提示隐藏
                         	      $("#r_table_content").append(data);
                         	      
                         	      document.getElementById("pagevalue").value = pagex;
                         	      if(data.indexOf("no_data") > 0 ){
                         	      	     isload = 2;
                         	      }
                            });
                        }, 1000);
                        front_page = pagex;
          	    	}
          	    }
            }
            else
            {
          	    $('#Loading').removeClass("showloading").addClass("unshowloading"); //加载提示隐藏
            }
        });
});

//------------------------------- 滚轮自动加载路况信息 End -------------------------------------
//------------------------------- 图片声音处理方法2014.09.14 zhanghanbing ------------------------------------


/*
function divscroll(id){
        var _div = document.getElementById(id);
        _div.onmousewheel = function(e){  
            e = e || window.event;  
            _div.scrollTop += e.wheelDelta>0?-100:100;  
            e.returnValue=false;  
        };  
}
*/
function download_img(url){
    var url = url.substr(0,url.length - 4);
    window.location.href ='admin.php?op=baseinfomgr_download&url='+url;  
}

// window.setInterval(ref,60000); 
//--------------------------图片声音处理方法2014.09.14 zhanghanbing END----------------------------

</script>
</head>

<body onload="mapInit();">
<!-- <div id="container_body"> -->
<div id="markmaparea"></div>
    <div id="top_area">
            <div class="search_top_div"><!-- style="background-color:blue"-->
                <div class="search_top_div_item floatl"><!--style="background-color:red"-->
                        <input class="txt300 floatl" id="keyword" name="keyword" value="" onkeydown="keydown()" /><!-- srh box -->
                        
                       <!--   <img class="magnifier_button floatl" onclick="kwdDirectSearch()" />--><!-- srh btn -->
                        <span class="magnifier_button floatl" onclick="kwdDirectSearch()"></span>
                        <div class="clear"></div>
                </div>
                <div class="top_right_div_item" onclick="document.getElementById('result1').style.display='none';"><!--style="background-color:red"-->
                   <!--      <img class="luru_selected floatl" onclick="changeFace(1)" /> --><!-- srh btn -->
                        <span class="luru_selected floatl" onclick="changeFace(1)"></span>
                        <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
          <!--<div id="result1" name="result1"></div>--><!--kwd tips-->
            <div class="clear"></div>
    </div>
    <div id="main" onclick="document.getElementById('result1').style.display='none';">
            <form method="POST" name="uploadform" id="uploadform">
            <div id="main_left">
                <div id="leftup_area">
                  <div class="sanjiao"></div>
                  <div id="r_title"><!--路况信息-->
                        <div class="txt200 floatl">路况信息</div>
                        <div class="quick_button floatl">
                            <div id="zongtable">
                                <table id="zong_table" border="0" align="left" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="42px" id="all" class="zt_font_c" align="center" style="cursor:pointer;" onclick="queryOption('No','2','00','all')">全部</td>
                                        <td width="42px" id="unread" class="zt_font" align="center" style="cursor:pointer;" onclick="queryOption('isread','0','00','unread')">未读</td>
                                        <td width="42px" id="mark" class="zt_font" align="center" style="cursor:pointer;" onclick="queryOption('ismark','1','00','mark')">标记</td>
                                        <td width="42px" id="unmark" class="zt_font" align="center" style="cursor:pointer;" onclick="queryOption('ismark','0','00','unmark')">未标记</td>
                                    </tr>
                                        <input type="hidden" id="queryOpB" name="queryOpB" value="No" />
                                        <input type="hidden" id="queryOpVal" name="queryOpVal" value="2" />
                                        <input type="hidden" id="queryOpS" name="queryOpS" value="00" />
                                        <input type="hidden" id="pagevalue" name="pagevalue" value="1" />
                                </table>
                            </div>
                            <div id="mark_refresh" class="unrefresh" onclick="queryOption('No','2','00','all')"></div>
                        </div>
                        <div class="clear"></div>
                  </div>
                  <div id="r_title_2">
                            <div id="futable">
                                <table id="fu_table" border="0" align="left" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="42px" id="s_all" class="ft_font_c" align="center" style="cursor:pointer;" onclick="querySituation('00','s_all')">全部</td>
                                        <td width="42px" id="s_ct" class="ft_font" align="center" style="cursor:pointer;" onclick="querySituation('01','s_ct')">畅通</td>
                                        <td width="42px" id="s_hx" class="ft_font" align="center" style="cursor:pointer;" onclick="querySituation('02','s_hx')">缓行</td>
                                        <td width="42px" id="s_yd" class="ft_font" align="center" style="cursor:pointer;" onclick="querySituation('03','s_yd')">拥堵</td>
                                        <td width="42px" id="s_sg" class="ft_font" align="center" style="cursor:pointer;" onclick="querySituation('04','s_sg')">事故</td>
                                        <td width="42px" id="s_jx" class="ft_font" align="center" style="cursor:pointer;" onclick="querySituation('05','s_jx')">禁行</td>
                                    </tr>
                                </table>
                            </div>
                  </div>
                </div>
                  <div id="r_table"><!--路况列表-->
                  <{if $nodata == "notnull"}>
                    <div id="r_table_content">
                       <input type="hidden" id="maxno" name="maxno" value="<{$maxno}>"/>
                       <input type="hidden" id="maxismark" name="maxismark" value="<{$maxismark}>"/>
                    <{section name=index loop=$commonroadList}>
                        <div id="r_item<{$commonroadList[index].No}>" class="r_item">
                             <div id="r_left<{$commonroadList[index].No}>" class="r_left"><!--星标记-->
                                <input type="hidden" id="fi_ismark<{$commonroadList[index].No}>" name="fi_ismark<{$commonroadList[index].No}>" value="<{$commonroadList[index].Ismark}>" />
                                <{if $commonroadList[index].Ismark == "0"}>
                                  <div id="xingbiao<{$commonroadList[index].No}>" class="xingbiao" onclick="turn_Read('<{$commonroadList[index].No}>','ismark')"></div>
                                <{else}>
                                  <div id="xingbiao<{$commonroadList[index].No}>" class="xingbiao_b" onclick="turn_Read('<{$commonroadList[index].No}>','ismark')"></div>
                                <{/if}>
                             </div>
                             <div id="r_middle<{$commonroadList[index].No}>" class="r_middle"><!--文字-->
                                <{if $commonroadList[index].Type != "1"}>
                                  <div id="r_text<{$commonroadList[index].No}>" class="r_text">
                                <{else}>
                                  <div id="r_text<{$commonroadList[index].No}>" class="r_text_q">
                                <{/if}>
                               
                                  <table border="0" align="left" cellpadding="0" cellspacing="0">
                                     <tr>
                                      <{if $commonroadList[index].num==""}>
                                         <td width="15px">1.
                                         </td>
                                          <{else}>
                                           <td width="15px"><{$commonroadList[index].num}>.
                                         </td>
                                       <{/if}>
                                        
                                         <td><{$commonroadList[index].Memo}>
                                         <!--   ------------------lichun -----pics show 20141109-Start------ -->
                                         <{if $commonroadList[index].ImgUrl !='0' && $commonroadList[index].ImgUrl !=''}>
                                         &nbsp;<img style="cursor:pointer" id="image<{$commonroadList[index].No}>" src="<{$img}>/weibo/road/picture.png" width="22px" height="17px" onClick="$('#image_div'+<{$commonroadList[index].No}>).show()"/>
                                       <div id="image_div<{$commonroadList[index].No}>"  class ="Limage" style="display:none;" >
                                       		<div style="width:90%;position:fixed;margin-top:80px;text-align:center;">
					        						<img  id="showImageImg<{$commonroadList[index].No}>" style='max-height:800px;' src='<{$commonroadList[index].ImgUrlarray[0]}>' />
					        						<button class="closebutton" type="button" onClick="$('#image_div<{$commonroadList[index].No}>').hide()"><font color="#FFFFFF">&times;</font></button>
					         				</div>
					        				<div style="width:10%;float:right;text-align:center;margin-top:80px">
					         						<{section name=i loop=$commonroadList[index].ImgUrlarray max=9}>								 
														<{if $commonroadList[index].ImgUrlarray[i]!=""}> 
															<img style="position:relative;padding-bottom: 8px; cursor:pointer;"																	 
																 class='img_small_show' src="<{$commonroadList[index].ImgUrlarray[i]}>"
														         onClick="$('#showImageImg'+<{$commonroadList[index].No}>).attr('src','<{$commonroadList[index].ImgUrlarray[i]}>')" />				
														
														<{/if}> 
													<{/section}>
					         				</div>
                                       </div>
					                   		
										<{/if}>
 										<!--   ------------------lichun -----pics show 20141109-End------ --> 
                                        <{if $commonroadList[index].VoiceUrl != '0'&&$commonroadList[index].VoiceUrl != ''}>
                                         &nbsp;<a style="cursor:pointer;" href="<{$commonroadList[index].VoiceUrl}>" ><img src="<{$img}>/weibo/road/voice.png" width="22px" height="17px"/></a>
                                              <a style="color:#25690c;cursor:pointer;" onclick="download_img('<{$commonroadList[index].VoiceUrl}>')"><font style="font-family:'Microsoft YaHei';font-size:12px;">下载语音</font></a>
                                         <{/if}>
                                         </td>
                                     </tr>
                                  </table>
                                  </div>
                             </div>
                             <div id="r_right<{$commonroadList[index].No}>" class="r_right">
                                <input type="hidden" id="fi_isread<{$commonroadList[index].No}>" name="fi_isread<{$commonroadList[index].No}>" value="<{$commonroadList[index].Isread}>" />
                                <{if $commonroadList[index].Isread == "0"}>
                                  <div id="r_up<{$commonroadList[index].No}>" class="r_up" onclick="turn_Read('<{$commonroadList[index].No}>','isread')"><!--未读-->
                                  </div>
                                <{else}>
                                  <div id="r_up<{$commonroadList[index].No}>" class="r_up_y" onclick="turn_Read('<{$commonroadList[index].No}>','isread')"><!--已读-->
                                  </div>
                                <{/if}>
                                  
                                  <div class="clear"></div>
                             </div>
                              <div class="clear"></div>
                             <div id="r_below<{$commonroadList[index].No}>" class="r_below"><!--发布人和时间-->
                                        <div id="r_shijian<{$commonroadList[index].No}>" class="r_shijian"><!--7:50--><{$commonroadList[index].CreateTime}>
                                        </div>
                                        <div id="r_nichen<{$commonroadList[index].No}>" class="r_nichen"><!--Somon--><{$commonroadList[index].Hostweibo}>
                                        </div>
                                        <div class="clear"></div>
                             </div>
                            
                        </div>
                        
                        <div class="clear"></div>
                    <{/section}>
                    <!--自动加载-->
                    <div id="Loading" align="center" class="unshowloading">正在加载......</div>
                    </div>
                    <div class="clear"></div>
                  <{/if}>
                  </div>
<!--                   <div id="result"></div> -->
            </div>
            </form>
            <div id="showMessage"></div>
            <div id="main_right">
                  <div id="container"></div>
            </div>
    </div>
<!--  </div>     -->
</body>
</html>