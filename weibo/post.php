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
        <div>
        </div>
        <?php if( is_array( $rr ) ): ?>
        <?php foreach( $rr as $item ): ?>
        <div>
            <?php echo $item; ?>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <div>
        </div>
