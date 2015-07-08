<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Bootstrap 101 Template</title>
<!-- Bootstrap -->
<link href="<{$css}>/bootstrap/bootstrap.css" rel="stylesheet" media="screen">
<link href="<{$css}>/bootstrap/bootstrap-responsive.css" rel="stylesheet" media="screen">
<link href="<{$css}>/bootstrap/docs.css" rel="stylesheet" media="screen">
<link href="<{$css}>/bootstrap/prettify.css" rel="stylesheet" media="screen">
<link href="<{$css}>/bootstrap/my_bootstrap.css" rel="stylesheet" media="screen">
<link href="<{$css}>/jquery.alerts.css">
<link href="<{$css}>/showEmotion.css" rel="stylesheet" media="screen">
<link href="<{$css}>/sendHandle.css" rel="stylesheet" media="screen">
<link href="<{$css}>/dialog.css" rel="stylesheet" media="screen">
<style type="text/css">
#title{font-weight:400;font-size:24px;font-family:'Tangerine',serif;margin:10px 0px 10px 0px }
#msgbox{float:right;font-size:20px;color:#25690c}
#replymsgbox{float:right;font-size:14px;color:#25690c}
#commentmsgbox{float:right;color:#25690c}
#sendBox{width:572px;height:65px;overflow:hidden;border-style:solid;border-color:#25690c;padding-left:20px}
#sendBtn{border:0;width:81px;height:32px;cursor:pointer;margin-left:0px;background:url(cn/img/weibo/zsc/send_normal.png) no-repeat;}
#maxNum{font:20px Georgia, Tahoma, Arial;padding:0 5px;}
#sendHandle{float:left;line-height:30px;}
.pagecount{font-family:tahoma;font-size:12px;line-height:19px;margin:5px 5px 5px 5px;color:#25690c}
/*#sendHandle a{
        cursor:pointer;
                   text-decoration:none;
}*/
.border1 {
            border-bottom-color: #25690c;
            border-radius:3px 3px 3px 3px;
            padding:5px 5px 0px 5px;
}       
.border {
          border-bottom-style: solid;
          border-width:1px;
          border-bottom-color: #25690c;
        }
a{ color:#69a155;font-family:"宋体";}/*未访问的链接,已访问的链接,点击激活链接*/ 
a:hover{ color:#25690c}
.img{width:80px;height:80px}
.imgs{width:50px;height:50px}
.commentUrl{width:50px;height:50px}
#showMessage {
         position:fixed;
         z-index:103;
         top:0px;
         left:0px;
         width:100%;
         height:100%;
         overflow-x:hidden;
         overflow-y:auto;
}
#tips_table{
position:absolute;
z-index:10000;
margin-left:105px;
margin-top:45px;
color:#c0c0c0;
background-color:white;
border:1px solid #c0c0c0;
}

/* ---------lichun---pics-upload-1-Start-20141109---- */
.single_img_div {
		float:left;
		display:none;
		margin:2px 2px;
		padding:2px 2px;
		width:80px;
		height:85px;
		cursor:pointer;
		position:relative;
		
}
.pics_close {
		display:none;
		position:absolute;
		z-index:100;
		opacity:0.8;
		width:75px;
		height:75px;
		margin:2px;
		padding:2px;
		background-color:#DEDEDE;
}
.img_del {
		cursor:pointer;
		color:#25690c;
		size:30px;		
		font-weight:bold;
		font-size:10;
		opacity:1;
		background-color:#808080;
}
/* ---------lichun---pics-shows-1-Start-20141109---- */
.img_show {
	 	width:80px;
	 	height:80px;
		margin:2px;
}
/* ---------lichun---pics-shows-1-End-20141109---- */
/* ---------lichun---pics-upload-1-End-20141109---- */

/* ---------lichun---topic-1-Start-20141109---- */
.img_small {
	 	width:20px;
	 	height:20px;
}
/* ---------lichun---topic-1-End-20141109---- */

</style>
<script src="<{$jscript}>/jquery.min.js"></script>
<script src="<{$jscript}>/jquery-1.8.3.js" ></script>
<script src="<{$jscript}>/showEmotion.js" ></script>
<script src="<{$jscript}>/rili.js" ></script>
<script src="<{$jscript}>/bootstrap/bootstrap.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-transition.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-alert.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-modal.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-dropdown.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-scrollspy.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-tab.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-tooltip.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-popover.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-button.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-collapse.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-carousel.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-typeahead.js"></script>
<script src="<{$jscript}>/bootstrap/bootstrap-affix.js"></script>

<script src="<{$jscript}>/bootstrap/holder.js"></script>
<script src="<{$jscript}>/bootstrap/prettify.js"></script>

<script src="<{$jscript}>/bootstrap/application.js"></script>
<script src="<{$jscript}>/zsc/normal_elgg.js"></script>
<script src="<{$jscript}>/jquery.alerts.js"></script>


<script src="<{$jscript}>/hoverdelay.js"></script>
<script src="<{$jscript}>/dialog.js"></script>

<!-- <script src="<{$jscript}>/uploadImage.js"></script> -->
<script type="text/javascript" src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js"></script>
<!--<script src="<{$jscript}>/editUserInfo.js"></script>-->
<script language="javascript">
var sharecontent="";//分享内容
var shareimgurl="";//分享图片

var scrollTime = 0;
var min = "";
var time = 0;
var timeEvent;
$(function(){
                //绑定表情
                $('#face').SinaEmotion($('.sendBox'));
                $("#rightTime").append(rightTime);
                startclock();
               $('#sendBox').bind("keyup",function(){
                        
                        recount();
                        //last();
                        });
      /*         $('#sendBox').bind("keydown",function(){
                        
                      //  recount();
                        last();
                        });*/
                $('#sendBtn').click(function(){
                        var saytext = $('#sendBox').val();
                        //var picture = $('#single_image').attr('src');
                        //--------------lichun--pic-upload--Start---20141109----                        
                        var picture = urls_image(); 
                        //--------------lichun--pic-upload--Start---20141109----
                        //saytext=AnalyticEmotion(saytext);
                //        alert(saytext);
                        if(saytext==""){
                            $('#sendBox').focus();
                                    $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">输入不能为空</div></div>').fadeOut(1500);
                            return false;
                        }
                        if(!picture){
                            $.getJSON("admin.php?op=baseinfomgr_weiboAjax&action=sendweibo",{saytext:saytext},function(data){
                                if(data){
                                    $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">发布成功</div></div>').fadeOut(1500);
                                window.location.href = "admin.php?op=baseinfomgr_myWeiboList&action=init&page=1";
                                }else{
                                    $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">发布失败</div></div>').fadeOut(1500);
                                }
                                $('#sendBox').val('');
                            });
                        }else{
                            $.getJSON("admin.php?op=baseinfomgr_weiboAjax&action=sendweibo",{saytext:saytext,picture:picture},function(data){
                       //         alert(data);
                                if(data){
                                    $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">发布成功</div></div>').fadeOut(1500);
                                window.location.href = "admin.php?op=baseinfomgr_myWeiboList&action=init&page=1";
                                }else{
                                    $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">发布失败</div></div>').fadeOut(1500);
                                }
                                $('#sendBox').val('');
                            });
                        }
		                var ischecked = document.getElementById("sendcheckbox");
		                if(ischecked.checked){
                    //        alert("saf");
                            $.getJSON("admin.php?op=baseinfomgr_weiboAjax&action=sendweibo",{saytext:saytext},function(data){
                            });
                        }	
                });
  
});

// //修改用户基本信息
// function load_avatar(url,width,height){
//         window.top.art.dialog({id:'showlogin'}).close();
//         window.top.art.dialog({title:'',iframe:url,width:width,height:height,top:'150px'}, function(){}, function(){window.top.art.dialog({id:'showlogin'}).close()});
// }
//发布微博，点击发布按钮后把表情符号替换成表情图片
function AnalyticEmotion(s) {
    if(typeof (s) != "undefined") {
        var sArr = s.match(/\[.*?\]/g);
        if(sArr){
            for(var i = 0; i < sArr.length; i++){
                if(uSinaEmotionsHt.containsKey(sArr[i])) {
                    var reStr = "<img src=\"" + uSinaEmotionsHt.get(sArr[i]) + "\" height=\"22\" width=\"22\" />";
                    s = s.replace(sArr[i], reStr);
                }   
            }   
        }   
    }   
    return s;
}
//定位发布微博的文本域光标在文本最后
function last(){
    //alert(1);
    var e = event.srcElement;
    var r =e.createTextRange();
    r.moveStart("character",e.value.length);
    r.collapse(true);
    r.select();
}

function textrecount(num){
        var max1 = 140;
        //var current = max1 - $('#text'+num).val().length;
        var sum = 0;
        var value = document.getElementById("text"+num).value;
        for(var i = 0;i< value.length;i++){ 
                if((value.charCodeAt(i)>=0)&&(value.charCodeAt(i)<=255)){  
                        sum=sum+0.5;   
                }else{   
                        sum=sum+1;   
                }
        }
        if((sum*10)%10 == 0){
            current = max1 - sum;
        }else
            current = max1-0.5-sum;    
        if(current < 0){
            $("#zfBtn"+num).attr("disabled","true");
            $("#haishengyu"+num).html("发言请遵守社区公约，已经超出");
            $('#wordcount'+num).html(-current);
            $('#zfBtn'+num).css("background-image","url(cn/img/weibo/zsc/transmit_unable.png)");
        }
        else{
            $('#wordcount'+num).html(current);
            $("#haishengyu"+num).html("还剩余");
            $('#zfBtn'+num).removeAttr("disabled");
            $('#zfBtn'+num).css("background-image","url(cn/img/weibo/zsc/transmit_normal.png)");
        }
}
function recount(){
        var max = 140;
        var sum = 0;
        var value = document.getElementById("sendBox").value;
        for(var i = 0;i< value.length;i++){ 
                if((value.charCodeAt(i)>=0)&&(value.charCodeAt(i)<=255)){  
                        sum=sum+0.5;   
                }else{   
                        sum=sum+1;   
                }
        }
        if((sum*10)%10 == 0){
            current = max - sum;
        }else
            current = max-0.5-sum;    
        if(current < 0){
            $("#sendBtn").attr("disabled","true");
            $("#haikeyi").html("发言请遵守社区公约，已经超出");
            $('#maxNum').html(-current);
            $('#sendBtn').css("background-image","url(cn/img/weibo/zsc/send_unable.png)");
            $('#sendcheckbox').hide();
            $('#sendxinlang').hide();
        }
        else{
            $('#maxNum').html(current);
            $("#haikeyi").html("还可以输入");
            $('#sendBtn').removeAttr("disabled");
            $('#sendBtn').css("background-image","url(cn/img/weibo/zsc/send_normal.png)");
            $('#sendcheckbox').show();
            $('#sendxinlang').show();
        }
}
/*function recount(){
        var max = 140;
        var current = max - $('#sendBox').val().length;
        $('#maxNum').html(current);
}*/
function getContent1(o){
    //var content = this.attr('data-content');
    var content=$(o).data('popover');
    alert(content.getContent());
}
function setContent1(o,chked,commenttotal,chkedID,flag){
    e = $("#commentDiv"+chked);
    if(e.html() != ""){
        e.html(""); 
        if(flag == 1)
            return;
    }
    var oldTable="<div id='oldTable"+chked+"'style='border-style:solid;border-width:1px;border-color:#dedede' width='100%'><table border='0' cellpadding='0' cellspacing='0' align='center' width='96%' id='tab"+chked+"'><tr><td width='100%' colspan='2'><div style='font-size:12px'>请发表评论<span id='commentmsgbox"+chked+"' style='float:right;color:#25690c'></span></td></tr><tr height='40'><td align='center' colspan='2'><textarea id='info"+chked+"' style='overflow:hidden; border:1px #25690c solid; width:470px;'></textarea></td></tr><tr height='30'><td align='right'><input type='button' style='background:url(cn/img/weibo/zsc/comment_normal.png); width:58px; height:30px' value='' onclick='submitComment("+chked+","+chkedID+",null)' /></td></tr></table></div>";	
   // alert(commenttotal);
    
    if(commenttotal>=0){
       // alert(commenttotal);
        var shownum = commenttotal > 10?10 : commenttotal;
        $.getJSON("admin.php?op=baseinfomgr_weiboAjax&action=getcomment",{weiboID:chkedID},function(data){
            var list = data;
            if(list!=null){
                var commentRow = "";
                var isreturn = "";
                var entity_guid = "";
                var limitNum = 20;
                var offsetNum = 10;

                commentRow+="<div id='commentbox"+chkedID+"'>";
                $.each(list, function (i, p) {
 //                   alert(p.ID+"--"+p.Content+"--"+p.Time+"--"+p.Sender+"--"+p.CommentInfo+"--"+p.UserID);
                    if(i<10){
			 var returntab="<table border='0' cellpadding='0' cellspacing='0' align='center' width='522px' id='returntab"+p.ID+"'><tr height='40'><td align='center' colspan='2'><textarea id='returninfo"+p.ID+"' style='overflow:hidden; border:1px #25690c solid; width:470px;'></textarea></td></tr><tr height='30'><td align='left'><input type='checkbox' name='sendtomy' value='1' /><span style='color:#001e02'>&nbsp;同时转发到我的微博</span></td><td align='right'><input type='button' style='background-color:#25690c; color:#FFFFFF' value='评 论' onclick='submitReturn("+chked+","+chkedID+","+p.ID+")' /></td></tr></table>";
                        //alert(p.returnID==""||p.returnID==null);
                        if(p.originalID==""||p.originalID==null){
                            isreturn="";
                        }else{
                            isreturn="";   
                        // isreturn="评论@<font color='#FF6699'>"+p.Sender+"：&nbsp;</font>";
                        }
                     //  p.name= '"'+p.Sender+'"';
			commentRow+="<table style='font-size:14px;'border='0' cellpadding='0' cellspacing='0' align='center' width='96%' id='comment"+p.ID+"'><tr><td  width = '60'valign='top' align='left'><img class='commentUrl' src='"+p.AvatarUrl+"' border='0' /></td><td valign='top'><font color='#25690c' style='cursor:pointer; vertical-align:top'>"+p.Sender+":</font><font style='vertical-align:top ;color:#001e02'>"+isreturn+"&nbsp;"+p.Content+" </font><font color='#25690c'>("+p.Time+")</font></td><td align='right' valign='bottom' width='40'><font color='#25690c' style='cursor:pointer;' onclick='showreturn("+chked+","+chkedID+","+p.ID+")'></font></td><td align='right' valign='bottom' width='40'><font color='#25690c' style='cursor:pointer;' onclick='deleteComment("+chked+","+p.originalID+","+p.ID+","+p.OwnerGuid+")'>删除</font></td></tr><tr><td width='40'></td><td colspan='3' align='right'><div id='return"+p.ID+"' align='right' style='border:0px #25690c solid;width:100%;margin-top:10px;margin-bottom:10px;display=none;'></div></td></tr></table>";
                        entity_guid = p.originalID;
                    }
                });
                commentRow+="</div>";
                if(shownum < commenttotal){
			commentRow+="<span id='firstmore"+chkedID+"' width='96%' style='font-size:14px'><a onclick='moreComments("+entity_guid+","+chked+","+chkedID+","+limitNum+","+offsetNum+","+commenttotal+")'><font color='#25690c' style='cursor:pointer;'>查看更多>>></font></a></span>";
                }
                //commentRow=oldTable+commentRow;
                //e.tip().find('.popover-content')[e.options.html ? 'html' : 'text'](commentRow);
                e.append(oldTable);
                $('#oldTable'+chked).append(commentRow);
            }else{
                e.append(oldTable);
                //e.tip().find('.popover-content')[e.options.html ? 'html' : 'text'](oldTable);
            }		
        });
    }
}
function moreComments(entity_guid,chked,chkedID,limit,offset,commenttotal){
        //alert(limit);
        $.getJSON("admin.php?op=baseinfomgr_weiboAjax&action=getmorecomments",{weiboID:entity_guid,limit:limit,offset:offset},function(data){
            var list = data;
            if(list != null){
                var commentRow = "";
                var isreturn = "";
                var limitNum = limit + 10;
                var offsetNum = offset + 10;
                $.each(list, function (i, p) {
                    //alert(p.ID+"--"+p.ofWeibo+"--"+p.CreateTime+"--"+p.toUserID+"--"+p.CommentInfo+"--"+p.UserID);
                    //alert(p.guid);
                    if(i<10){
			 var returntab="<table border='0' cellpadding='0' cellspacing='0' align='center' width='96%' id='returntab"+p.ID+"'><hr style='margin:0px 0px 5px'/><tr height='40'><td align='center' colspan='2'><textarea id='returninfo"+p.ID+"' style='overflow:hidden; border:1px #25690c solid; width:470px;'></textarea></td></tr><tr height='30'><td align='left'><input type='checkbox' name='sendtomy' value='1' />&nbsp;同时转发到我的微博</td><td align='right'><input type='button' style='background:url(cn/img/weibo/zsc/comment_normal.png); width:58px; height:30px' value='' onclick='submitReturn("+chked+","+chkedID+","+p.ID+")' /></td></tr></table>";
                        //alert(p.returnID==""||p.returnID==null);
                        if(p.originalID==""||p.originalID==null){
                            isreturn="";
                        }else{
                            
                            isreturn="";
                        //isreturn="评论@<font color='#FF6699'>"+p.Sender+"：&nbsp;</font>";
                        }
			commentRow+="<table style='font-size:14px;'border='0' cellpadding='0' cellspacing='0' align='center' width='96%' id='comment"+p.ID+"'><tr ><td  width = '60'valign='top' align='left' ><img class='commentUrl' src='"+p.AvatarUrl+"'  border='0' /></td><td valign='top'><font color='#25690c' style='cursor:pointer; vertical-align:top'>"+p.Sender+":</font><font style='vertical-align:top; color:#001e02'>"+isreturn+p.Content+"</font> <font color='#25690c'>("+p.Time+")</font></td><td align='right' valign='bottom' width='40'><font color='#25690c' style='cursor:pointer;' onclick='deleteComment("+chked+","+p.originalID+","+p.ID+")'>删除</font></td></tr><tr><td width='40'></td><td colspan='3' align='right'><div id='return"+p.ID+"' align='right' style='border:0px #25690c solid;width:100%;margin-top:10px;margin-bottom:10px;display=none;'></div></td></tr></table>";
                    }
                });
                //alert(commentRow);
                if(limit < commenttotal){
			commentRow+="<span id='firstmore"+chkedID+"' width='96%' style='font-size:14px'><a  onclick='moreComments("+entity_guid+","+chked+","+chkedID+","+limitNum+","+offsetNum+","+commenttotal+")'><font color='#25690c' style='cursor:pointer;'>查看更多>>></font></a></span>";
                }
                
                //remove init more link
                var previousmore = "firstmore"+chkedID;
                $('#'+previousmore).remove();
                
                //append more comments
                var commentbox = "commentbox"+entity_guid;
                //alert(commentbox);
                $('#'+commentbox).append(commentRow);
            }
        });
}
function showreturn(chked,weiboID,pID){
	var returndiv=document.getElementById("return"+pID);
	var returntab="<table border='0' cellpadding='0' cellspacing='0' align='center' width='96%' id='returntab"+pID+"'><tr height='40'><td align='center' colspan='2'><textarea id='returninfo"+pID+"' style='overflow:hidden; border:1px #25690c solid; width:470px;'></textarea></td></tr><tr height='30'><td align='left'><input type='checkbox' name='sendtomy' value='1' />&nbsp;同时转发到我的微博</td><td align='right'><input type='button' style='background-color:#25690c; color:#FFFFFF' value='评 论' onclick='submitReturn("+chked+","+weiboID+","+pID+")' /></td></tr></table>";
	if(returndiv.innerHTML==""){
		returndiv.innerHTML=returntab;
	}else{
		returndiv.innerHTML="";
	}
}
function submitComment(chked,chkedID,commentTxt){
    if(chked != -1){
	//var info=document.getElementById("info"+chked).innerText;
	var info=$("#info"+chked).val();
	//alert($("#info"+chked).val());
	if(info==""){
        $('#info'+chked).focus();
            $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">评论不能为空</div></div>').fadeOut(1500);
		return false;
	}

// 	var ischecked = document.getElementById("replytomy"+chked);
//                 if(ischecked.checked){
//                         // -1 reparent comment to reply
//                         submitReply(chkedID,info,-1,"","");
//                 }

	//alert(chked+"--"+chkedID);
	$.getJSON("admin.php?op=baseinfomgr_weiboAjax&action=submitcomment",{weiboID:chkedID,commentText:info},function(data){
		//alert(data);
		if(data){
			//var CommentCount=document.getElementById("popover"+chked).innerText;
            		var checked = "popover"+chked;
			//var CommentCount=$('#'+checked).val();
			var CommentCount=$('#'+checked).text();
			var commenttotal=0;
			var text="";
			if(CommentCount.indexOf("(")!=-1){
				//alert(CommentCount.substr(0,CommentCount.indexOf("(")));
				commenttotal=parseInt(CommentCount.substr(CommentCount.indexOf("(")+1),10)+1;
				text=CommentCount.substr(0,CommentCount.indexOf("("))+"("+commenttotal+CommentCount.substr(CommentCount.indexOf(")"));
			}else{
				commenttotal=1;
				text=CommentCount+"(1)";
			}
			//document.getElementById("popover"+chked).innerText=text;
			$("#popover"+chked).text(text);
			//$("#popover"+chked).val(text);
			setContent1(document.getElementById("popover"+chked),chked,commenttotal,chkedID);
            $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">评论成功</div></div>').fadeOut(1500);
                }else{              
                    $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">评论失败</div></div>').fadeOut(1500);
    
        	}
	});
    }else{
	 $.getJSON("admin.php?op=baseinfomgr_weiboAjax&action=submitcomment",{weiboID:chkedID,commentText:commentTxt},function(data){
                //alert(data);
                if(data){
			//
		}else{
			//
		}
	});
    }
}
function submitReturn(chked,chkedID,pID){
	//var info=document.getElementById("returninfo"+pID).innerText;
	var info=$("#returninfo"+pID).val();
	if(info==""){
		alert("回复不能为空");
		return false;
	}
	//alert(chked+"--"+chkedID+"--"+pID);
	$.getJSON("admin.php?op=baseinfomgr_getAjaxData&action=submitreturn",{ofWeibo:chkedID,CommentInfo:info,returnID:pID},function(data){
		//alert("data=="+data);
		if(data){
			//alert(data);
			//var CommentCount=document.getElementById("popover"+chked).innerText;
			var CommentCount=$("#popover"+chked).val();
			//alert(CommentCount);
			var commenttotal=0;
			var text="";
			if(CommentCount.indexOf("(")!=-1){
				commenttotal=parseInt(CommentCount.substr(CommentCount.indexOf("(")+1),10)+1;
				text=CommentCount.substr(0,CommentCount.indexOf("("))+"("+commenttotal+CommentCount.substr(CommentCount.indexOf(")"));
			}else{
				commenttotal=1;
				text=CommentCount+"(1)";
			}
			//document.getElementById("popover"+chked).innerText=text;
			$("#popover"+chked).val(text);
			setContent1(document.getElementById("popover"+chked),chked,commenttotal,chkedID);
		}
	});
}
function showTooltip(o){
	var e=$(o).data('popover');
	$(o).popover('show');
	//alert(e.getContent());
}

// function submitReply(weiboID,replyText,chkedNum,sinaWireContext,sinaWirePic){
// $("#myModal"+chkedNum).modal('hide');
// //function submitReply(weiboID,replyText,chkedNum){
//     if(chkedNum != -1){
//         var chked = "text"+chkedNum;
//         var replyContent = $('#'+chked).val();
//        // alert(replyContent);
//         if(replyContent==""){
//                 replyContent="转发微博";
//                 //alert("×ª·¢ÄÚÈÝ²»ÄÜÎª¿Õ");
//     //            $('#'+chked).focus();
// 	//			$('#replymsgbox').show().html('转发不能为空').fadeOut(2500);
//      //           $('#'+chked).css("background-color","#FFFFCC");
//      //           return false;
//         }
// 	    var ischecked = document.getElementById("reply2comment"+chkedNum);
//                 if(ischecked.checked){
//                         //alert(ischecked.checked);
//                         // -1 reparent reply to comment
//                         submitComment(-1,weiboID,replyContent);
//                 }     
//         $.getJSON("admin.php?op=baseinfomgr_getAjaxData&action=submitreply",{weiboID:weiboID,replyContent:replyContent},function(data){
//                       //  alert(data+"123");
//                         if(data=="success"){
//       //                  alert("1111");
//                         $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">转发成功</div></div>').fadeOut(1500);
//                         }else{
//                         $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">转发失败</div></div>').fadeOut(1500);
//                         }
//                         $('#'+chked).val('');
//         });
//     }else{
// 	$.getJSON("admin.php?op=baseinfomgr_getAjaxData&action=submitreply",{weiboID:weiboID,replyContent:replyText},function(data){
//                         //alert(data);
//                         if(data=="success"){
//                                 //$('#replymsgbox'+chkedNum).show().html('转发微博成功').fadeOut(2500);
//                         }else{
//                                 //$('#replymsgbox'+chkedNum).show().html('转发微博失败，请重新转发').fadeOut(2500);
//                         }
//                         //$('#'+chked).val('');
//         });
//     }
// 	    var ischecked = document.getElementById("elgg"+chkedNum);
//         if(ischecked){
// 		    if(ischecked.checked){
//             //alert("111asf");
//                 $.getJSON("admin.php?op=baseinfomgr_getAjaxSinaData&action=sendweibo",{saytext:sinaWireContext,picture:sinaWirePic,from:"sina"},function(data){
//                             });
        
//             }   
//         }	
// }
function deleteComment(chked,guid,commentid,ownerGuid){
        /*alert(username+"123");
        if(username != $("#userName").text()){
                alert(username);
                alert($("#userName").text());
            $('#commentmsgbox'+chked).show().html('不能删除他人评论').fadeOut(4500);
        }

        else{*/
        //alert("删除");
        $.getJSON("admin.php?op=baseinfomgr_weiboAjax&action=deletecomment",{weiboID:guid,commentID:commentid,ownerID:ownerGuid},function(data){
                      //  alert(data+"sadf");
                        if(data=="success"){
                            //alert("³É¹¦É¾³ýÆÀÂÛ");
                        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">删除成功</div></div>').fadeOut(1500);

                            //remove this comment
                            var comment = "comment"+commentid;
                            $('#'+comment).remove();

                            //var CommentCount=document.getElementById("popover"+chked).innerText;
                            var checked = "popover"+chked;
                            //var CommentCount=$('#'+checked).val();
                            var CommentCount = $('#'+checked).text();
                            var commenttotal = 0;
                            var text = "";
                            if(CommentCount.indexOf("(")!=-1){
                                //alert(CommentCount.substr(0,CommentCount.indexOf("(")));
                                commenttotal = parseInt(CommentCount.substr(CommentCount.indexOf("(")+1),10)-1;
                                if(commenttotal == 0){
                                    text = CommentCount.substr(0,CommentCount.indexOf("("));
                                }else{
                                    text = CommentCount.substr(0,CommentCount.indexOf("("))+"("+commenttotal+CommentCount.substr(CommentCount.indexOf(")"));
                                }
                            }

                            //document.getElementById("popover"+chked).innerText=text;
                            $("#popover"+chked).text(text);
                            //$("#popover"+chked).val(text);
                        }else if(data=="no"){
                            $('#commentmsgbox'+chked).show().html('不能删除他人评论').fadeOut(4500);
                        }else{
                            //alert("shibai");
                        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">删除失败</div></div>').fadeOut(1500);
                        }
        });
       // }
}

function changeTimeFormat(nS) {
        var timestamp = Date.parse(new Date());
        //alert(timestamp);
        //return new Date(parseInt(nS) * 1000).toLocaleString().replace(/Äê|ÔÂ/g, "-").replace(/ÈÕ/g, " ").replace(/ÐÇÆÚ[Ò»|¶þ|Èý|ËÄ|Îå|Áù|ÈÕ]/g, " ").replace(/Ê±|·Ö/g, "-").replace(/Ãë/g, " ");
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
        //return new Date(parseInt(nS) * 1000).toLocaleString().substr(0,17);
        //·µ»Ø¸ñÊ½£ºyyyy-MM-dd hh:mm

}
function resetImg(id,time,num){
    
    if(num == 1)
        $('#'+id+'img').css("background-image","url(cn/img/weibo/zsc/audioing.gif)");
    else
        $('#'+id+'parentimg').css("background-image","url(cn/img/weibo/zsc/audioing.gif)");

    setTimeout("resetImg1("+id+","+num+")",time*1000);
}
function resetImg1(id,num){
    if(num == 1)
        $('#'+id+'img').css("background-image","url(cn/img/weibo/zsc/audio.png)");
    else
        $('#'+id+'parentimg').css("background-image","url(cn/img/weibo/zsc/audio.png)");
}
function changeImage(id,imageid,src,largeSrc){
    var img = document.getElementById(imageid).src
    if (img == src){
        document.getElementById(imageid).style.cursor = "url('cn/img/weibo/zsc/cursor_jian.cur')";
        document.getElementById(imageid).src = largeSrc;
    }else{
        document.getElementById(imageid).style.cursor = "url('cn/img/weibo/zsc/cursor_jia.cur')";
        document.getElementById(imageid).src = src;
        if($(window).scrollTop() > $('#tr'+id).position().top)
            window.scrollTo(0,$('#tr'+id).position().top);
    }
}


function jump(order)
{
            document.formJump.submit();
}
//getListenCount();
if (!NeuF) var NeuF = {};
NeuF.ScrollPage = function (obj, options, callback) {
        var _defaultOptions = { delay: 500, marginBottom: 100 }; //默认配置：延迟时间delay和滚动条距离底部距离marginBottom
        options = $.extend(_defaultOptions, options);
        this.isScrolling = false; //是否在滚动
        this.oriPos = 0; //原始位置
        this.curPos = 0; //当前位置
        var me = this; //顶层
        var $obj = (typeof obj == "string") ? $("#" + obj) : $(obj);
        //绑定滚动事件
        $obj.scroll(function (ev) {
                        if($(window).scrollTop() > 10){
                            $('#backTop').show();
                        }else{
                            $('#backTop').hide();
                        }
                        me.curPos = $obj.scrollTop();
                        if ($(window).height() + $(window).scrollTop() >= $(document.body).height() - options.marginBottom) {
                        if (me.isScrolling == true) return;
                        me.isScrolling = true;
                        setTimeout(function () { me.isScrolling = false; }, options.delay);   //重复触发间隔毫秒
                        if (typeof callback == "function") callback.call(null, me.curPos - me.oriPos);
                        };
                        me.oriPos = me.curPos;
                        });
};
$(function () {
                var ap = "";
                var ap1 = "";
                window.scrollTo(0, 0); //每次F5刷新把滚动条置顶
                //marginBottom表示滚动条离底部的距离，0表示滚动到最底部才加载，可以根据需要修改  
                new NeuF.ScrollPage(window, { delay: 1000, marginBottom: 0 }, function (offset) {
                    
                        if(scrollTime  >= 2){
                            return ;
                        }
                        if(scrollTime == 0 ){
                            min = $("#min").text();
                            time = 1;
                        }else if(scrollTime ==1){
                            time = 2;
                        }
                        if (offset > 0) {
                        var pageCount = $("#pageCount").text();
                        var hasNext = $("#hasNext").text();
                        var userstatus=$("#user_status").text();
                      
                        
                        if( hasNext == 0){
                            return;
                        }
                        $("#Loading").show(); //加载提示
                        setTimeout(function () {
                                //这里就是异步获取内容的地方，这里简化成一句话，可以根据需要修改
                               //  alert(min);
                                 $.getJSON("admin.php?op=baseinfomgr_myWeiboList&action=more&min="+min+"&page="+pageCount+"&time="+time,{},function(da){ 
//                                  $.get("admin.php?op=baseinfomgr_myWeiboList&action=more&min="+min+"&page="+pageCount+"&time="+time,{},function(da){  
                                     //alert(da); 
                                     if(da){ 
                                        scrollTime++;
                                        if(pageCount > 1 && hasNext == 0 ){
                                            $('#nextPage').show();
                                        }
                                        if(da['nowires'] == 1){
                                           $("#Loading").html("亲，没有微博了"); //加载提示
                                           return;
                                        }
                                        
                                        $('#hasNext').html(da['hasNext']);
                                        
                                        min = da['weiboList'][da['weiboList'].length-1].ID; 
                                        $('#nextPageSpan').html(""+da['pageLink']);
                                        if(time == 2 || pageCount != 1 &&  da['hasNext'] == 0){
                                            $('#nextPage').show();
                                        }
                                        
            ap = "";                   var data = da['weiboList']; 
            
                                       for(var i = 0; i< data.length; i++){
		ap+=	"<tr id='tr"+data[i].num+"'>"+
				    "<td align='right'  width='10%' valign='top'>"+
            		        "<a rel='popover' id='tooltip"+data[i].num+"'><img class='imgs' src='"+data[i].AvatarUrl+"' id='senderPic' height='50px' width='50px' /></a>"+
		    	    "</td>"+
				    "<td align='left' valign='top'>"+
            		    "<table width='100%' border='0' cellpadding='0' cellspacing='0' align='left' style='line-height:200%'>"+
                        "<tr>"+
                    		"<td colspan='2'><b><font style='font-family:Microsoft YaHei;' size='3.5px'>"+
                            "<span>"+data[i].Sender+"</span>&nbsp;&nbsp;"+
                            "<span id = "+data[i].num+"topImage>";
                            if(data[i].TopStatus == "top")
                 ap +=      "<img class='top' src='<{$img}>/weibo/zsc/top.png'>&nbsp;&nbsp;";
                 ap +=      "</span>"+
                            "<span  id = "+data[i].num+"tagImage>" ;
                            if(data[i].IsTag ==1 )
                 ap +=      "<img class='top' src='<{$img}>/weibo/zsc/marked.png'>&nbsp;&nbsp";
                 ap +=      "</span>"+
                            "<span id = "+data[i].num+"readImage>" ;
                            if(data[i].IsRead ==1)
                 ap +=      "<img class='top' src='<{$img}>/weibo/zsc/broadcasted.png'>&nbsp;"; 
                 ap +=       "</span>"+      
                            "</font></b></td>"+
                    	"</tr>"+
                    	"<tr>"+
                    		"<td colspan='2'><font color='#001e02' face='SimSun' size='3.5px'>"+data[i].Content+"</font></td>"+
                    	"</tr>";
                 //--------------------------------------------- lichun 添加pics show--Start-2014.11.07 -7/7-----------------------------
   				if (data[i].Pics != null ){
          			if (data[i].Pic!= null){
          	ap += "<tr>"+
          		"<td colspan='2'><img style=\"padding-bottom: 8px; display:none;cursor: url('cn/img/weibo/zsc/cursor_jian.cur')\" id='image_large"+data[i].num+"' src=''	onClick=\"$(this).hide();$('#image_div"+data[i].num
          		+"').show();\" /><div id='image_div"+data[i].num+"' style='padding: 5px;width:320px;height: auto; min-height: 70px;'><img style=\"position:relative;padding-bottom: 8px; cursor: url('cn/img/weibo/zsc/cursor_jia.cur')\" class='img_show' src='"+data[i].Pic
          		+"' onClick=\"show_images("+data[i].num+",'"+data[i].PicLarge+"')\" />";
 					
          				for (var j=0; j<=7; j++){
              				if (data[i].Pics[j] !=null ){
 				ap += "<img style=\"position:relative;padding-bottom: 8px; cursor: url('cn/img/weibo/zsc/cursor_jia.cur')\"	class='img_show' src='"+data[i].Pics[j]+"' onClick=\"show_images("+data[i].num+",'"+data[i].PicLarges[j]+"')\" />";
 			            		} //end if 
                  		}//end if
         			  ap += "</div></td></tr>";
                  	}//end if
             
             		} else if (data[i].Pic!=null){
              ap += "<tr><td><img	style=\"padding-bottom: 8px; cursor: url('cn/img/weibo/zsc/cursor_jia.cur')\" id='image"+data[i].num+"' src='"+data[i].Pic+"' onClick=\"changeImage("+data[i].num+",'image"+data[i].num+"','"+data[i].Pic+"','"+data[i].PicLarge+"')\" /></td></tr>";
 					}//end if-else             
              //--------------------------------------------- lichun 添加pics show--End--2014.11.07 -7/7-----------------------------
                    	
                   		if (data[i].Audio != null){
                 ap += 	"<tr>"+
                    		"<td><a style='cursor:pointer;color:#3b3b3b;text-decoration:none;' href='"+data[i].Audio+"' ><div id ='"+data[i].ID+"img' style='background:url(cn/img/weibo/zsc/audio.png) no-repeat; width:60px; height:40px' onClick='resetImg("+data[i].ID+","+data[i].AudioLen+",1)'><span valign='bottom' style='position:relative;top:4px;margin-left:34px;font-size:11px'>"+data[i].AudioLen+"\"</span></div></a></td>"+
                            "<td><span style=\"float:right;font-size:13px;position:relative;bottom:2px;right:450px;\"><a title=\"下载\" onclick=\"download_img('"+data[i].Audio+"')\" style='cursor:pointer;color:#25690c'>下载</a></span></td>"+
                    	"</tr>";}
                        if (data[i].notice != null){
			     ap +=  "<tr>"+
				            "<td>"+
				            "<div style='border-width:1px;border-style:solid;border-color:#D9D9D9;padding:10px 20px;margin:5px 0px;'>"+
				                "<table width='100%'>"+
				                    "<tr><td><font face='SimSun' size='2.5px' ><strong>"+data[i].notice+"</strong></font></td></tr>"+
				               "</table>"+
				            "</div>"+
				            "</td>"+
			            "</tr>";}
			            if (data[i].retweetedUsername != null){
			       ap += "<tr>"+
				            "<td>"+
				            "<div style=\"border-width:1px;border-style:solid;border-color:#D9D9D9;padding:10px 20px;margin:5px 0px;\">"+
				                "<table width=\"100%\">"+
				                    "<tr><td><font face=\"SimSun\" size=\"2.5px\" ><strong>@"+data[i].retweetedUsername+"</strong></font></td></tr>"+   
				                    "<tr><td><font color=\"#001e02\" face=\"SimSun\" size=\"2.5px\">"+data[i].retweetedContent+"</font></td></tr>";
				     //--------------------------------------------- lichun 添加pics show--Start--2014.11.07 -7/7-----------------------------
		           if (data[i].retweetedPics != null ){
	          			if (data[i].retweetedPic!= null){
	          	    ap += "<tr>"+
	          		"<td colspan='2'><img style=\"padding-bottom: 8px;display:none; cursor: url('cn/img/weibo/zsc/cursor_jian.cur')\" id='retweetedimage_large"+data[i].num+"' src=''	onClick=\"$(this).hide();$('#retweetedimage_div"+data[i].num
	          		+"').show();\" /><div id='retweetedimage_div"+data[i].num+"' style='padding: 5px;width:320px;height: auto; min-height: 70px;'><img style=\"position:relative;padding-bottom: 8px; cursor: url('cn/img/weibo/zsc/cursor_jia.cur')\" class='img_show' src='"+data[i].retweetedPic
	          		+"' onClick=\"show_retweetedimages("+data[i].num+",'"+data[i].retweetedPicLarge+"')\" />";
						
	          				for (var j=0; j<=7; j++){

	              					if (data[i].retweetedPics[j] !=null ){
					ap += "<img style=\"position:relative;padding-bottom: 8px; cursor: url('cn/img/weibo/zsc/cursor_jia.cur')\"	class='img_show' src='"+data[i].retweetedPics[j]+"' onClick=\"show_retweetedimages("+data[i].num+",'"+data[i].retweetedPicLarges[j]+"')\" />";
				            		} //end if 
	                  		}//end for
	          				ap += "</div></td></tr>";
	                  	}//end if
	              
	             		} else if (data[i].retweetedPic!=null){
	              ap += "<tr><td colspan='2'><img	style=\"padding-bottom: 8px; cursor: url('cn/img/weibo/zsc/cursor_jia.cur')\" id='retweetedimage"+data[i].num+"' src='"+data[i].retweetedPic+"' onClick=\"changeImage("+data[i].num+",'retweetedimage"+data[i].num+"','"+data[i].retweetedPic+"','"+data[i].retweetedPicLarge+"')\" /></td></tr>";
						}//end if-else 
	             //--------------------------------------------- lichun 添加pics show--End--2014.11.07 -7/7-----------------------------		     
			    
					
                   				if (data[i].retweetedAudio != null){
                        ap +=       "<tr>"+
                    		            "<td ><a style=\"cursor:pointer;color:#3b3b3b;text-decoration:none;\" href=\""+data[i].retweetedAudio+"\" ><div id =\""+data[i].ID+"parentimg\" style='background:url(cn/img/weibo/zsc/audio.png) no-repeat; width:60px; height:40px' onClick=\"resetImg("+data[i].ID+","+data[i].retweetedAudioLen+",2)\"><span valign=\"bottom\" style=\"position:relative;top:4px;margin-left:34px;font-size:11px\">"+data[i].retweetedAudioLen+"\"</span></div></a></td>"+
                                        "<td><span style=\"float:right;font-size:13px;position:relative;bottom:2px;right:406px;\"><a title=\"下载\" onclick=\"download_img('"+data[i].retweetedAudio+"')\" style='cursor:pointer;color:#25690c'>下载</a></span></td>"+
                                    "</tr>";
                                    }
				        ap +=       "<tr><td>"+
                          		        "<span><font color=\"#69a155\" size=\"2.5px\" face=\"SimSun\">"+data[i].retweetedTime+"</font></span>"+
                                        "&nbsp;&nbsp;<font color=\"#69a155\" face=\"SimSun\" size=\"2.5px\">来自</font>"+
                          		        "<font style=\"color:#69a155\" size=\"2.5x\">新媒体互动广播</font>"+
                                        "<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"<{$img}>/weibo/zsc/reply_number.png\" />&nbsp;("+data[i].retweetedReplyCount+")</span>"+
                                    "<span>&nbsp;&nbsp;<img src=\"<{$img}>/weibo/zsc/comment_number.png\" />&nbsp;("+data[i].retweetedCommentCount+")</span>"+
				                    "</td></tr>"+
				               "</table>"+
				            "</div>"+
				            "</td>"+
			            "</tr>";
			            }
                  ap +=  "<tr>"+
                    		"<td colspan=\"3\" style=\"font-size:12px\">"+
                         		"<font color=\"#69a155\" size=\"2.5px\">"+data[i].Time+"</font>"+
                          		"&nbsp;&nbsp;<font color=\"#69a155\" size=\"2.5px\">来自</font>"+
                          		"&nbsp;<font color=\"#69a155\" size=\"2.5px\">新媒体互动广播</font>"+
                        	"</td>"+
                        "</tr>"+
                    	"<tr>"+                    		
                        	"<td align=\"right\" colspan=\"3\">"+ 
                            "<span style='font-size:14px'>";                       
                         ap +=  "<a titile='评论' id=\"popover"+data[i].num+"\" style=\"cursor:pointer;color:#25690c\" onClick=\"setContent1(this,'"+data[i].num+"','"+data[i].CommentCount+"','"+data[i].ID+"',1)\">评论";
//                        <a title="评论" id="popover<{$weiboList[index].num}>" rel="popover" data-placement="0" data-html="true" data-content="" style="cursor:pointer;color:#25690c" onClick="setContent1(this,'<{$weiboList[index].num}>','<{$weiboList[index].CommentCount}>','<{$weiboList[index].ID}>')">评论<{if $weiboList[index].CommentCount>0 }>(<{$weiboList[index].CommentCount}>)<{/if}></a>&nbsp;&nbsp;</span>
                    if(data[i].CommentCount>0)
                    ap +=   "("+data[i].CommentCount+")";                  
                    ap +=   "</a></span></td>"+
                 "</tr>"+
                 "<tr><td><div id='commentDiv"+data[i].num+"'></div></td></tr>"+
                 "<tr><td colspan='2'><hr/></td></tr>";
                  
                 ap +=     "</table></td></tr>";

                                       
                                       }
                                        $("#Loading").hide(); //加载提示
                                        $("#last").append($(ap));
                                    
                                    }
                                 });
                                }, 1000);
                        }
                        });
                    });
//timeEvent = setInterval(getListenCount, 5000);
function download_img(url){
    var url = url.substr(0,url.length - 4);
    window.location.href ='admin.php?op=baseinfomgr_download&url='+url;
}
// //--------------------------------------------- lichun 添加 topic Start 2014.11.05 -1/4----div-2------------------------------

// //--------------------------------------------- lichun 添加 topic End 2014.11.05 ---1/4----div-2-$weiboList[index].Pics------------------


//--------------------------------------------- lichun 添加pics show 2014.11.06 -1/7---2-style-3-div-$weiboList[index].Pics--$weiboList[index].retweetedPics------
//show large pic of wire
//zhb_pic
function show_images(id,largeSrc){
	 var img = document.getElementById('image_large'+id); 	 
	  img.onload = function () {
      $('#image_div'+id).hide();
      img.style.cursor="url('cn/img/weibo/zsc/cursor_jian.cur')";
     $('#image_large'+id).show();
	  };
    
	  img.src = largeSrc;
}
//show large pic for the parent of wire
function show_retweetedimages(id,largeSrc){
	var img = document.getElementById('retweetedimage_large'+id); 	 
	  img.onload = function () {
      $('#retweetedimage_div'+id).hide();
      img.style.cursor="url('cn/img/weibo/zsc/cursor_jian.cur')";
     $('#retweetedimage_large'+id).show();
	  };
    
	  img.src = largeSrc;	
}s
//--------------------------------------------- lichun 添加 pics show 2014.11.06 ---1/7---2-style----3-div-$weiboList[index].Pics--$weiboList[index].retweetedPics-------

//--------------------------------------------- lichun 添加 pics upload 2014.11.07 -Start--1/4-----2 div---3style--4upload-
//show the upload div	
function upload_image_show(){
	if( $("#topic_list_add")[0].style.display != 'none' ){
		$("#topic_list_add").hide();
	}	
	$("#upload_image_div").toggle();    
}
//delete one picture
function delete_image(x){
	//alert(count);
	if (x==''){
		var id = 1;
		for (; id<= 9; id++){
			if ($("#single_image_div"+id)[0].style.display != 'none'){
				if ( $("#single_image"+id).attr('src') !=''){
					//alert(id);
					$("#single_image"+id).attr('src','');
				}
				count--;
				$("#single_image_div"+id)[0].style.display='none';
			}
		}
		$("#upload_image_div").css('display','none');
	} else {
		//alert(x);
		$("#single_image+x").attr("src","");
		count--;
		//alert('count:'+count);
		//alert(count);
		if ( count == 9 ){
			$("#upload_img_div").show();
		}
		$('#single_image_div'+x).css('display','none');
	}
}
//show the error type of picture
function error_image(){
$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">图片格式不正确</div></div>').fadeOut(2000);
}
//upload multi-images 
count = 1;
function upload_image(){
	//alert('count:'+count);
	if (count== 9){
		//$("#upload_img_div").css("display","none");
		$("#upload_img_div").hide();
	}
	if(count<= 9){
		//alert(document.getElementById("upload_img_id").value);
		var findid = 1;
		for (; findid<= 9; findid++){
			if ($("#single_image_div"+findid)[0].style.display == 'none'){
				$("#upload_img_id").val(findid);
				//alert(document.getElementById("upload_img_id").value);
				break;
			} else {
				//alert("alreadydisplay");
			}
		}
		document.upload_form.submit();			
		$("#single_image"+findid).attr("src","cn/img/scroll3_small.gif");
		var file = $("#upload_img");
  		file.after(file.clone().val("")); 
  		file.remove();
		count++;
	}
}
//get the url package of pictures
function urls_image(){
	var urls='';
	//alert(urls);
	var id = 1;
	for (; id<= 9; id++){
		if ($("#single_image_div"+id)[0].style.display != 'none'){
			if ( $("#single_image"+id).attr('src') !=''){
				url = $("#single_image"+id).attr('src')+';';
				urls = urls+url;
			}
		}
	}
	//alert(urls);
	return urls;
}
//--------------------------------------------- lichun 添加 pics upload 2014.11.07 -End--1/-----2 div------

</script>
</head>
<body>
<div id="topic_tips" style="display:none;margin-left:280px">
      <table id="tips_table">
      </table>
</div>
<div align='center' style="margin-top:-30px">
<table>
<tr><td valign='top' align='left'>
<table style="margin-left:8px">
        <tr><td>
            <div align="left" id="title"><img src="<{$img}>/weibo/zsc/xinxianshi.png"/>
                <span style="display:none"><img src="cn/img/weibo/zsc/send_hover.png" /></span>
                <span style="display:none"><img src="cn/img/weibo/zsc/add_down.png" /></span>
                <span style="display:none"><img src="cn/img/weibo/zsc/cancel_down.png" /></span>
                <span style="display:none"><img src="cn/img/weibo/zsc/back_down.png" /></span>
                <span style="display:none"><img src="cn/img/weibo/zsc/top_normal.png" /></span>
                <span style="display:none"><img src="cn/img/weibo/zsc/transmit_unable.png" /></span>
            </div>
        </td></tr>     
            <tr><td><textarea id="sendBox" class="sendBox" rows="5" onfocus="last()"></textarea></td></tr>
                <tr>
                  <td>
                     <div id="sendHandle" style="color:#25690c;position:relative;z-index:100;" align="left">
                        <span style="padding-right:15px;" ><a id="face"  title="表情" ><img  src="cn/img/face_2.png"/>表情</a></span>
                        
                        <!--   ------------------lichun -----pics upload 20141109-Start-------->
                        <span style="padding-right:15px;" onClick="upload_image_show()"><img src="cn/img/upload_img.png" /><a   title="图片" onmouseover="this.style.color='#69a155'" onmouseout="this.style.color='#25690c'">图片</a></span>
						<div id='upload_image_div' style='display:none;z-index:100;cursor:default;width:280px;height:auto;min-height:100px;background:#fff;border-style:solid;border-width:2px;border-color:#DEDEDE;position:absolute;top:26px;left:0px;'>
            				<div style="background:#f2f2f2;height:25px;font-size:12px;">
                				<div style="float:left;font-weight:700;color:#333;padding-left:10px;">本地上传</div>
                				<div id="pic_close"  style="float:right;margin-right:20px;" align="center"><a  onClick="delete_image('')" style='cursor:pointer;color:#25690c;background-color:#DEDEDE;' onmouseover="this.style.color='#69a155'" onmouseout="this.style.color='#25690c'">&times;</a></div>
            				</div>
            				<div style="padding-left:5px;padding-right:5px;padding-top:5px;padding-bottom:5px;height:auto;min-height:70px;">
			                <form name="upload_form" id="upload_form" method="post" target="upload_frame" enctype="multipart/form-data">
			                   <iframe id="upload_frame" name="upload_frame" style="display:none"></iframe>
			                   <input id='upload_img_id' name ='upload_img_id'  style="display:none;" type='text' value="" readonly='readonly' unselectable="on"/>
			                   
			                   <{section name=n loop=10 start=1}>
			                   <div id="single_image_div<{$smarty.section.n.index}>" class="single_img_div" style="display:none" onMouseOver="$('#pic_close<{$smarty.section.n.index}>').show();" onMouseOut="$('#pic_close<{$smarty.section.n.index}>').hide();">
			                    	<div id="pic_close<{$smarty.section.n.index}>" class="pics_close"   >
			                    		<a  class="img_del" onClick="delete_image('<{$smarty.section.n.index}>')" onmouseover="this.style.color='#000000'" onmouseout="this.style.color='#25690c'" >&times;</a>
			                    	</div>
			                        <img id='single_image<{$smarty.section.n.index}>' class="img_show" src='' onLoad="$('#single_image_div<{$smarty.section.n.index}>').css('display','inline');"/>
			                  	</div>		                   
			                   <{/section}>
			                  	<div id="upload_img_div" style="float:left;display:block;margin:2px 2px;width:85px;height:85px;cursor:pointer;position:relative;background:url(cn/img/image_add1.png);" onMouseOver="$('#upload_img_div').css('background','url(cn/img/image_add2.png)')" onMouseOut="$('#upload_img_div').css('background','url(cn/img/image_add1.png)')"> 
				               		
				               		<input type="file" id="upload_img" name="upload_img" style="filter:alpha(opacity=0);width:80px;height:85px;" onchange="upload_image();" />
				               </div>
			                </form>
            			</div>
        			</div>
        			<!--   ------------------lichun -----pics upload 20141109-End-------->
        			<!--   ------------------lichun -----topic 20141109-Start-------->
        			 
                    <!--   ------------------lichun -----topic 20141109-End-------->    
                     
                        
                              
                          <span style="font-size:16px;resize:none;"> <span class="countTxt" id='haikeyi'>还可以输入  </span><strong id="maxNum">140</strong><span>个字</span></span>
                          <input type="checkbox" id="sendcheckbox" name="sendtomy" value="1" checked="checked" /><span style="color:#25690c" id='sendxinlang'>同时发布到新浪微博</span>
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <input id="sendBtn" type="button" value="" onMouseOver="$('#sendBtn').css('background-image','url(cn/img/weibo/zsc/send_hover.png)')" onMouseOut="$('#sendBtn').css('background-image','url(cn/img/weibo/zsc/send_normal.png)')"/>
                         
                    </div>    
                    </td>                 
                </tr>
</table>
<br>
<br>
<div align='left' style='padding-left:9px'><img width="572px" height="20px" src="<{$img}>/weibo/zsc/weiboceshi.png"/></div>
<br>
<table cellSpacing="1" width="620px" bgColor="#afafaf" border="0">
    <tr>
		<td>
        <table  id ="last" style="FONT-SIZE: 9pt; COLOR: #25690c; FONT-FAMILY: Tahoma" cellSpacing="0" cellPadding="5" width="100%" bgColor="#d0deec" border="0">
	<{if $isExistData != null}>
		<tr><td align="middle">没有记录</td></tr>
	<{else}>
        <{section name=index loop=$weiboList}>
			<tr id="tr<{$weiboList[index].num}>">
				<td align="right" bgColor="#ffffff" width="10%" valign="top">
            		<a rel="popover" id="tooltip<{$weiboList[index].num}>"><img class="imgs"src="<{$weiboList[index].AvatarUrl}>" id="senderPic" height="50px" width="50px" /></a>
		    	</td>
				<td align="left" bgColor="#ffffff" valign="top">
            		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left" style="line-height:200%">
                		<tr>
                    		<td colspan="2"><b><font face="SimHei" size="3.5px">
                            <span><{$weiboList[index].Sender}></span>
                            <span id = "<{$weiboList[index].num}>topImage" style="width:42px">
                            <{if $weiboList[index].TopStatus == "top"}>
                            <img  src="<{$img}>/weibo/zsc/top.png" />
                            <{/if}>
                            </span>
                            <span id = "<{$weiboList[index].num}>tagImage">
                            <{if $weiboList[index].IsTag == 1}>
                            <img  src="<{$img}>/weibo/zsc/marked.png" />
                            <{/if}>
                            </span>
                            <span id = "<{$weiboList[index].num}>readImage">
                            <{if $weiboList[index].IsRead == 1}>
                            <img  src="<{$img}>/weibo/zsc/broadcasted.png"/>
                            <{/if}>
                            </span>
                            </font></b></td>
                    	</tr>
                    	<tr>
                    		<td colspan="2"><font color="#001e02" face="SimSun" size="3.5px"><{$weiboList[index].Content}></font></td>
                    	</tr>
                   		
                    	<!--   ------------------lichun -----pics show 20141109-Start-------->
                   		<{if $weiboList[index].Pics!=""}>
                    		<{if $weiboList[index].Pic!=""}>
                    	<tr>
                    	
                    		<td colspan="2">
                    		
                    		<img
                                     style="display:none;position:relative;padding-bottom: 8px;display:none; cursor: url('cn/img/weibo/zsc/cursor_jian.cur')"
                                    id="image_large<{$weiboList[index].num}>"
                                    src="<{$img}>/weibo/zsc/picture.png" onClick="$(this).src='<{$img}>/weibo/zsc/picture.png';$(this).hide(); $('#image_div<{$weiboList[index].num}>').show();" />	
                    		<div id="image_div<{$weiboList[index].num}>" style="padding: 5px;width:320px;height: auto; min-height: 70px;">
								<img
									style="position:relative;padding-bottom: 8px; cursor: url('cn/img/weibo/zsc/cursor_jia.cur')"
									class='img_show' src="<{$weiboList[index].Pic}>"
									onClick="show_images(<{$weiboList[index].num}>,'<{$weiboList[index].PicLarge}>')" />
								<{section name=i loop=$weiboList[index].Pics max=8}>								 
									<{if $weiboList[index].Pics[i]!=""}> 
										<img style="position:relative;padding-bottom: 8px; cursor: url('cn/img/weibo/zsc/cursor_jia.cur')"																	 
											 class='img_show' src="<{$weiboList[index].Pics[i]}>"
									         onClick="show_images(<{$weiboList[index].num}>,'<{$weiboList[index].PicLarges[i]}>')" />				
									<{/if}> 
								<{/section}>
							</div>
						</td>
						</tr>
							<{/if}>
						<{elseif $weiboList[index].Pic!=""}>
						<tr><td>
								<img
									style="padding-bottom: 8px; cursor: url('cn/img/weibo/zsc/cursor_jia.cur')"
									id="image<{$weiboList[index].num}>"
									src="<{$weiboList[index].Pic}>"
									onClick="changeImage(<{$weiboList[index].num}>,'image<{$weiboList[index].num}>','<{$weiboList[index].Pic}>','<{$weiboList[index].PicLarge}>')" />
						</td></tr>
                    	<{/if}>
 <!--   ------------------lichun -----pics show 20141109-End-------->  
                   		<{if $weiboList[index].Audio!=""}>
                    	<tr>
                    		<td ><a style="color:#3b3b3b;text-decoration:none;" href="<{$weiboList[index].Audio}>" ><div id ="<{$weiboList[index].ID}>img" style='cursor:pointer;background:url(cn/img/weibo/zsc/audio.png) no-repeat; width:60px; height:40px' onClick="resetImg(<{$weiboList[index].ID}>,<{$weiboList[index].AudioLen}>,1)"><span valign="bottom" style="position:relative;top:4px;margin-left:34px;font-size:11px"><{$weiboList[index].AudioLen}>"</span></div></a></td>
                            <td>
                                <span style="float:right;font-size:13px;position:relative;bottom:2px;right:450px;"><a title="下载" onclick="download_img('<{$weiboList[index].Audio}>')" style='cursor:pointer;color:#25690c'>下载</a></span>
                            </td>
                    	</tr>
                    	<{/if}>
                        <{if $weiboList[index].notice!=""}>
			            <tr>
				            <td>
				            <div style="border-width:1px;border-style:solid;border-color:#D9D9D9;padding:10px 20px;margin:5px 0px;">
				                <table width="100%">
				                    <tr><td><font face="SimSun" size="2.5px" ><strong><{$weiboList[index].notice}></strong></font></td></tr>
				               </table>
				            </div>
				            </td>
			            </tr>
                        <{/if}>
			            <{if $weiboList[index].retweetedUsername!=""}>
			            <tr>
				            <td>
				            <div style="border-width:1px;border-style:solid;border-color:#D9D9D9;padding:10px 20px;margin:5px 0px;">
				                <table width="100%">
				                    <tr><td><font face="SimSun" size="2.5px" ><strong>@<{$weiboList[index].retweetedUsername}></strong></font></td></tr>
				                    <tr><td><font color="#001e02" face="SimSun" size="2.5px"><{$weiboList[index].retweetedContent}></font></td></tr>
			                        
				                    <!--   ------------------lichun -----pics show 20141109-Start------->		                        
                                    <{if $weiboList[index].retweetedPics!=""}>
                    				<{if $weiboList[index].retweetedPic!=""}>
                    	<tr>
                    		<td colspan="2">
                    		
                    		<img
									style="padding-bottom: 8px; display:none;cursor: url('cn/img/weibo/zsc/cursor_jian.cur')"
									id="retweetedimage_large<{$weiboList[index].num}>"
									src=""
									onClick="$(this).hide();$('#retweetedimage_div<{$weiboList[index].num}>').show();" />
                    		
                    		<div id="retweetedimage_div<{$weiboList[index].num}>" style="padding: 5px;width:320px;height: auto; min-height: 70px;">
								<img
									style="position:relative;padding-bottom: 8px; cursor: url('cn/img/weibo/zsc/cursor_jia.cur')"
									class='img_show' src="<{$weiboList[index].retweetedPic}>"
									onClick="show_retweetedimages(<{$weiboList[index].num}>,'<{$weiboList[index].retweetedPicLarge}>')" />

								<{section name=i loop=$weiboList[index].retweetedPics max=8}>								 
									<{if $weiboList[index].retweetedPics[i]!=""}> 
										<img style="position:relative;padding-bottom: 8px; cursor: url('cn/img/weibo/zsc/cursor_jia.cur')"																	 
											 class='img_show' src="<{$weiboList[index].retweetedPics[i]}>"
									         onClick="show_retweetedimages(<{$weiboList[index].num}>,'<{$weiboList[index].retweetedPicLarges[i]}>')" />				
									
									<{/if}> 
								<{/section}>
							</div>
						</td>
						</tr>
						<{/if}>
						<{elseif $weiboList[index].retweetedPic!=""}>
						<tr>
						<td colspan="2">
						<img style="padding-bottom:8px;cursor:url('cn/img/weibo/zsc/cursor_jia.cur')" id="retweetedimage<{$weiboList[index].num}>" src="<{$weiboList[index].retweetedPic}>" onClick="changeImage(<{$weiboList[index].num}>,'retweetedimage<{$weiboList[index].num}>','<{$weiboList[index].retweetedPic}>','<{$weiboList[index].retweetedPicLarge}>')"/>
						</td>
						</tr>     
                    	<{/if}>
                                    
     <!--   ------------------lichun -----pics show 20141109-End------->  
				                    
                                    <{if $weiboList[index].retweetedAudio!=""}>
                                    <tr>
                    		            <td ><a style="cursor:pointer;color:#3b3b3b;text-decoration:none;" href="<{$weiboList[index].retweetedAudio}>" ><div id ="<{$weiboList[index].ID}>parentimg" style='background:url(cn/img/weibo/zsc/audio.png) no-repeat; width:60px; height:40px' onClick="resetImg(<{$weiboList[index].ID}>,<{$weiboList[index].retweetedAudioLen}>,2)"><span valign="bottom" style="position:relative;top:4px;margin-left:34px;font-size:11px"><{$weiboList[index].retweetedAudioLen}>"</span></div></a></td>
                                        <td>
                                            <span style="float:right;font-size:13px;position:relative;bottom:2px;right:406px;"><a title="下载" onclick="download_img('<{$weiboList[index].retweetedAudio}>')" style='cursor:pointer;color:#25690c'>下载</a></span>
                                        </td>
                                    </tr>
                                    <{/if}>
				                    <tr><td>
                          		        <span><font color="#69a155" size="2.5px" face="SimSun"><{$weiboList[index].retweetedTime}></font></span>
                                        &nbsp;&nbsp;<font color="#69a155" face="SimSun" size="2.5px">来自</font>
                          		        <font style="color:#69a155" size="2.5x">新媒体互动广播</font>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<{$img}>/weibo/zsc/reply_number.png" />&nbsp;(<{$weiboList[index].retweetedReplyCount}>)</span>
                                    <span>&nbsp;<img src="<{$img}>/weibo/zsc/comment_number.png" />&nbsp;(<{$weiboList[index].retweetedCommentCount}>)</span>
				                    </td></tr>
				               </table>
				            </div>
				            </td>
			            </tr>
			            <{/if}>
                        <tr>
                    		<td colspan="3" style="font-size:12px">
                         		<font color="#69a155" size="2.5px"><{$weiboList[index].Time}></font>
                          		&nbsp;&nbsp;<font color="#69a155" size="2.5px">来自</font>
                          		&nbsp;<font color="#69a155" size="2.5px">新媒体互动广播</font>
                        	</td>
                        </tr>
                    	<tr>                    		
                        	<td align="right" colspan="3"> 
                        		<span style="font-size:14px">                      
                            	<a title="评论" id="popover<{$weiboList[index].num}>" style="cursor:pointer;color:#25690c" onClick="setContent1(this,'<{$weiboList[index].num}>','<{$weiboList[index].CommentCount}>','<{$weiboList[index].ID}>',1)">评论<{if $weiboList[index].CommentCount>0 }>(<{$weiboList[index].CommentCount}>)<{/if}></a>
                            	</span>
                                </td>
                    	</tr>
                        <tr><td><div id='commentDiv<{$weiboList[index].num}>'></div></td></tr>
                        <tr><td colspan="2"><hr></td></tr>
                    	
                	</table>
		    	</td>
	      	</tr>
        	<{/section}>	  
		<{/if}>
		</table>
		</form>
		</td>
	</tr>
    <tr><td>
    <{if $hasNext == 0 && $page > 1}>
    <table  id = "nextPage" style = "display" border="0" width="100%" cellspacing="0" cellpadding="0" id="table140" height="25">
           <tr>
             <td valign="center" align="right">
             <p style="line-height: 16px;"><font face="Tahoma"> 
             <span style="font-size: 10pt" class="pagecount" id = "nextPageSpan"><{$page_string}>
             </span></font>&nbsp;&nbsp;
            </td>
           </tr>
    </table>
    <{else}>
    <table  id = "nextPage" border="0" style="display:none" width="100%" cellspacing="0" cellpadding="0" id="table140" height="25">
           <tr>
             <td valign="center" align="right">
             <p style="line-height: 16px;"><font face="Tahoma"> 
             <span style="font-size: 10pt" class="pagecount" id = "nextPageSpan"><{$page_string}>
             </span></font>&nbsp;&nbsp;
            </td>
           </tr>
    </table>
    <{/if}>
    </td></tr>
</table>
</td>
<td valign="top" style="padding-left:50px">
    <div class="row-fluid">
        <br>
        <br>
        <div class="span4">
            <img  class="img" src="<{$userInfo.avatar_url}>" width="70px" height="70px" style="cursor:pointer;"/>
        </div>
        <div class="span6" style='margin-top:20px;'>
            <p  id="userName" style="font-size:20px ;color:#25690c"><{$userInfo.core.name}></p>            
        </div>
    </div>
    <br>
    <div class="row-fluid" style="background:#f6f6f6;font-size:18px;color:#25690c;" align="center">
        <div class="span4" style="cursor:pointer" onMouseOver="this.style.color='#69a155'" onMouseOut="this.style.color='#25690c'">
            <p><{$userInfo.core.friendsnumber}></p>
            <p>关注</p>
        </div>
        <div class="span4" style="cursor:pointer" onMouseOver="this.style.color='#69a155'" onMouseOut="this.style.color='#25690c'">
            <p><{$userInfo.core.friendsofnumber}></p>
            <p>粉丝</p>
        </div>
        <div class="span4">
            <p><{$userInfo.core.wiresnumber}></p>
            <p>微博</p>
        </div>
    </div>
    <div style='margin-top:20px;width:280px'id='rightTime'>
    </div>
     </td>
     </tr>
     </table>
</div>
<div id="showMessage"  align='center' style="margin-top:30%;display:none">    
</div>
<div id="Loading" align="center" style="color:#737373;font-size:20px;display:none">正在加载......
</div>
<span id="min" style="display:none">
<{$min}>
</span>
<div id="pageCount" style="display:none">
<{$page}>
</div>
</body>
<div id="hasNext" style="display:none">
<{$hasNext}>
</div>
<div id="user_status" style="display:none">
<{$smarty.session.user_status}>
</div>
<div id="backTop" style='cursor:pointer;width:25px;height:88px;display:none;position:fixed;right:1px;TOP:600px;z-index:102;background:url(<{$img}>/weibo/zsc/top_down.png) no-repeat;' onclick='window.scrollTo(0,0); ' onMouseOver="$(this).css('background-image','url(cn/img/weibo/zsc/top_normal.png)')" onMouseOut="$(this).css('background-image','url(cn/img/weibo/zsc/top_down.png)')"></div>

</body>
</html>
