<?php

App::before(function ($request) {
    $check = 1;
    //浏览器调试
    if (isset($_COOKIE['ganbadie_printer'])) {
        $check = 0;
    }
    //支付宝回调
    if (isset($_POST['trade_status'])) {
        $check = 0;
    }
    //微信回调
    $post_str = file_get_contents("php://input", true);
    if ($post_str) {
        $post_obj = @simplexml_load_string($post_str, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (isset($post_obj->return_code)) {
            $check = 0;
        }
    }
    if ($check == 1) {
        $check_success = 0;
        $urls = [
            "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
            "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
        ];
        foreach ($urls as $url) {
            $md5_param = Input::get('md5', '');
            $url_md5_pos = strpos($url, '&md5=');
            if (!$url_md5_pos) {
                $url_md5_pos = strpos($url, '?md5=');
            }
            $url_md5_len = strlen('&md5=') + 6;
            $url_head = substr($url, 0, $url_md5_pos);
            $url_body = strstr($url, $url_md5_len, -1);
            $current_url = $url_head . $url_body;
            $md5_check = substr(md5($current_url), 0, 6);
            if ($md5_check == $md5_param) {
                $check_success = 1;
            }
        }
        if (!$check_success) {
            App::abort(404);
        }
    }
});

function _compare($version, $last_version)
{
    if (substr_count($version, '.') === 1) {
        $version .= '.0';
    }
    $version_arr = explode('.', $version);
    $last_version_arr = explode('.', $last_version);
    for ($i = 0; $i < 3; ++$i) {
        if ((int)$last_version_arr[$i] > (int)$version_arr[$i]) {
            return true;
        }
        if ((int)$last_version_arr[$i] < (int)$version_arr[$i]) {
            return false;
        }
    }
    return false;
}

App::after(function ($request, $response) {
});
