<?php
session_start();
include_once( 'config.php' );
include_once( 'weibooauth.php' );
$c = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );
$ms  = $c->home_timeline(); // done
$me = $c->verify_credentials();
if(isset($_REQUEST['text'])){
    if(isset($_REQUEST['pic']))
        $rr = $c ->upload( $_REQUEST['text'] , $_REQUEST['pic']);
    else
        $rr = $c->update($_REQUEST['text']);	
}
?>
<link href="../paoxiao.css" rel="stylesheet" type="text/css"/>
<div id="wrap" style="text-align:center">
    
    <?php if( !$rr === false ): ?>
        <p><id="successInfo">发送成功！</p>
    <?php endif; ?>
        <p>世界上最快乐的事情是什么？</p>
        <p><h1><a href='../paoxiao.php'>再咆一次！！</a></h1></p>
</div>
