<?php
    session_start();
    $_SESSION['weiboContent'] = '';
    if(isset($_REQUEST['content']))
        $_SESSION['weiboContent'] = $_REQUEST['content'];
    echo $_SESSION['weiboContent'];
?> 

