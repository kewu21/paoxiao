<?php
    date_default_timezone_set('Asia/Shanghai');
    error_reporting(7);
    define('ROOT', getcwd());
    define('HOST_NAME', $_SERVER['HTTP_HOST']);
    define('PHP_FILE_NAME', $_SERVER['PHP_SELF']);
    define('BASEDIR', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $url_components = explode('/', BASEDIR);
    array_pop($url_components);
    define('LOC_PATH', implode('/', $url_components));


    if ($_POST['text'] && !empty($_POST['text'])) {
        $ret = array ();
        $text = $_POST['text'];
        try {
            $ret['imgurl'] = text2img($text, (array)$_REQUEST['config']);
        } catch (Exception $e) {
            $ret['imgurl'] = print_r($e, true);
        }
        echo str_replace('\\/', '/', json_encode($ret));
        exit (0);
    }
    function text2img($text, $options = array ()) {
        $text .= "\n-------------------------------";
        $text .= "\n 本条微博是用 @咆哮长微博 生成的 \n \n";
        $rows = substr_count($text, "\n") + 1;
        $font_path = $options['fontfile'] ? $options['fontfile'] : ROOT . '/image/simsun.ttc'; 
        if (!file_exists($font_path))
            throw new Exception("can not find font path: $font_path  ");
        $font_size = $options['fontsize'] ? $options['fontsize'] : 12;
        $padding = $options['padding'] ? $options['padding'] : 20;
        $row_plus_height = $options['row_plus_height'] ? $options['row_plus_height'] : 2;
        $border = 1;
        $im_width = 600;
        $im_height = ($row_plus_height + ($font_size * 4) / 3) * $rows + ($padding + $border) * 2;
        $im = @ imagecreatetruecolor($im_width, $im_height);
        if (!$im)
            throw new Exception("exception when initialize the image, change GD setting");
        imagefilledrectangle($im, $border, $border, ($im_width -2 * $border), ($im_height -2 * $border), imagecolorallocate($im, 255, 255, 255));
        imagettftext($im, $font_size, 0, ($border + $padding), (($font_size * 4) / 3 + $border + $padding), imagecolorallocate($im, 0, 0, 0), $font_path, $text);
        $base_path = '/px_text_img';
        $base_filename = date("Y-m-d_H-i-s") . '.jpg';
        $short_filename = $base_path . '/' . $base_filename;
        $short_url = rtrim(BASEDIR, '/') . $short_filename;
        @ mkdir(ROOT . $base_path, 0777, true);
        $filename = ROOT . $short_filename;
        if (!imagejpeg($im, $filename, 40)) {
            throw new Exception("error when creating image");
        }
        @ imagedestroy($im);
        return 'http://' . HOST_NAME . LOC_PATH . $short_filename;
    }
?>
