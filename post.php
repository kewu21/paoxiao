<?php
session_start();
include_once( 'weibo/config.php' );
include_once( 'weibo/weibooauth.php' );
$c = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );
$ms  = $c->home_timeline(); // done
$me = $c->verify_credentials();
if(isset($_REQUEST['text'])){
    if(isset($_REQUEST['pic']))
        $rr = $c ->upload( $_REQUEST['text'] , $_REQUEST['pic']);
    else
        $rr = $c->update($_REQUEST['text']);	
}
if( $rr === false || $rr === null){
    $msg = "<p>可耻的发送失败了，</p><p>但是木有关系有没有！！</p>";
}else{
    $msg = "<p>咆哮成功！</p>";
}
?>
<link href="image/paoxiao.css" rel="stylesheet" type="text/css"/>
<div id="wrap" style="text-align:center">
        <div><?php echo $msg?></div>
        <p><h1><a href='javascript:closeWindow()'>再咆一次！！</a></h1></p>
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
        info.html(x+'后就要自动关闭了！！')
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
