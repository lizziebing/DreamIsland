<?php

// define('SIPSYS_DIR',"C:/wamp/www/testhtml5/");
include SIPSYS_DIR."libs/Smarty.class.php";
class CSmarty extends Smarty
{
    //var  $include;
    var  $img;
    var  $js; 
    var $css; 
    var $lang;
    var $images;
    var $sound;
    function CSmarty($lang="cn")
    {

        $this->Smarty();
        $this->include="";  
        $this->left_delimiter='<{';
        $this->right_delimiter='}>';
        $this->caching=false;
        $this->lang=$lang;
        $this->template_dir = SIPSYS_DIR .'/'.$lang .'/templates/';
        $this->compile_dir  = SIPSYS_DIR .'/'.$lang .'/templates_c/';        
        $this->cache_dir    = SIPSYS_DIR .'/'.$lang .'/cache/';       
        $this->img          = $lang.'/img';
        $this->css          = $lang.'/css'; 
        $this->js           =  $lang.'/jscript';  
        $this->images       ="../images"; 
        $this->sound        =$lang."/voicefile/";
    }    
    function fetch( $template, $cache_id = null, $compile_id = null, $display = false )
    {  
        return( parent::fetch( $template, $cache_id, $compile_id, $display ) );
    }
    function display( $template, $cache_id = null, $compile_id = null )
    {
        $this->fetch( $template, $cache_id, $compile_id, true);
    }
}

?>
