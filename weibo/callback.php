<?php

session_start();
include_once( 'config.php' );
include_once( 'weibooauth.php' );



$o = new WeiboOAuth( WB_AKEY , WB_SKEY , $_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret']  );

$last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;

$_SESSION['last_key'] = $last_key;


?>
<title>转发到微博-新浪微博-随时随地分享身边的新鲜事儿</title>
<head>
<link href="http://timg.sjs.sinajs.cn/t3/style/css/shareout/shareout.css" rel="stylesheet" type="text/css">
<link href="http://timg.sjs.sinajs.cn/t3/style/css/common/public.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="reg_wrap">
    <!-- 顶部 LOGO -->
    <div class="TopName">
    <!-- /顶部 LOGO -->
    <div class="reg_main">
        <div class="reg_pub">
            <div class="notice">
                <h2><img src="http://timg1.sjs.sinajs.cn/platformstyle/images/common/transparent.gif" class="wbIcon iconMsg" alt="" title="">转发到我的微博，顺便说点什么吧
		</h2>
		<span id="txt_count_msg">还可以输入<em>140</em>字</span>
            </div>
            <div class="inputTxt">
		<for action=
                <textarea cols="20" rows="5" id="fw_content">
			#咆哮体生成器# 生成的给力咆哮文：“...！！”  一起来咆哮吧！！ @咆哮体生成器 http://lifeis.ws/paoxiao.php </textarea>
		<dl>               
                <!-- 附带转发图片 -->
		    <input type="hidden" id="share_pic" name="share_pic" value=""/>
                <!-- //附带转发图片 -->
                </dl>
            </div>
            <div class="submit">
                <p style="display:none" id="repeatTip">不要太贪心哦，发一次就够啦。</p>
                <span class="btn_turn"><a class="MIB_bigBtn MIB_bigBtnB" href="javascript:void(0);" onclick="return false;" id="btn_send"><cite>转发</cite></a></span>
            </div>
        </div>
        <b class="bg_regBot">&nbsp;</b>
    </div>
</div>

授权完成,<a href="weibolist.php">进入你的微博列表页面</a>
