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




function download_img(url){
    var url = url.substr(0,url.length - 4);
    window.location.href ='admin.php?op=baseinfomgr_download&url='+url;
}














<{if $weiboList[index].Pic!=""}>
                    	<tr>
                    		<td colspan="2"><img style="padding-bottom:8px;cursor:url('cn/img/weibo/zsc/cursor_jia.cur')" id="image<{$weiboList[index].num}>" src="<{$weiboList[index].Pic}>" onClick="changeImage(<{$weiboList[index].num}>,'image<{$weiboList[index].num}>','<{$weiboList[index].Pic}>','<{$weiboList[index].PicLarge}>')"/></td>
                    	</tr>
                    	<{/if}>
                   		<{if $weiboList[index].Audio!=""}>
                    	<tr>
                    		<td colspan="2"><a style="color:#3b3b3b;text-decoration:none;" href="<{$weiboList[index].Audio}>" ><div id ="<{$weiboList[index].ID}>img" style='cursor:pointer;background:url(cn/img/weibo/zsc/audio.png) no-repeat; width:60px; height:40px' onClick="resetImg(<{$weiboList[index].ID}>,<{$weiboList[index].AudioLen}>,1)"><span valign="bottom" style="position:relative;top:4px;margin-left:34px;font-size:11px"><{$weiboList[index].AudioLen}>"</span></div></a></td>
                            <td>
                                <span style="float:right;font-size:13px;position:relative;bottom:2px;right:450px;"><a title="下载" onclick="download_img('<{$weiboList[index].Audio}>')" style='cursor:pointer;color:#25690c'>下载</a></span>
                            </td>
                    	</tr>





function()
{
if (data[i].Pic != null){
                 ap +=  "<tr>"+
                    		"<td colspan='2'><img style=\"padding-bottom:8px;cursor:url('cn/img/weibo/zsc/cursor_jia.cur')\" id='image"+data[i].num+"' src='"+data[i].Pic+"' onClick=\"changeImage("+data[i].num+",'image"+data[i].num+"','"+data[i].Pic+"','"+data[i].PicLarge+"')\"/></td>"+
                    	"</tr>";}
                   		if (data[i].Audio != null){
                 ap += 	"<tr>"+
                    		"<td colspan='2'><a style='cursor:pointer;color:#3b3b3b;text-decoration:none;' href='"+data[i].Audio+"' ><div id ='"+data[i].ID+"img' style='background:url(cn/img/weibo/zsc/audio.png) no-repeat; width:60px; height:40px' onClick='resetImg("+data[i].ID+","+data[i].AudioLen+",1)'><span valign='bottom' style='position:relative;top:4px;margin-left:34px;font-size:11px'>"+data[i].AudioLen+"\"</span></div></a></td>"+
                            "<td><span style=\"float:right;font-size:13px;position:relative;bottom:2px;right:450px;\"><a title=\"下载\" onclick=\"download_img('"+data[i].Audio+"')\" style='cursor:pointer;color:#25690c'>下载</a></span></td>"+
                    	"</tr>";}
}