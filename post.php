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
        <p><h1><a href='javascript:closeWindow()'>关闭这个页面再去咆一次！！</a></h1></p>
        <p id="countDown" style="color:#580"></p>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
<script language="Javascript" text="text/javascript">
    var info = $("#countDown")
    var start=new Date();
    start=Date.parse(start)/1000;
    var counts=5;
    function CountDown(){
        var now=new Date();
        now=Date.parse(now)/1000;
        var x=parseInt(counts-(now-start),10);
        info.html(x+'后就要自己动关闭了！！')
        if(x>0){
            timerID=setTimeout("CountDown()", 10)
        }else{
            window.opener.location.reload()
            window.close()
        }
    }
    $(document).ready(function(){
        CountDown()
    })
    function closeWindow(){
            window.opener.location.reload()
            window.close()
    }
</script>
