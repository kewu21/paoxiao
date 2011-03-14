<?php
session_start();
include_once('config.php');
include_once('weibooauth.php');
$o = new WeiboOAuth(WB_AKEY,WB_SKEY,$_SESSION['keys']['oauth_token'],$_SESSION['keys']['oauth_token_secret']);
$last_key = $o->getAccessToken($_REQUEST['oauth_verifier']) ;
$_SESSION['last_key'] = $last_key;
$c = new WeiboClient(WB_AKEY,WB_SKEY, $_SESSION['last_key']['oauth_token'],$_SESSION['last_key']['oauth_token_secret']);
$me = $c->verify_credentials();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache">
<link href="http://timg.sjs.sinajs.cn/t3/style/css/common/public.css" rel="stylesheet" type="text/css" />
<link href="http://timg.sjs.sinajs.cn/t3/style/css/shareout/shareout.css" rel="stylesheet" type="text/css" />
<title>转发到微博-新浪微博-随时随地分享身边的新鲜事儿</title>
</head>
<body>
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
                <h2><img src="http://timg1.sjs.sinajs.cn/platformstyle/images/common/transparent.gif" class="wbIcon iconMsg" alt="" title="">转发到我的微博，顺便说点什么吧</h2>
                <span id="txt_count_msg">还可以输入<em>140</em>字</span>
            </div>
            <div class="inputTxt">
                <form id="post_to_weibo"  action="post.php" method="POST">
                    <textarea cols="20" rows="5" name="text" id="fw_content" style="width:490px;">#咆哮体生成器#生成的给力咆哮文！！一起来咆哮吧！！@咆哮体生成器 http://lifeis.ws/paoxiao.htm  </textarea>
                    <dl>
                    <dt></dt>
                    <!-- 附带转发图片 -->
                    <input type="hidden" id="share_pic" name="share_pic" value=""/>
                    <!-- //附带转发图片 -->
                    </dl>
                </form>
            </div>
            <div class="submit">
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
        $("#post_to_weibo").submit()
    }
</script>
<!--授权完成,<a href="weibolist.php">进入你的微博列表页面</a>-->
