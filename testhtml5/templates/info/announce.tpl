<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
.more_title{
    position:relative;
    margin-top:-21px;
    background:url(cn/img/weibo/zsc/background.png);
    width:320px;
    font-size:16px;
    word-break:break-all;
    margin-left:17px;
    max-height:42px;
    overflow:hidden;

}
#showMessage {
    position:fixed;
    top:0px;
    left:0px;
    width:100%;
    height:100%;
    overflow-x:hidden;
    overflow-y:auto;
}
.close_button{
    position:relative;
    left:325px;
    width:26px;
    top:-30px;
    border:0px;
    cursor:pointer; 
    background-color:transparent;
}
.tab_div{
    background:url(<{$img}>/weibo/announce/line.png) repeat-x;
    background-position-y:36px;
    width:920px;
    height:38px;
}
#tab_announce li{
    float:left; 
    list-style:none;
    height:41px; 
    width:150px; 
    text-align:center; 
    cursor:pointer;
}
#sended_button{
    background:url(<{$img}>/weibo/announce/sended_normal.png) no-repeat;
    width:70px;
    height:26px;
    margin-top:5px;
    cursor:pointer;
}
#send_all{
    background:url(<{$img}>/weibo/announce/groupsend_selected.png) no-repeat;
    width:99px;
    height:35px;
    cursor:pointer;
}
.preview_button{
    background:url(<{$img}>/weibo/announce/preview_selected.png) no-repeat;
    width:99px;
    height:35px;
    float:left;
    cursor:pointer;
    margin-top:8px;
}
.send_button{
    background:url(<{$img}>/weibo/announce/send_selected.png) no-repeat;
    width:99px;
    height:35px;
    float:left;
    cursor:pointer;
    margin-left:25px;
    margin-top:8px;
}
#text_box{
    background:url(<{$img}>/weibo/announce/input_box.png) no-repeat;
    width:918px;
    height:232px;
    padding-top:2px;
    font-size:14px;
}
.announce_text{
   
   align:left;
   border:1px solid #dedede;

   width:100%;
   height:23px;
   color:#25690c;
   font-size:14px;
   margin-top:8px;
}
.box{
    font-family: "Microsoft YaHei","微软雅黑",Helvetica,"黑体",Arial,Tahoma;
    width:500px;
    height:22px;
    padding-top:1px;
    overflow:hidden;
    border-style:solid;
    border-color:#dedede;
    border-width:1px;
    font-size:14px;
    color:#646464;
}
.abstract_box{
    font-family: "Microsoft YaHei","微软雅黑",Helvetica,"黑体",Arial,Tahoma;
    width:500px;
    height:42px;
    overflow:auto;
    border-style:solid;
    border-color:#dedede;
    border-width:1px;
    font-size:15px;
    color:#646464;
}
.contents_box{
    font-family: "Microsoft YaHei","微软雅黑",Helvetica,"黑体",Arial,Tahoma;
    width:500px;
    height:300px;
    overflow:hidden;
    border-style:solid;
    border-color:#dedede;
    border-width:1px;
    font-size:15px;
    color:#646464;
}
.arrow{
    position:relative;  
    top:40px;
    left:-31px;
    width:30px;
}
.upload_form_div{
    position:absolute;  
    top:248px;
    filter:alpha(opacity=1);
}
.main_div{
    position:relative;  
    left:17px;
    margin-top:-160px;
    display:none;
    width:320px;
    height:160px;
    background:url(cn/img/weibo/announce/option_background.png);
}
.option_div{
    position:relative;  
    margin-top:-90px;
    display:none;
    width:351px;
    height:100px;
    background:url(cn/img/weibo/announce/option_background.png);
}
#input_name{
    position:fixed;
    top:0px;
    left:0px;
    width:100%;
    height:100%;
    overflow-x:hidden;
    overflow-y:auto;
    background:url(cn/img/weibo/zsc/background.png);
}
.txt{
    padding: 3px;
    border: 1px solid #AAA;
    width: 316px;
    line-height: 24px;
    height: 25px;
    color: #000;
    color: #000;
    margin-top: 5px;
    margin-bottom: 5px;
    font-size:15px;
}
body{
    font-family: "Microsoft YaHei","微软雅黑",Helvetica,"黑体",Arial,Tahoma;
}
.addfileI {
    cursor:hand;
    position:relative;
    left:0px;
    width:20px;
    background-color: blue;
    opacity:0;
    filter:alpha(opacity=0)
}
</style>
<script src="<{$jscript}>/jquery-1.8.3.js" ></script>
<script src="<{$jscript}>/My97DatePicker/WdatePicker.js" ></script>
<script type="text/javascript" src="<{$jscript}>/formjs/jquery.form.js"></script>
<script language="javascript">
$(document).ready(function(){
     add_notice_select('text_notice_select');
	 add_modify_time('text_modify_div');   
});
//创建全局变量对象，用来存储多图文信息
var option_info={};
$(function(){
    $('#single_title').bind("keyup",function(){single_title_change();});
    $('#more_title').bind("keyup",function(){more_title_change();});
    $('#send_box').bind("keyup",function(){
        recount();
        });
    $('#single_abstract').bind("keyup",function(){single_abstract_change();});
        });
//文本发送文字限制
function recount(){
        var max = 800;
        var sum = 0;
        var value = document.getElementById("send_box").value;
        var current = max - value.length;
        if(current < 0){
            $('#remain_count').html(-current);
            $("#count_reminder").html("已超出");
            $('#remain_count').css('color','red');
        }
        else{
            $('#remain_count').html(current);
            $("#count_reminder").html("还可以输入");
            $('#remain_count').css('color','#646464');
        }
}
//多图文左边标题改变
function more_title_change(){
    var more_title = $("#more_title").val();
    var value = $("#more_contents_v").val();
    if(value == 0){
        $("#more_title_left"+value).html(more_title);
        if($("#more_title_left0").height() <= 21){
            $("#more_title_left0").css('margin-top','-21px');
        }else
            if($("#more_title_left0").height() > 21){
                $("#more_title_left0").css('margin-top','-42');
            }
    }else{
        $("#more_title_left"+value).html(more_title);
        if($("#more_title_left"+value).height() == 21){
            $("#more_title_left"+value).css('margin-top','37px');
        }else if($("#more_title_left"+value).height() == 42){
            $("#more_title_left"+value).css('margin-top','29px');
        }else if($("#more_title_left"+value).height() > 42){
            $("#more_title_left"+value).css('margin-top','20px');
        }
    }
}
//单图文标题改变
function single_title_change(){
    var single_title = $("#single_title").val();
   // if(single_title.length > 30){
     //   return;
    //}else
        $("#single_title_left").html(single_title);
}
//单图文说明改变
function single_abstract_change(){
    var single_abstract = $("#single_abstract").html();
    single_abstract = single_abstract.replace(/(\r)*\n/g,"<br />").replace(/\s/g," ");
    $("#single_abstract_left").html(single_abstract);
}
//消息类别切换
function switch_tab(id){
    switch(id){
        case 'li1':{
            $('#text').show();
            $('#single_text_pic').hide();
            $('#more_text_pic').hide();
            $('#li1').css('background-image', 'url(cn/img/weibo/announce/text_selected.png)');
            $('#li2').css('background-image', 'url(cn/img/weibo/announce/single_unselected.png)');
            $('#li3').css('background-image', 'url(cn/img/weibo/announce/more_unselected.png)');
            add_notice_select('text_notice_select');
            add_modify_time('text_modify_div');
            break;
                   }
        case 'li2':{
            $('#text').hide();
            $('#single_text_pic').show();
            $('#more_text_pic').hide();
            $('#li1').css('background-image', 'url(cn/img/weibo/announce/text_unselected.png)');
            $('#li2').css('background-image', 'url(cn/img/weibo/announce/single_selected.png)');
            $('#li3').css('background-image', 'url(cn/img/weibo/announce/more_unselected.png)');
            add_notice_select('single_notice_select');
            add_modify_time('single_modify_div');
            break;
                   }
       case 'li3':{
            $('#single_text_pic').hide();
            $('#text').hide();
            $('#more_text_pic').show();
            $('#li1').css('background-image', 'url(cn/img/weibo/announce/text_unselected.png)');
            $('#li2').css('background-image', 'url(cn/img/weibo/announce/single_unselected.png)');
            $('#li3').css('background-image', 'url(cn/img/weibo/announce/more_selected.png)');
            add_notice_select('more_notice_select');
            add_modify_time('more_modify_div');
            break;
                   }
    }
}
//多图文上传图片
function more_upload_image(x){   
//	    $('#more_contents').attr('value',0);
		$("#more_upload_value").val($("#more_contents_v").val());
//    alert($("#more_contents").val());
    document.more_upload_form.submit();
    var file = $('#more_upload_img');
    file.after(file.clone().val("")); 
    file.remove();
}
//单图文上传图片
function upload_image(x){   
	
    document.upload_form.submit();
    var file = $('#upload_img');
    file.after(file.clone().val("")); 
    file.remove();
}
//多图文删除图片
function more_delete_image(){
    $("#more_image_div").css('display','none');
    var value = $("#more_contents_v").val();
    if(value == '0'){
        $("#more_image_left"+value).attr("src","cn/img/weibo/announce/coverpic.png");
    }else{
        $("#more_imgae_left"+value).attr("src","cn/img/weibo/announce/smallpic.png");
    }
    $("#more_image").attr("src","");
}
//单图文删除图片
function delete_image(){
    $("#single_image_div").css('display','none');
    $("#single_image_left").attr("src","cn/img/weibo/announce/coverpic.png");
    $("#single_image").attr("src","");
}
//单图文各种限制
function single_count(){
    var title = $('#single_title').val();
    var author = $('#single_author').val();
    var picture = $('#single_image').attr('src');
    var _abstract = $('#single_abstract').html().replace(/(\r)*\n/g," ");
//     var contents = $('#single_contents').html().replace(/(\r)*\n/g," ");
    var contents = $('#single_contents').val().replace(/(\r)*\n/g," ");
    var url = $('#single_url').val();

    if(title.length == 0){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">标题不能为空</div></div>').fadeOut(2000);
    }
    else if(title.length > 64){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:25px;color:#FFFFFF">标题长度不能超过64个字</div></div>').fadeOut(2000);
    }else if(author.length >8){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:25px;color:#FFFFFF">作者长度不能超过8个字</div></div>').fadeOut(2000);
    }else if(picture == ""){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">请上传图片</div></div>').fadeOut(2000);
    }else if(contents.length == 0){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">正文不能为空</div></div>').fadeOut(2000);
    }else if(_abstract.length > 120){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:25px;color:#FFFFFF">摘要长度不能超过120个字</div></div>').fadeOut(2000);
    }else if(contents.length > 2000){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:25px;color:#FFFFFF">正文长度不能超过2000字</div></div>').fadeOut(2000);
    }else if(url && url.match(/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/) == null){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">链接不合法</div></div>').fadeOut(2000);
    }else{
        return 1;
    }
    return 0;
}
//多图文各种限制
function more_count(){
    var title;
    var author;
    var picture;
    var contents;
    var url;
    var value;
    var flag;
    for(var each in option_info){
    	
   
        title = option_info[each]['title'];
        
        author = option_info[each]['author'];
        picture = option_info[each]['image'];
        contents = option_info[each]['content'];
        url = option_info[each]['url'];
        value = option_info[each]['value'];
       
        
        if(title.length == 0){
           
        	$('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">标题不能为空</div></div>').fadeOut(2000);
            break;
        }
        else if(title.length > 64){
            $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:25px;color:#FFFFFF">标题长度不能超过64个字</div></div>').fadeOut(2000);
            break;
        }else if(author.length >8){
            $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:25px;color:#FFFFFF">作者长度不能超过8个字</div></div>').fadeOut(2000);
            break;
        }else if(picture == ""){
            $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">请上传图片</div></div>').fadeOut(2000);
            break
        }else if(contents.length == 0){
            $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">正文不能为空</div></div>').fadeOut(2000);
            break;
        }else if(contents.length > 2000){
            $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:25px;color:#FFFFFF">正文长度不能超过2000字</div></div>').fadeOut(2000);
            break;
        }else if(url && url.match(/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/) == null){
            $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">链接不合法</div></div>').fadeOut(2000);
            break;
        }
        $('#option_total').children().each(function(i,n){
            flag = 0;
            for(var each in option_info){
//                if(option_info[each]['value'] == $(n).val() ){
                   if(option_info[each]['value'] == $(n).attr("value") ){
                    //alert(i +":" + each);
                   // alert($(n).val());
                    flag = 1;
                    break;
                }
            }
            if(flag == 0){
                $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">标题不能为空</div></div>').fadeOut(2000);
                more_edit($(n).val(),'save');
                return false;
            }
            
        });
        //alert('flag : ' + flag);
        if(flag == 0)
            return 0;
        
        if(each == object_count(option_info) - 1 ){
            return 1;
        }
    }
    more_edit(value,'save');
    return 0;
}
//单图文预览
function single_preview(){
    if(single_count() == 1){
        $('#input_name').css('display','');
    }
}
//多图文预览
function more_preview(){
    save_content();
    if(more_count() == 1){
        $('#input_name').css('display','');
    }
}
//计算对象数量
function object_count(o){
    var t = typeof o;
    if(t == 'object'){
        var n = 0;
        for(var i in o){ 
            n++;
        }
        return n;
    }
}
//多图文保存当前图文信息
function save_content(){
    var prev_value = $("#more_contents_v").val();
    var option_info_count = object_count(option_info);
    var flag = 0;
 //   if( $("#option_total").children().size() <  option_info_count || (option_info_count == 1 && prev_value == 0)){
    for(var each in option_info){
        if (option_info[each]['value'] == prev_value){
            //alert('更新'+prev_value);
            flag = 1;
            option_info[each]['title'] = $('#more_title').val();
            option_info[each]['author'] = $('#more_author').val();
//             option_info[each]['content'] = $('#more_content').html().replace(/(\r)*\n/g," ");
//             var contents = $('#single_contents').val().replace(/(\r)*\n/g," ");//15
            option_info[each]['content'] = $('#more_content').val().replace(/(\r)*\n/g," ");
            option_info[each]['image'] = $('#more_image').attr('src');
            option_info[each]['url'] = $('#more_url').val();
            break;
        }
    }
    if(flag == 0){
        //alert('新增'+prev_value);
        option_info[option_info_count] ={};
        option_info[option_info_count]['value'] = prev_value;
        option_info[option_info_count]['title'] = $('#more_title').val();
        option_info[option_info_count]['author'] = $('#more_author').val();
        //option_info[option_info_count]['content'] = $('#more_content').html().replace(/(\r)*\n/g," ");
        option_info[option_info_count]['content'] = $('#more_content').val().replace(/(\r)*\n/g," ");
        option_info[option_info_count]['image'] = $('#more_image').attr('src');
        option_info[option_info_count]['url'] = $('#more_url').val();
    }
}
//多图文显示对应的选项内容
function more_content_show(value){
    $('#more_title').val("");
    $('#more_author').val("");
//     $('#more_content').html("");
    $('#more_content').val("");
    $('#more_image').attr('src', '');
    $('#more_url').val('');
    $('#more_image_div').hide();
    for(var each in option_info){
        if (option_info[each]['value'] == value){
            $('#more_title').val(option_info[each]['title']);
            $('#more_author').val(option_info[each]['author']);
//             $('#more_content').html(option_info[each]['content']);
            $('#more_content').val(option_info[each]['content']);
            $('#more_image').attr('src', option_info[each]['image']);
            $('#more_url').val(option_info[each]['url'] );
            break;
        }
    }
}
//多图文选项内容编辑

function more_edit(value,mode){
    if(value == $("#more_contents_v").val()){
        return;
    }
    //alert(mode);
    if( mode == 'save'){
        //alert("save");
        save_content();
    }
    var option_number;
    var more_content_top;
    var more_form_top;
    if(value == 0){
        $('#more_arrow').css('top','40px');
        $('#more_contents').css('margin-top',0);
        $('#more_contents_v').attr('value',0);
        $('#more_upload_form_div').css('top','248px');
        $('#more_image_size').html('360');
        more_content_show(value);
        return;
    }
    $('#option_total').children().each(function(i,n){
//attr val()
           if($(n).attr("value") == value){
            option_number = i+1;
            return false;
        }
    });
    if(option_number < 4){
        more_content_top = 198 + (option_number - 1) * 100;
        more_form_top = 446 + (option_number - 1) * 100;
        $('#more_arrow').css('top','40px');
        $('#more_contents').css('margin-top',more_content_top);
        $('#more_contents_v').attr('value',value);
        $('#more_upload_form_div').css('top',more_form_top);
        $('#more_image_size').html('200');
    }else{
        more_content_top = 26 + (option_number - 4) * 100;
        more_form_top = 274 + (option_number - 4) * 100;
        $('#more_contents').css('margin-top',more_content_top);
        $('#more_contents_v').attr('value',value);
        $('#more_arrow').css('top','515px');
        $('#more_upload_form_div').css('top',more_form_top);
        $('#more_image_size').html('200');
    
    }
    more_content_show(value);
}
//验证昵称用户是否存在z9
function checkname(name)
{
   $.ajaxSetup({ async: false});//AJAX设置为同步请求
	var creceicer="";
	if(name == ""){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">昵称不能为空</div></div>').fadeOut(2000);
        return;
    }
    $.getJSON("admin.php?op=baseinfomgr_getAjaxData&action=get_name",{name:name},function(data){     
    	if(data == 'failure'){
                    $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">昵称不存在</div></div>').fadeOut(2000);
                    return;
                }
            creceicer=data;
                
});
$.ajaxSetup({ async: true});//AJAX设置为异步请求
return creceicer;
}
//获取发送通知的条件z9
function notice_condition()
{
// 	var noticetype=$("input[name='notice'][checked]").val(); 
	   var noticetype= $('input[name="notice"]:checked').val();//15
//    var broadcast = $('#broadcast').text();
   var isChecked=document.getElementById("1to1").checked;
    if(isChecked)
    {
    	var name=$('#show_inputname').val();
    	var receiver=checkname(name);
//    	topic_con=receiver;//构造topic的条件
//    	var topic=topic = "broadcast/"+receiver+"/announce";
    		
    }else
    {
    	var receiver="all";
    }
    var conditionArry={"noticetype":noticetype,"receiver":receiver}
    return conditionArry;
}

//文本发送z9
function text_send(){
  var check=$('#check').text(); 
  var isChecked=document.getElementById("1to1").checked;
  var radioid=	$('#radioid').text();
  var receiver="all";
	//获取被选中的通知类型
// var noticetype=$("input[name='notice'][checked]").val(); 
   var noticetype= $('input[name="notice"]:checked').val();
    if(isChecked)
    {   	
    	var name=$('#show_inputname').val();
        var receiver=checkname(name); 
      	
    }
//        alert(receiver);  
//    else
//    {
//    	
//    }
    
//	var text = $("#send_box").html();
    var text = $("#send_box").val();

//     text=text.replace(/<br/>/i, "/n")
    
    var description = $("#text_link_description").val()
    var link = $("#text_link").val();
    var death_time;
    if(text.length > 800 || text.length == 0){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:25px;color:#FFFFFF">文本不能为空，且长度不能超过800个字符</div></div>').fadeOut(2000);
    }else if(link.length ==0 && description.length !=0){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">链接不能为空</div></div>').fadeOut(2000);
    }else if(link.length != 0 && description.length==0){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">描述不能为空</div></div>').fadeOut(2000);
    }else if(link && link.match(/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/) == null){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">链接不合法</div></div>').fadeOut(2000);
    }else if(description.length>40){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:25px;color:#FFFFFF">描述长度不能超过40个字符</div></div>').fadeOut(2000);
    }
    else{
        var json='';
        json += '\"type\":1,';
        json +='\"main\":{';
        json +='\"text\":\"'+text+'\"';
        if(link.length != 0){
            if(link.substr(0,4) != 'http'){
                link ='http://' +link;
            }
            json += ',\"description\":\"'+description+'\",\"link\":\"'+link+'\"';
        }
        json +='},';
//        json +='}';//2014.10.17
        if($('#show_modify_button').val() == 1){
            death_time = $('#modify_date').val();
            var fyear = death_time.substr(0,4);
            var fmonth = death_time.substr(5,2);
            var fday = death_time.substr(8,2);
            var fhour = $('#modify_hour').val();
            var fminute = $('#modify_minute').val();
           // var ftime= new Date(fyear,fmonth,fday,fhour,fminute,2);
            var ftime= new Date(Date.UTC(fyear,fmonth-1,fday,fhour-8,fminute,2));
            death_time = Math.floor(ftime.getTime()/1000);
        
        }  $.getJSON("admin.php?op=baseinfomgr_getAjaxData&action=announce_check_notice",{json:json,time:death_time,type:noticetype,receiver:receiver,check:check,radioid:radioid},function(data){
       	if(data == 'success')
                    $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">发送成功</div></div>').fadeOut(2000);
                    $("#send_box").val('');
                    $("#text_link_description").val('');
                    $("#text_link").val('');
                    add_notice_select('text_notice_select');
                    add_modify_time('text_modify_div');
                });
    }
}
//删除选项
function delete_option(value){
    var i;
    var j;
    if($("#option_total").children().size() == 1){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">最少输入2条图文信息</div></div>').fadeOut(2000);
        return;
    }
    if(value != $('#more_contents_v').val()){ //判断删除的是否当前编辑的
        save_content();
    }
    var count = object_count(option_info);
    //alert("info_count: " +count);
    for(var each in option_info){
        //alert('each :  value : option_value' + each +':' + value +':' + option_info[each]['value']);
        if(option_info[each]['value'] == value){
            //option_info[each] = {};
      //      alert('==');
            if( each < count  - 1 ){
                for(i = each; i < count - 1  ; i++){
                    j = parseInt(i) + 1;
                    option_info[i]['value'] = option_info[j]['value'];
                    option_info[i]['title'] = option_info[j]['title'];
                    option_info[i]['author'] = option_info[j]['author'];
                    option_info[i]['content'] = option_info[j]['content'];
                    option_info[i]['image'] = option_info[j]['image'];
                    option_info[i]['url'] = option_info[j]['url'];
                }
            }
            delete option_info[count - 1];
            break;
        }
    }
    //alert(object_count(option_info));
    more_edit('0','not_save');
    $("#option_div"+value).remove();
    $('#more_arrow').css('top','40px');
    $('#more_contents').css('margin-top',0);
    $('#more_upload_form_div').css('top','248px');
    $(document).scrollTop(0);
}
//三个页面通知选项框z9
function add_notice_select(id_str){
	var html;
	html="<div align='left'>"
	         +"<div id='announceType_text' class='announce_text'>"+
               "&nbsp;<span>通知类型:</span>&nbsp;&nbsp;"
               +"<span><label><input  name=\"notice\" type=\"radio\" value=\"04\" checked='checked'/>&nbsp;系统通知</label>&nbsp;"
               +"<label><input name=\"notice\" type=\"radio\" value=\"05\"/&nbsp;>电台活动</label>&nbsp;"
               +"<label><input  name=\"notice\" type=\"radio\" value=\"06\"/>&nbsp;投票通知</label></span>"
               +"</div>"
               +"<div id=\"oneToone_text\" class='announce_text'>"  
               +"<div style='width:100px;float:left'>"     
               +"<span><input id=\"1to1\" type=\"checkbox\" onclick=\"checkboxOnclick(this)\"/>&nbsp;1vs1发送:<span>&nbsp;&nbsp;</div>"
               +"<div style='width:211px;float:left'>"
               +"<input id=\"show_inputname\" style='display:none;color:#25690c;font-size:13px; height:15px;width:100%'  type='text' value='请输入用户昵称'  onfocus=\"javascript:if(this.value=='请输入用户昵称')this.value='';\"/></div>"            
               +"</div>"
            +"</div>"
    $('#single_notice_select').html('');
    $('#more_notice_select').html('');
    $('#text_notice_select').html('');
	$('#'+id_str).html(html);
}

//三个页面通知选项框添加，定时发送添加
function add_modify_time(id_str){	
	var html="";   
    html="<div style='width:100%;color:#25690c;font-size:14px;margin-top:5px;' align='left' id='show_modify_button' onclick='send_time_modify()' value='0'><span style='cursor:pointer' id='show_modify_span'>定时发送</span></div>"+
            "<div align='left' id ='modify_time'style='height:22px;display:none' >"+
                "<span>"+
                    "<span style='font-size:14px;color:red'>设定发送时间：</span>"+
                    "<input id='modify_date' class='Wdate' type='text' style='width:100px;height:17px;border-color:#809ec6' onClick='WdatePicker()' /> "+
                    "<span>"+
                    "<select id='modify_hour'>"+ 
                        "<option>00</option>"+
                        "<option>01</option>"+
                        "option>02</option>"+
                        "<option>03</option>"+
                        "<option>04</option>"+
                        "<option>05</option>"+
                        "<option>06</option>"+
                        "<option>07</option>"+
                        "<option>08</option>"+
                        "<option>09</option>"+
                        "<option>10</option>"+
                        "<option>11</option>"+
                        "<option>12</option>"+
                        "<option>13</option>"+
                        "<option>14</option>"+
                        "<option>15</option>"+
                        "<option>16</option>"+
                        "<option>17</option>"+
                        "<option>18</option>"+
                        "<option>19</option>"+
                        "<option>20</option>"+
                        "<option>21</option>"+
                        "<option>22</option>"+
                        "<option>23</option>"+
                    "</select>"+
                    "时"+
                    "</span>"+
                    "<span>"+
                    "<select id='modify_minute'>"+
                        "<option>00</option>"+
                        "<option>01</option>"+
                        "<option>02</option>"+
                        "<option>03</option>"+
                        "<option>04</option>"+
                        "<option>05</option>"+
                        "<option>06</option>"+
                        "<option>07</option>"+
                        "<option>08</option>"+
                        "<option>09</option>"+
                        "<option>10</option>"+
                        "<option>11</option>"+
                        "<option>12</option>"+
                        "<option>13</option>"+
                        "<option>14</option>"+
                        "<option>15</option>"+
                        "<option>16</option>"+
                        "<option>17</option>"+
                        "<option>18</option>"+
                        "<option>19</option>"+
                        "<option>20</option>"+
                        "<option>21</option>"+
                        "<option>22</option>"+
                        "<option>23</option>"+
                        "<option>24</option>"+
                        "<option>25</option>"+
                        "<option>26</option>"+
                        "<option>27</option>"+
                        "<option>28</option>"+
                        "<option>29</option>"+
                        "<option>30</option>"+
                        "<option>31</option>"+
                        "<option>32</option>"+
                        "<option>33</option>"+
                        "<option>34</option>"+
                        "<option>35</option>"+
                        "<option>36</option>"+
                        "<option>37</option>"+
                        "<option>38</option>"+
                        "<option>39</option>"+
                        "<option>40</option>"+
                        "<option>41</option>"+
                        "<option>42</option>"+
                        "<option>43</option>"+
                        "<option>44</option>"+
                        "<option>45</option>"+
                        "<option>46</option>"+
                        "<option>47</option>"+
                        "<option>48</option>"+
                        "<option>49</option>"+
                        "<option>50</option>"+
                        "<option>51</option>"+
                        "<option>52</option>"+
                        "<option>53</option>"+
                        "<option>54</option>"+
                        "<option>55</option>"+
                        "<option>56</option>"+
                        "<option>57</option>"+
                        "<option>58</option>"+
                        "<option>59</option>"+
                    "</select>"+
                    "分"+
                    "</span>"+
                "</span>"+

    "</div>";
    $('#single_modify_div').html('');
    $('#more_modify_div').html('');
    $('#text_modify_div').html('');
    $('#'+id_str).html(html);
}
//多图文增加选项
function add_option(){
    if($("#option_total").children().size() == 7){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">最多输入8条图文信息</div></div>').fadeOut(2000);
        return;
    }
    var value = $("#option_total").children().last().attr("value");//attr val()
    value = parseInt(value) + 1;
    var html = "";
    html += "<div  align='left' id='option_div"+value+"'value='"+value+"'style='border:1px solid #dedede;border-top:none;width:351px;height:100px;' onmouseover='$(\"#option_edit"+value+"\").show()' onmouseout='$(\"#option_edit"+value+"\").hide()'>" +
                "<div id='more_title_left"+value+"' style='float:left;width:235px;max-height:68px;margin-left:17px;margin-top:37px;overflow:hidden'>标题"+
                "</div>"+
                "<img id='more_image_left"+value+"' style='width:73px;height:73px;margin-top:-10px;margin-left:13px;margin-top:13px' src='cn/img/weibo/announce/smallpic.png'/ >"+
                "<div id='option_edit"+value+"'class='option_div' align='center' style='margin-top:-86px'>"+
                    "<img style='width:20px;cursor:pointer;margin-right:50px;margin-top:40px' src='cn/img/weibo/announce/write.png' onclick=\"more_edit("+value+",'save')\"/>"+
                    "<img style='width:20px;cursor:pointer;margin-top:40px' src='cn/img/weibo/announce/delete.png' onclick=\"delete_option("+value+")\"/>"+
                "</div>"+
            "</div>";
    $("#option_total").append(html);
}
//单图文发送z9
function single_send(){
    if(single_count() == 1){
        var broadcast = $('#broadcast').text();
        broadcast = broadcast.substr(0,broadcast.length-1);
    	var conditionArry=notice_condition();
        var receiver=conditionArry["receiver"];
        var noticetype=conditionArry["noticetype"];
        json_create(2,broadcast,'single',receiver,noticetype);
    }
}
//单图文发送成功，清除对应信息
function single_finish(){
    $('#single_title').val('');
    $('#single_author').val('');
    $('#single_image').attr('src','');
    $('#single_image_div').css('display','none');
    $('#single_abstract').val('');
    $('#single_contents').val('');
    $('#single_url').val('');
    $('#single_image_left').attr('src','cn/img/weibo/announce/coverpic.png');
    $('#single_title_left').html('标题');
    $('#single_abstract_left').html('');
    $('#single_modify_div').html('');
    add_notice_select('single_notice_select');
    add_modify_time('single_modify_div');
}
//多图文发送成功，清除对应信息
function more_finish(){
    //清空右边输入信息
    $('#more_title').val('');
    $('#more_author').val('');
    $('#more_image').attr('src','');
    $('#more_image_div').css('display','none');
    $('#more_content').val('');
    $('#more_url').val('');
    $('#more_image_left0').attr('src','cn/img/weibo/announce/coverpic.png');
    $('#more_title_left0').html('标题');
    $('#more_title_left0').css('margin-top','-21px');
    //删除对应的存储对象
    for(var each in option_info){
        delete option_info[each];
    }
    //恢复输入框初始位置
    $('#more_arrow').css('top','40px');
    $('#more_contents').css('margin-top',0);
    $('#more_contents_v').attr('value',0);
    $('#more_upload_form_div').css('top','248px');
    $('#more_image_size').html('360');
    //删除option子节点，只保留第一个
    $('#option_total').children().each(function(i,n){
        if(i > 0){
            $(n).remove();
        }
    });
    //清空左边对应的信息
    var first_value = $('#option_total').children().first().attr("value");//attr val()
    add_notice_select('more_notice_select');
    add_modify_time('more_modify_div');
    $('#more_title_left'+ first_value).html('标题');
    $('#more_image_left'+ first_value).attr('src','cn/img/weibo/announce/smallpic.png');

}
//多图文发送z9
function more_send(){
    save_content();
    if(more_count() == 1){
        var broadcast = $('#broadcast').text();
        broadcast = broadcast.substr(0,broadcast.length-1);
    	var conditionArry=notice_condition();
      
        var receiver=conditionArry["receiver"];
        var noticetype=conditionArry["noticetype"];
        json_create(2,broadcast,'more',receiver,noticetype);
    }
}
function modify_time(){
        var nstr=new Date(); //当前Date资讯
        var ynow=nstr.getFullYear(); //当前年份
        var mnow=nstr.getMonth()+1; //当前月份
        var mnow=String(mnow);
        if(mnow < 10){
            mnow = '0'+mnow;
        }
        var dnow = nstr.getDate(); //当前日期
        if(dnow < 10){
            dnow = '0'+dnow;
        }
        var hnow=nstr.getHours(); //当前小时
        if(hnow < 10){
            hnow = '0'+hnow;
        }
        var Mnow=nstr.getMinutes(); //当前分钟
        if(Mnow < 10){
            Mnow = '0'+Mnow;
        }
        var ndate = ynow+'-'+mnow+'-'+dnow;
        $('#modify_date').val(ndate);
        $('#modify_hour').val(hnow);
        $('#modify_minute').val(Mnow);
        $('#modify_time').show();

}
//切换定时发送时间
function send_time_modify(){
    if($("#show_modify_button").val() == '0'){
        $("#modify_time").show();
        modify_time();
        $("#show_modify_span").html('取消定时');
        $("#show_modify_button").val('1');
    }else{
        $("#modify_time").hide();
        $("#show_modify_span").html('定时发送');
        $("#show_modify_button").val('0');
    }
}
//预览发送取消
function preview_cancel(){
    $('#value').val('');
    $('#input_name').css('display','none');
}
//预览确认
function preview_confirm(){
    var mode;
    var noticetype=$("input[name='notice'][checked]").val(); 
    name = $("#value").val();
    if($("#single_text_pic").css('display') == 'none'){
        mode = 'more';
    }else{
        mode = 'single'
    }
    if(name == ""){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">昵称不能为空</div></div>').fadeOut(2000);
        return;
    }
    $.getJSON("admin.php?op=baseinfomgr_getAjaxData&action=get_name",{name:name},function(data){
                if(data == 'failure'){
                    $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">昵称不存在</div></div>').fadeOut(2000);
                    return;
                }
                if(mode == 'single'){
                    json_create(1,data,'single',data,noticetype);
                }else{
                    json_create(1,data,'more',data,noticetype);
                }
                preview_cancel();
            });
    
}
//构造JSON数据z9
function json_create(type,data,mode,receiver,noticetype){
                var death_time;
                var check=$('#check').text();
                var radioid=$('#radioid').text();
                if(mode == 'single'){
                    var title = $('#single_title').val();
                    var author = $('#single_author').val();
//                    var picture = "http://im.yqting.com/test_demo/"+$('#single_image').attr('src');
                   var picture = "http://im.yqting.com/test_demo_version2/"+$('#single_image').attr('src');
//                     var picture = "http://192.168.139.71/test_demo/"+$('#single_image').attr('src');///////测试图片，后期改为服务器地址
                    var _abstract = $('#single_abstract').html();
//                     var contents = $('#single_contents').html();
                    var contents = $('#single_contents').val();//z9
                    var url = $('#single_url').val();
                }else{
                    var title = option_info[0]['title'];
                    var author = option_info[0]['author'];
//                   var picture = "http://im.yqting.com/test_demo/"+option_info[0]['image'];
                   var picture = "http://im.yqting.com/test_demo_version2/"+option_info[0]['image'];
//                    var picture = "http://192.168.139.71/test_demo/"+option_info[0]['image'];//////////测试图片
                    var contents = option_info[0]['content'];
                    var url = option_info[0]['url'];
                }
                var json='';
               
                json += "\"type\":2,";
                json +='\"main\":{';
                if(author)
                    json +='\"author\":\"'+author+'\",';
                json +='\"title\":\"'+title+'\",';
                if(_abstract)
                    json +='\"abstract\":\"'+_abstract+'\",';
                json +='\"text\":\"'+contents+'\",';
                json +='\"picUrl\":\"'+picture+'\"';
                if(url){
                    if(url.substr(0,4) != 'http'){
                        url ='http://' +url;
                    }
                    json +=',\"link\":\"'+url+'\"';
                }
                json +='},';
                if(mode == 'more'){
                    json +='\"option\":[';
                    for(var each in option_info){
                        if(each > 0){
                            json += "{";
                            if(option_info[each]['author'] != ''){
                                json +='\"author\":\"'+option_info[each]['author']+'\",';
                            }
                            json +='\"title\":\"'+option_info[each]['title']+'\",';
                            json +='\"text\":\"'+option_info[each]['content']+'\",';
 //                          json +='\"picUrl\":\"'+"http://im.yqting.com/test_demo/"+option_info[each]['image']+'\"';//测试图片
                           json +='\"picUrl\":\"'+"http://im.yqting.com/test_demo_version2/"+option_info[each]['image']+'\"';//测试图片
//                             json +='\"picUrl\":\"'+"http://192.168.139.71/test_demo/"+option_info[each]['image']+'\"';//测试图片
                            
                            if(option_info[each]['url'] != ''){
                                if(option_info[each]['url'].substr(0,4) != 'http'){
                                    option_info[each]['url'] ='http://' + option_info[each]['url'];
                                }
                                json +=',\"link\":\"'+option_info[each]['url']+'\"';
                            }
                            if(each == object_count(option_info) - 1){
                                json +='}';
                            }else{
                                json +='},';
                            }
                        }
                    }
                    json += "],";
                }
               
           
                if(data != 'failure')
                    if($('#show_modify_button').val() == 1){
                        death_time = $('#modify_date').val();
                        var fyear = death_time.substr(0,4);
                        var fmonth = death_time.substr(5,2)-1;
                        var fmonth=String(fmonth);//zhb
                        var fday = death_time.substr(8,2);
                        var fhour = $('#modify_hour').val();
                        var fminute = $('#modify_minute').val();
                        var ftime= new Date(fyear,fmonth,fday,fhour,fminute,3);
                        death_time = Math.floor(ftime.getTime()/1000);        
                    }
                if(type == 1){
                    death_time = 0;
$.getJSON("admin.php?op=baseinfomgr_getAjaxData&action=announce_check_notice",{json:json,time:death_time,type:noticetype,receiver:receiver,check:check,radioid:radioid},function(data){                    
                    	if(data == 'success'){
                                    $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">发送预览成功</div></div>').fadeOut(2000);
                            }
                    });
                }else{ 
$.getJSON("admin.php?op=baseinfomgr_getAjaxData&action=announce_check_notice",{json:json,time:death_time,type:noticetype,receiver:receiver,check:check,radioid:radioid},function(data){
                            if(data == 'success'){
                                    if(mode == 'single'){
                                        single_finish();
                                    }else{
                                        more_finish();
                                    }
                                    $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">发送成功</div></div>').fadeOut(2000);
                            }
                    });
                }
}
//上传文件格式不正确的提示
function error_image(){
        $('#showMessage').show().html('<div align="center"style=" font-size:20px;width:200px;height:100px;background-color:#4c4c4c;"><div style="padding-top:40px;color:#FFFFFF">图片格式不正确</div></div>').fadeOut(2000);
}
//一对一发送复选框选中事件z9
function checkboxOnclick(checkbox){
	if(checkbox.checked){	
		$('#show_inputname').show();
	}else{
		$('#show_inputname').hide();
	}
}
</script>
</head>
<body>
<div align='center'>
    <div  style='width:920px'>
  <!--  <div style='width:716px'>
        <div style='height:32px;background:url(cn/img/weibo/vote/line.png) no-repeat; background-position-y:100%'>
        <div>
    <div>-->
    <div class='tab_div'> 
        <ul id='tab_announce' style='margin-left:-30px'>
            <li id ='li1' style='background:url(<{$img}>/weibo/announce/text_selected.png) no-repeat;' onClick="switch_tab('li1')"></li>
            <li id ='li2' style='background:url(<{$img}>/weibo/announce/single_unselected.png) no-repeat;' onClick="switch_tab('li2')"></li>
            <li id ='li3' style='background:url(<{$img}>/weibo/announce/more_unselected.png) no-repeat;' onClick="switch_tab('li3')"></li>
        </ul>
        <div align='right'>
            <div  id='sended_button' style="display:<{$isBack}>;" onMouseOver="$('#sended_button').css('background-image', 'url(cn/img/weibo/announce/sended_hover.png)')" onMouseOut="$('#sended_button').css('background-image', 'url(cn/img/weibo/announce/sended_normal.png)')" onClick="window.location.href ='admin.php?op=baseinfomgr_announceRecord'">
            </div>
        </div>
    </div>
    <br>
    <div id='text'>
    <div>
        <div id = 'text_box'>
            <textarea id="send_box" style='font-family: "Microsoft YaHei","微软雅黑",Helvetica,"黑体",Arial,Tahoma;font-size:15px;overflow:auto;width:906px;height:215px;color:#646464;border: 0; '></textarea>
        </div>
    </div>
    <div id="text_notice_select" align="left" style="margin-right:450px;"></div>
    
    
    <div align='left'id='text_add_link' style='padding-top:5px;'>
        <a style='color:#25690c;cursor:pointer;font-size:14px'onClick="$('#text_link_div').show();$('#text_add_link').hide()">添加链接</a>
    </div>
    <div id ='text_link_div' align='left' style='font-size:14px;display:none;padding-top:10px;'>
        <div>
            <div style='float:left;margin-top:2px'>链接：</div>
            <input id='text_link' type='text' class='box'></input>
        </div>
        <div style="margin-top:5px;">
            <div style='float:left;margin-top:2px;'>描述：</div>
            <input id='text_link_description' type='text' class='box'></input>
        </div>
    </div>
    <div id='text_modify_div'>
    </div>
    <div align='left' style='margin-top:5px'>
        <div id='send_all'  onMouseOver="$('#send_all').css('background-image','url(cn/img/weibo/announce/groupsend_unselected.png)')" onMouseOut="$('#send_all').css('background-image','url(cn/img/weibo/announce/groupsend_selected.png)')" onClick="text_send()">
        </div>
        <div style='position:absolute;top:315px;left:50%;color:#646464;font-size:14px;padding-left:310px;'><span  id = 'count_reminder'>还可以输入</span><span id='remain_count'>800</span>个字</div>
    </div>
    </div>
    <div id='single_text_pic' style='width:920px;display:none'>
                <div style="width:353px;float:left;">
                    <div style="border:1px solid #dedede;padding-bottom:10px">
                    <div class='' align='left'>
                        <div id='single_title_left' style='text-overflow:ellipsis; line-height:28px;font-size:16px;word-break:break-all;margin-left:17px;padding-top:15px'>
                            标题
                        </div>
                        <div id='date_left' style='margin-left:17px;padding-top:5px;font-size:14px'>
                            <{$date}>
                        </div>
                        <div  align='center' style='padding-top:5px;width:353px;height:160px;overflow:hidden'>
                            <img id='single_image_left' style='width:320px;display:inline-block;' src='cn/img/weibo/announce/coverpic.png'>
                        </div>
                        <div id='single_abstract_left'style='line-height:1.6;font-size:14px;word-break:break-all;margin-left:17px;padding-top:5px' >
                        </div>
                    </div>
                    </div>
                    <div id="single_notice_select" align="left" style="margin-top:5px">
           
                    </div>
                    <div id='single_modify_div' style='margin-top:5px'>
                    
                    </div>
                    <div class='preview_button' id='single_preview_button' onMouseOver="$('#single_preview_button').css('background-image','url(cn/img/weibo/announce/preview_unselected.png)')" onMouseOut="$('#single_preview_button').css('background-image','url(cn/img/weibo/announce/preview_selected.png)')" onClick="single_preview()">
                    </div>
                    <div class='send_button' id='single_send_button' onMouseOver="$('#single_send_button').css('background-image','url(cn/img/weibo/announce/send_unselected.png)')" onMouseOut="$('#single_send_button').css('background-image','url(cn/img/weibo/announce/send_selected.png)')" onClick="single_send()">
                    </div>
                </div>
                <div align='left' style="padding-left:15px;width:527px;border:1px solid #dedede; no-repeat ;float:right;" >
                    <div id='single_arrow' class="arrow">
                        <img src="cn/img/weibo/announce/arrow.png"/>
                    </div>
                    <div style='font-size:14px'>
                        标题
                    </div>
                    <div>
                        <input type='text'  id="single_title" class='box'></input>
                    </div>
                    <div style='padding-top:15px;font-size:14px'>
                        作者（选填）
                    </div>
                    <div>
                        <input type='text'  id='single_author' class='box'></input>
                    </div>
                    <div style='padding-top:15px;font-size:14px'>
                        <span>封面</span><span style='font-family: "Microsoft YaHei","微软雅黑",Helvetica,"黑体",Arial,Tahoma;padding-left:242px;font-size:14px;color:#646464'>大图片建议尺寸：360像素 * 200像素</span>
                    </div>
                    <div>
                        <div style='border-color:#dedede;border-style:solid;border-width:1px;width:500px;height:24px;padding-top:3px'>
                            <span style='cursor:pointer'>&nbsp;&nbsp;<img src='cn/img/weibo/announce/upload.png'" /></span>
                        </div>
                    </div>
                    <div id='upload_form_div' class="upload_form_div" align='left'>
                            <form name='upload_form' id='upload_form'method="post" target='upload_frame' enctype="multipart/form-data">
                            <input type="file" id='upload_img'   style='font-size:11px;width:65px;height:28px;cursor:pointer;opacity:0' name="upload_img"  onchange="upload_image(this.value);"/> 
                            <iframe id="upload_frame" name="upload_frame" style="display:none"></iframe>
                            </form>
                    </div>
                    <div id='single_image_div' style='display:none;border-style:solid;width:500px;border-top:none;border-width:1px;border-color:#DEDEDE'>
                            <img id='single_image' style='width:80px;height:auto' src='' onLoad="$('#single_image_div').show();">
                            <a onClick="delete_image()" style='font-size:13px;cursor:pointer;color:#25690c'>删除</a>
                    </div>
                    <div style='padding-top:15px;font-size:14px'>
                        摘要（选填）
                    </div>
                    <div>
                        <textarea id="single_abstract" class='abstract_box'></textarea>
                    </div>
                    <div style='padding-top:15px;font-size:14px'>
                        正文
                    </div>
                    <div>
                        <textarea id='single_contents' class='contents_box'></textarea>
                    </div>
                    <div style='padding-top:15px;font-size:14px;'>
                        原文链接（选填）
                    </div>
                    <div>
                        <input id='single_url' class='box'></input>
                    </div>
                    <br/>
                </div>
    </div>
    <div id='more_text_pic' style='width:920px;display:none;'>
                <div style="width:353px;float:left">
                    <div style="border:1px solid #dedede;padding-bottom:10px" onmouseover='$("#main_edit").show()' onmouseout='$("#main_edit").hide()'>
                        <div class='' align='left'>
                            <div id='date_left' style='margin-left:17px;padding-top:5px;font-size:14px'>
                                <{$date}>
                            </div>
                            <div  align='center' style='padding-top:5px;width:353px;height:160px;overflow:hidden'>
                                <img id='more_image_left0' style='width:320px;display:inline-block;' src='cn/img/weibo/announce/coverpic.png'>
                            </div>
                            <div id='more_title_left0' class='more_title' style='color:#fff'>
                                标题
                            </div>
                            <div id='main_edit' class='main_div' align='center'>
                                <img style='width:20px;cursor:pointer;margin-top:70px' src='cn/img/weibo/announce/write.png' onclick="more_edit(0,'save')"/>
                            </div>
                        </div>
                    </div>
                    <div id='option_total'>
                        <div id='option_div1'align='left' value='1' style='border:1px solid #dedede;border-top:none;width:351px;height:100px;' onmouseover='$("#option_edit1").show()' onmouseout='$("#option_edit1").hide()'>
                            <div id='more_title_left1' style='float:left;width:235px;max-height:68px;margin-left:17px;margin-top:37px;overflow:hidden' >标题 
                            </div>
                            <img id='more_image_left1' style='width:73px;height:73px;margin-top:-10px;margin-left:13px;margin-top:13px' src='cn/img/weibo/announce/smallpic.png'/ >
                            <div id='option_edit1'class='option_div' align='center'>
                                <img style='width:20px;cursor:pointer;margin-right:50px;margin-top:40px' src='cn/img/weibo/announce/write.png' onclick="more_edit(1,'save')"/>
                                <img style='width:20px;cursor:pointer;margin-top:40px' src='cn/img/weibo/announce/delete.png' onclick="delete_option(1)"/>
                            </div>
                        </div>
                    </div>
                    <div style='border:1px solid #dedede;border-top:none;width:351px;height:95px;padding-top:20px;'>
                        <div style='border:1px dashed #25690c;width:310px;height:50px;padding-top:22px;cursor:pointer' onclick='add_option()'>
                            <span style='font-size:15px'><span style="font-size:20px;color:#25690c"><b>+</b></span>增加一条</span>
                        </div>
                    </div>
                    
                    
                    <div id="more_notice_select" align="left" style="margin-top:5px"></div>
                    
                    <div id='more_modify_div' style='margin-top:5px'></div>
                    
                    <div class='preview_button' id='more_preview_button' onMouseOver="$('#more_preview_button').css('background-image','url(cn/img/weibo/announce/preview_unselected.png)')" onMouseOut="$('#more_preview_button').css('background-image','url(cn/img/weibo/announce/preview_selected.png)')" onClick="more_preview()">
                    </div>
                    <div class='send_button' id='more_send_button' onMouseOver="$('#more_send_button').css('background-image','url(cn/img/weibo/announce/send_unselected.png)')" onMouseOut="$('#more_send_button').css('background-image','url(cn/img/weibo/announce/send_selected.png)')" onClick="more_send()">
                    </div>
                </div>
                <div id='more_contents' align='left' style="padding-left:15px;width:527px;border:1px solid #dedede; no-repeat ;float:right;" >
                <input id='more_contents_v' type="hidden" value="0" />
                   <div id='more_arrow' class="arrow">
                        <img src="cn/img/weibo/announce/arrow.png"/>
                    </div>
                    <div style='font-size:14px'>
                        标题
                    </div>
                    <div>
                        <input type='text'  id="more_title" class='box'></input>
                    </div>
                    <div style='padding-top:15px;font-size:14px'>
                        作者（选填）
                    </div>
                    <div>
                        <input type='text'  id='more_author' class='box'></input>
                    </div>
                    <div style='padding-top:15px;font-size:14px'>
                        <span>封面</span><span style='font-family: "Microsoft YaHei","微软雅黑",Helvetica,"黑体",Arial,Tahoma;padding-left:242px;font-size:14px;color:#646464'>大图片建议尺寸：<span id='more_image_size'>360</span>像素 * 200像素</span>
                    </div>
                    <div>
                        <div style='border-color:#dedede;border-style:solid;border-width:1px;width:500px;height:24px;padding-top:3px'>
                            <span style='cursor:pointer'>&nbsp;&nbsp;<img src='cn/img/weibo/announce/upload.png'/></span>                      
                        </div>
                    </div>
                           <div id='more_upload_form_div' class="upload_form_div" align='center'>
                            <form  name='more_upload_form' id='more_upload_form'method="post" target='more_upload_frame' enctype="multipart/form-data">
                            <input type="file" id='more_upload_img'  style='font-size:11px;width:65px;height:28px;cursor:pointer;opacity:0' name="upload_img"  onchange="more_upload_image(this.value);"/>
                            <input id='more_upload_value' name ='upload_value' type='text' style="display:none" value="" readonly='readonly' unselectable="on"/> 
                            <iframe id="more_upload_frame" name="more_upload_frame" style="display:none"></iframe>
                            </form>
                    </div>
                    <div id='more_image_div' style='display:none;border-style:solid;width:500px;border-top:none;border-width:1px;border-color:#DEDEDE'>
                            <img id='more_image' style='width:80px;height:auto' src='' onLoad="$('#more_image_div').show();">
                            <a onClick="more_delete_image()" style='font-size:13px;cursor:pointer;color:#25690c'>删除</a>
                    </div>
                    <div style='padding-top:15px;font-size:14px'>
                        正文
                    </div>
                    <div>
                        <textarea id='more_content' class='contents_box'></textarea>
                    </div>
                    <div style='padding-top:15px;font-size:14px;'>
                        原文链接（选填）
                    </div>
                    <div>
                        <input id='more_url' class='box'></input>
                    </div>
                    <br/>
                </div>
    </div>
    <div style="display:none">
        <img src="cn/img/weibo/announce/preview_unselected.png"/>
        <img src="cn/img/weibo/announce/send_unselected.png"/>
        <img src="cn/img/weibo/announce/confirm_hover.png"/>
        <img src="cn/img/weibo/announce/cancel_hover.png"/>
        <img src="cn/img/weibo/announce/sended_hover.png"/>
        <img src="cn/img/weibo/announce/sended_hover.png"/>
        <img src="cn/img/weibo/announce/text_unselected.png"/>
        <img src="cn/img/weibo/announce/single_selected.png"/>
        <img src="cn/img/weibo/announce/groupsend_unselected.png"/>
    </div>
</div>
<div id='input_name' style="display:none" align='center' onMouseWheel="return false">
        <div align='center' style='width:350px;height:250;background-color:#FFFFFF;margin-top:15%;'>
            <div align='left' style='height:45px;background-color:#e7e7e7'>
                <div style='font-size:15px;margin-left:15px;padding-top:10px'>发送预览</div><button class="close_button" type='button' onClick="preview_cancel()">&times;</button>
            </div>
            <div align='left' style='margin-left:15px;margin-top:25px;font-size:14px;color:#000;font-weight:700'>
                输入电台微博昵称，预览将发至好友：
            </div>
            <div>
                <input id='value' class='txt'></input>
            </div>
            <br/>
            <hr/>
            <br/>
            <div id='confirm_button' style='float:left;margin-left:30px;cursor:pointer;width:125px;height:31px;background:url(cn/img/weibo/announce/confirm_normal.png)' onMouseOver="$('#confirm_button').css('background-image', 'url(cn/img/weibo/announce/confirm_hover.png)')" onMouseOut="$('#confirm_button').css('background-image', 'url(cn/img/weibo/announce/confirm_normal.png)')" onClick="preview_confirm()"></div>
            <div id='cancel_button' style='margin-bottom:20px;margin-right:30px;float:right;cursor:pointer;width:125px;height:31px;background:url(cn/img/weibo/announce/cancel_normal.png)' onMouseOver="$('#cancel_button').css('background-image','url(cn/img/weibo/announce/cancel_hover.png)')" onMouseOut="$('#cancel_button').css('background-image', 'url(cn/img/weibo/announce/cancel_normal.png)')" onClick="preview_cancel()"></div>
        </div>
</div>
<div id="showMessage"  align='center' style="margin-top:30%;display:none">
</div>
<div id='broadcast' style="display:none">
<{$broadcast}>
</div>
<div id="check" style="display:none">
<{$check}>
</div>
<div id='radioid' style="display:none">
<{$radioid}>
</div>
</body>
</html>
