<!DOCTYPE HTML>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>分享按钮</title>
</head>
<body>
<div id="weibo">
<table>
<tr>
<td colspan='2'><font color='#001e02' face='SimSun' size='3.5px'>微博内容哈哈哈</font></td>
</tr>
<tr>
<td colspan='2'><img style="padding-bottom:8px" id='image1' src="img/pic.png"/> </td>
</tr>
</table>
<div id="content">要分享的微博</div>
<div class="bdsharebuttonbox" data-tag="share_1">
    
	<a class="bds_mshare" data-cmd="mshare"></a>
	<a class="bds_qzone" data-cmd="qzone" href="#"></a>
	<a class="bds_tsina" data-cmd="tsina"></a>
	<a class="bds_baidu" data-cmd="baidu"></a>
	<a class="bds_renren" data-cmd="renren"></a>
	<a class="bds_tqq" data-cmd="tqq"></a>
	<a class="bds_more" data-cmd="more">更多</a>
	<a class="bds_count" data-cmd="count"></a>
</div>
</div>
<script>
	window._bd_share_config = {
		common : {
			bdText : '自定义分享内容',	
			bdDesc : '自定义分享摘要',	
			bdUrl : '自定义分享url地址', 	
			bdPic : '自定义分享图片'
		},
		share : [{
			"bdSize" : 16
		}],
		slide : [{	   
			bdImg : 0,
			bdPos : "right",
			bdTop : 100
		}],
		image : [{
			viewType : 'list',
			viewPos : 'top',
			viewColor : 'black',
			viewSize : '16',
			viewList : ['qzone','tsina','huaban','tqq','renren']
		}],
		selectShare : [{
			"bdselectMiniList" : ['qzone','tqq','kaixin001','bdxc','tqf']
		}]
	}
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>



</body>



</html>