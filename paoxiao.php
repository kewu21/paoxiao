<?php
    session_start();
    include_once('weibo/config.php');
    include_once('weibo/weibooauth.php');
    $o = new WeiboOAuth(WB_AKEY,WB_SKEY);
    $keys = $o->getRequestToken();
    $callback = 'http://localhost/~kewu/paoxiaoti/share.php';
    $aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , $callback );
    $_SESSION['keys'] = $keys;
    if(isset($_REQUEST['text'])){
        $c = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );
        $me = $c->verify_credentials();
        if(isset($_REQUEST['pic']))
            $rr = $c ->upload( $_REQUEST['text'] , $_REQUEST['pic']);
        else
            $rr = $c->update($_REQUEST['text']);	
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--
By Leon, Zeke, DiamRem 新浪微薄：@LeonV2，@赵望野
-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="咆哮体生成器, 咆哮, 咆哮体, 伤不起, 景涛, 马景涛, 有木有, 尼玛, 肿么" />
<meta name="descpriction" content="咆哮体生成器" />
<title>咆哮体生成器</title>
<link href="paoxiao.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-15427977-1']);
	_gaq.push(['_trackPageview']);

	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();

</script>
</head>
<body>
<div id="warp">
        <div id="head">
	<h1><span style="font-size: 60px;">咆哮体</span>生成器</h1>
        <a id="connectWeibo"  href="javascript:submit_post();"><img title="我们的应用可以直接咆哮到微博有没有！！" alt="转发到微博" src='sina_btn' /></a>
	<div style="clear: both"></div>
        </div>
	<br />
            <div id="aboveArea">
		<span>请输入要咆哮的文字&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a target="_blank" href="http://douban.com/online/10763106/">看看其他人的咆哮</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a target="_blank" href="http://t.sina.com.cn/k/%25E5%2592%2586%25E5%2593%25AE%25E4%25BD%2593%25E7%2594%259F%25E6%2588%2590%25E5%2599%25A8">新浪围脖上的咆哮</a></span>
                        
		<span id="share">
			<a href="javascript:void(function(){var d=document,e=encodeURIComponent,s1=window.getSelection,s2=d.getSelection,s3=d.selection,s=s1?s1():s2?s2():s3?s3.createRange().text:'',r='http://www.douban.com/recommend/?url='+e(d.location.href)+'&title='+e(d.title)+'&sel='+e(s)+'&v=1',x=function(){if(!window.open(r,'douban','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330'))location.href=r+'&r=1'};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})()"><img src="http://img2.douban.com/pics/fw2douban_s.png" alt="推荐到豆瓣" title="推荐到豆瓣"/></a>
			<a href="javascript:void((function(s,d,e){if(/renren\.com/.test(d.location))return;var f='http://share.renren.com/share/buttonshare?link=',u=d.location,l=d.title,p=[e(u),'&title=',e(l)].join('');function%20a(){if(!window.open([f,p].join(''),'xnshare',['toolbar=0,status=0,resizable=1,width=626,height=436,left=',(s.width-626)/2,',top=',(s.height-436)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent));" title="分享到人人"><img src="http://a.xnimg.cn/imgpro/share/share-tinybtn.png" title="分享到人人"/></a>
		</span>
                </div>
		<div style="clear: both"></div>
  		<div><textarea id="content" disabled="disabled" cols="60" rows="5">... ...</textarea></div>
  		<div><input id="generate" class="genButton" type="button" value="写好了，咆哮吧！！！！！！！！！！"></input><span>&nbsp;&nbsp;&nbsp;每次都不一样有木有！！！！！！</span></div>
	<hr />
	<input type="button" class="retweet" id="toClipboard" value="咆哮到剪贴板！！！"></input>
	<input id="connectWeibo" class="retweet" type ="button" value="咆哮到微博！" onclick="javascript:submit_post();"></a>
	<div id="output"></div>
	<input type="button" class="genButton" id="secondGen" value="再咆哮一次！！！"></input>
        <div>
        </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
<script src="jquery.zclip.min.js" type="text/javascript"></script>
<script src="paoxiao.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
    function submit_post(){
        $.post('weibo/session.php',
            {content: textToPaste},
            function(data){
            }
        );
        window.name = "paoxiaoti"
        window.open('<?php echo $aurl?>', '_blank','width=600,height=450')
    }
</script>
</body>
</html>
