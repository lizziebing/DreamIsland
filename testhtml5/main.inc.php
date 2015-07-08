<?php
      include"./libs/Smarty.class.php";//包含Smarty类库所在的文件
      //define('SITE_ROOT','./test1');//声明一个常量指定非Web服务器的根目录
      $tpl=new Smarty();//创建一个Smarty类的对象$tpl
     /* $tpl->template_dir=SITE_ROOT."/templates/";
      $tpl->compile_dir=SITE_ROOT."/templates_c/";
      $tpl->config_dir=SITE_ROOT."/configs/";//设置模板中特殊配置文件存放的目录
      $tpl->cache_dir=SITE_ROOT."/cache/";//设置存放Smarty缓存文件的目录
      */
     $tpl->template_dir="templates";
      $tpl->compile_dir="templates_c";
      $tpl->config_dir="configs";//设置模板中特殊配置文件存放的目录
      $tpl->cache_dir="cache";//设置存放Smarty缓存文件的目录
      $tpl->caching=1;//设置开启Smarty缓存模板功能
      $tpl->cache_lifetime=60*60*24;//设置模板缓存有效时间段的长度为1天
      $tpl->left_delimiter='<{';//设置模板语言中的左结束符
      $tpl->right_delimiter='}>';//设置模板语言中的右结束符
      


?>