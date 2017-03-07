<?php 
define("APPID","wxc0813363b0684884");
define("APPSECRET","c99aae7d4ed073630559bf639abc11b4");
define("TOKEN","weixin");

require("wechat.php");
$wechat = new WeChat(APPID,APPSECRET,TOKEN);
$wechat->responseMsg();
?>