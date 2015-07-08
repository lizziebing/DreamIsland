<?php /* Smarty version 2.6.28, created on 2014-09-13 10:30:30
         compiled from searchtest.tpl */ ?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">-->
<html lang="en">

<head>

<meta name="viewport" content="initial-scale=1.1,user-scalable=no>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>RoadInfo Test1</title>
<!--<link rel="stylesheet" type="text/css" href="http://developer.amap.com/Public/css/demo.Default.css" />-->
<style type="text/css">
html{height:100%}
body{height:100%;margin:0px;padding:0px}
#search{font-size:14px;}
#search .searchtext{padding:2px 1px; width:320px;}
#search_auto{border:1px solid #817FB2; position:absolute;} /*设置边框、定位方式*/
</style >

<script type="text/javascript"  src="js/jquery.js"></script>
<!--<script type="text/javascript"  src="js/suggest.js"></script>-->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs
/jquery/1.4.0/jquery.min.js"></script>-->
<script type="text/javascript"  src="js/jquery.form.js"></script>
<script type="text/javascript">

<!--$(document).ready(function()){
    $('#suggest_input').onkeyup(function(){
    alert("keyup");
    var keyword = $("input[name='keyword']").val();
    $.post(
    "searchtest.php",{keyword:keyword},function(data){
    var objs = eval(data);
    var contents="";
     $('#suggest_ul').show(0);
    for(var i=0;i<objs.length;i++){
    $('#suggestList').append("<div>+objs[i]+"<div>");           
    var keywords = res[i].keywords;
    alert(res[i].keywords);
    contents=contents+"<li class='suggest_li"+(i+1)+"'>"+keywords+"</li>";
    }
      $("#suggest_ul").html(contents);
    }
    
    )
    })
}
-->
function look(){
	$("#suggest_input").ajaxSubmit({
		url: "searchtest.php",
		success: function(rta){
		alert(rta);
			var azxc=rta;
			$('#asdf').html(azxc);
		}
	});
}



</script>

</head>
<!--<body onload="initialize()">-->
<body>
<div id="search">
 <form id="suggestList" name="suggestList" method="POST">
<input type="text" name="keyword" id="suggest_input" onkeyup="look()" />
 <input type="submit" value="搜索一下" id="suggest_submit" />
 
<div id="asdf"></div>
   
   
   </form>
   <ul id="suggest_ul">
    </ul>
</div>
</body>
</html>

