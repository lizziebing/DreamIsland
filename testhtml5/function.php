<?php
/*
 * @时间转换函数和输出内容格式化函数
 */

function commentWB($commentwire){
        $htmlcontent = '<div class="commentContent"><ul><li><div><textarea id="commentBox" class="commentClass" name="commentText"></textarea></div><div class="tr"><span id="commentmsg"></span><p><span class="countTxt">还能输入</span><strong class="commentNum">140</strong><span>个字</span><input id="commentBtn" type="button" style="background-image:url(cn/img/weibo/pinglun.png)"/></p></div></li>';
        if(empty($commentwire)){
                $htmlcontent .= '<li><div><span>没有评论</span></div></li>';
        }else{
                $htmlcontent .= '<li><div><span>全部评论</span></div></li>';
                foreach($commentwire as $single){
                    $commentID = $single['guid'];
                    $guid = $single['owner']['guid'];
                    $name = $single['owner']['name'];
                    $avatar_url = $single['owner']['avatar_url'];
                    $comment = $single['value'];
                    $time = $single['time_created'];
                    $wireID = $single['entity_guid'];
                    //$say=htmlspecialchars(stripslashes($say));
                    $htmlcontent .='<li><div class="WBcomment_'.$commentID.'"><div class="userPic"><img src='.$avatar_url.'/></div><div class="content_'.$commentID.'"><div class="userName"><a href="javascript:void(0)">'.$name.'</a>:</div><div class="msgInfo">'.$comment.'</div><div class="times"><span>'.trantime($time).'</span></div><div class="func_handle"><a href="javascript:void(0)" onclick="deleteComment('.$wireID.','.$commentID.')">删除</a></div></div></div></li>';
                }
       }
         $htmlcontent .='</ul></div>';
         return $htmlcontent;
}
/*时间转换函数*/
function tranTime($ustime) {
            $ytime = date("Y-m-d H:i",$ustime);
            //$rtime = date("m月d日 H:i",$ustime);
            $rtime = date("n月j日 H:i",$ustime);
            $htime = date("H:i",$ustime);
            $time = time() - $ustime;
            $todaytime = strtotime("today");
            $time1 = time() - $todaytime;
            
            if($time < 60){
                    $str = '刚刚';
            }
            else if($time < 60 * 60){                    
                    $min = floor($time/60);
                    $str = $min.'分钟前';
            }
            else if($time < $time1){
                    $str = '今天 '.$htime;
            }
            else{
                    $str = $rtime;
            }
            return $str;
            //return $ttime;
}
function announce_trans_time($ustime) {
            $ytime = date("Y-m-d H:i",$ustime);
            //$rtime = date("m月d日 H:i",$ustime);
            $rtime = date("n月j日",$ustime);
            $htime = date("H:i",$ustime);
            $todaytime = strtotime("today");
            $yesterdaytime = strtotime("yesterday");
            
            if($ustime > $todaytime ){
                    $str =$htime;
            }else if($ustime > $yesterdaytime && $ustime < $todaytime){
                    $str = '昨天 '.$htime;
            }else{
                    $str = $rtime;
            }
            return $str;
            //return $ttime;
}
//初始化微博图片资源库
function initEmotions(){
    global $emotions ;
    $filename = "http://42.121.125.50/face_resource/emotions.json";

    $json = json_decode(file_get_contents($filename));//将json结构变量$content用json_decode()函数解析为对象,如果加第二个参数为true，则解析为数组

    foreach($json as $single){
        $phrase = iconv("utf-8","gb2312",$single->phrase);//不转换会显示时乱码
        $emotions[$phrase]=$single->icon;
//      file_put_contents("/home/zsc.txt","\nwowo:".$phrase."=>".$emotions[$phrase],FILE_APPEND);
    }
    return $emotions;
}

// //初始化微信图片资源库
// function initEmotionsWeixin(){
//     global $pattern_weixin ;
//     global $replace_weixin ;
//     $filename = "http://42.121.125.50/face_resource/weixin_emotions.json";

//     $json = json_decode(file_get_contents($filename));//将json结构变量$content用json_decode()函数解析为对象,如果加第二个参数为true，则解析为数组
//     $i=0;
//     foreach((array)$json as $single){
// //     $pattern_weixin[$i]="{".preg_replace($pattern_regure,$replace_regure,$single->phrase)."}" ;
//         $pattern_weixin[$i]="{".preg_quote($single->phrase)."}";
//         $replace_weixin[$i]= "<img src=\"".$single->icon."\" style=\"width:22px;height:22px;\" />";
//     //file_put_contents("/home/zsc.txt","\nwowo:$single->phrase =>".$pattern_weixin[$i]."=>".$replace_weixin[$i],FILE_APPEND);
//         $i=$i+1;
//     }
//     return $weixin_emotions;
// }
//把表情文本替换成图片
function replaceEmotions($content){
    global $emotions;
    preg_match_all("/\[.*?\]/", $content,$arr,PREG_PATTERN_ORDER);
      //file_put_contents("/home/zsc.txt","\nwowo:".json_encode($arr[0])."=>".json_encode($arr[1]),FILE_APPEND);
    //通过for循环，将留言中的表情替换成用于显示表情的html代码
    $out = $content;
    foreach($arr[0] as $single){
        $single = iconv("utf-8","gb2312",$single);//不转换会显示时乱码
        if($emotions[$single]){
            $img = "<img src=\"".$emotions[$single]."\" height=\"22\" width=\"22\" />";
            $single = iconv("gb2312","utf-8",$single);//不转换会显示时乱码
            $out = str_replace($single,$img,$out); 
        }
    }

    return $out;
}
// //把微信表情文本替换成图片
// function replaceEmotionsWeixin($content){
//     global $pattern_weixin;
//     global $replace_weixin;
//     //file_put_contents("/home/zsc.txt","\nsoso:$content",FILE_APPEND);
//     $content=preg_replace($pattern_weixin,$replace_weixin,$content) ;

//     //file_put_contents("/home/zsc.txt","\nwowo:$content",FILE_APPEND);
//     return $content;
// }

?>
