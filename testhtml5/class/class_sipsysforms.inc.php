<?php class sipsysforms{	   
        function error($title='ERR',$url='') {
                global $tpl;
                include_once(SIPSYS_DIR.'/inc/error2.inc.php');
        }
        function jump_page($URL,$title,$content,$border=0,$canexit=1,$rtime=4) {        	      
                include_once(SIPSYS_DIR.'/inc/jump_page.inc.php');
                if($canexit) exit;
        }       
        function finishMessage($url='',$title1='',$canexit=1,$rtime=4){
        	    global $tpl;        	   	   
                include_once(SIPSYS_DIR.'/inc/finish.inc.php');
                if($canexit)exit;
        }
		function closeMessage($title1='',$canexit=1,$rtime=4){
        	    global $tpl;        	   	   
                include_once(SIPSYS_DIR.'/inc/close.inc.php');
                if($canexit)exit;
        }
        function loginForm($url='',$show=0,$canexit=0,$rtime=30,$adminlogin=0){
                include_once(SIPSYS_DIR.'/inc/login.inc.php');
                if($canexit)exit;
        }
} ?>