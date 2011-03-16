<?php
session_start();
include_once('weibo/config.php');
include_once('weibo/weibooauth.php');
$o = new WeiboOAuth(WB_AKEY,WB_SKEY,$_SESSION['keys']['oauth_token'],$_SESSION['keys']['oauth_token_secret']);
$last_key = $o->getAccessToken($_REQUEST['oauth_verifier']) ;
$_SESSION['last_key'] = $last_key;
$c = new WeiboClient(WB_AKEY,WB_SKEY, $_SESSION['last_key']['oauth_token'],$_SESSION['last_key']['oauth_token_secret']);
$me = $c->verify_credentials();
function utf8_substr($str,$start) {
    $null = "";
    preg_match_all("/./u", $str, $ar);
    if(func_num_args() >= 3) {
        $end = func_get_arg(2);
        return join($null, array_slice($ar[0],$start,$end));
    } else {
        return join($null, array_slice($ar[0],$start));
    }
}
//echo $_SESSION['weiboContent'].'有木有';
if($_SESSION['weiboContent'] != ''){
    $cutted = utf8_substr($_SESSION['weiboContent'],0,60);
    $content = "#咆哮体生成器#生成的给力咆哮文──“".$cutted."....”一起来咆哮吧！！@咆哮体生成器 http://lifeis.ws/paoxiao.php"; 
}else{
    $content = "#咆哮体生成器#可以自动生成咆哮体的神器噢！！一起来咆哮吧！！@咆哮体生成器 http://lifeis.ws/paoxiao.php";
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache">
<link href="http://timg.sjs.sinajs.cn/t3/style/css/common/public.css" rel="stylesheet" type="text/css" />
<link href="http://timg.sjs.sinajs.cn/t3/style/css/shareout/shareout.css" rel="stylesheet" type="text/css" />
<title>咆哮到微博-随时随地咆哮身边的新鲜事儿</title>
</head>
<body onunload="opener.reload()">
<div class="reg_wrap">
    <!-- 顶部 LOGO -->
    <div class="TopName">
        <div class="logo"></div>

        <a href="http://t.sina.com.cn/<?php echo $me['id']?>" target="_blank" class="logoLink"></a>
        <div class="op">
            <span>你正在使用 <a href="http://t.sina.com.cn/<?php echo $me['id']?>" target="_blank"  class="userID"><?php echo $me['name']?></a> 帐号</span>
        </div>
    </div>
    <!-- /顶部 LOGO -->
    <div class="reg_main">
        <b class="bg_regTop">&nbsp;</b>
        <b class="bg_deco_b">&nbsp;</b>
        <div class="reg_pub">
            <div class="notice">
                <h2><img src="http://timg1.sjs.sinajs.cn/platformstyle/images/common/transparent.gif" class="wbIcon iconMsg" alt="" title="">咆哮到我的微博，还可以再加点料！！</h2>
                <span id="txt_count_msg">只能咆哮<em>140</em>个字</span>
            </div>
            <div class="inputTxt">
                <form id="post_to_weibo"  action="post.php" method="POST">
                    <textarea cols="20" rows="5" name="text" id="fw_content" style="width:490px;"><?php echo $content?></textarea>
                    <dl>
                    <dt></dt>
                    <!-- 附带转发图片 -->
                    <input type="hidden" id="share_pic" name="share_pic" value=""/>
                    <!-- //附带转发图片 -->
                    </dl>
                </form>
            </div>
            <div class="submit">
                <span class="warning" style="color:red"></span>
                <span class="btn_turn"><a class="MIB_bigBtn MIB_bigBtnB" href="javascript:submit_post()" id="btn_send"><cite>转发</cite></a></span>
            </div>
        </div>
        <b class="bg_regBot">&nbsp;</b>
    </div>
    <!--气泡层-->
        <!--/气泡层-->
</div>

<!-- SUDA_CODE_START -->
<div style='position:absolute;top:0;left:0;width:0;height:0;z-index:1'><div style='position:absolute;top:0;left:0;width:1;height:1;'><iframe id='SUDA_FC' src='' width=1 height=1 SCROLLING=NO FRAMEBORDER=0></iframe></div><div style='position:absolute;top:0;left:0;width:0;height:0;visibility:hidden' id='SUDA_CS_DIV'></div></div>
<noScript>
<div style='position:absolute;top:0;left:0;width:0;height: 0;visibility:hidden'><img width=0 height=0 dynamic-src='http://beacon.sina.com.cn/a.gif?noScript' border='0' alt='' /></div> </noScript>
<!-- SUDA_CODE_END --></body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
    function submit_post(){
        if ($("#fw_content").val().length > 140){
            $(".warning").html("只能写140个字啊亲！！")
        }else{
            $("#post_to_weibo").submit()
        }
    }
</script>
