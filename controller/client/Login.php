<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
define("IN_SITE", true);
require_once("../../core/config.php");
require_once("../../core/function.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($TUANORI->get_row(" SELECT * FROM `blockip` WHERE `ip` = '".myip()."' ")) {
        msg("error", "IP của bạn đã bị cấm sử dụng dịch vụ của chúng tôi");
    }
    if(isset($_COOKIE['token'])) {
        msg("error", "Bạn đã đăng nhập trước đó rồi");
    }
    $tk = check_string($_POST['username']);
    $mk = check_string(md5($_POST['password']));
    if(isset($_SESSION['lanspam'])) {
        if($_SESSION['lanspam'] >= 5) {
            $giay = $_SESSION['timeblock'] - time();
            if($giay < 1) {
                $_SESSION['lanspam'] = 0;
                msg("error", "Vui lòng bấm đăng nhập lại 1 lần nữa");
            }
            else {
                msg("error", "Vui lòng thử lại sau ".$giay."s");
            }
        }
        
    }
    if(!$tk || !$mk) {
        msg("error", "Vui lòng không để trống thông tin");
    }
    if(strlen($tk) < 6) {
        msg("error", "Tài khoản của bạn phải trên 6 kí tự");
    }
    if(strlen($mk) < 6) {
        msg("error", "Mật khẩu của bạn phải trên 6 kí tự");
    }
    $CheckUser = $TUANORI->get_row(" SELECT * FROM `users` WHERE `username` = '$tk' ");
    if(!$CheckUser) {
        msg("error", "Tên đăng nhập không tồn tại");
    }
    if($CheckUser['banned'] == 'OFF') {
        msg("error", "Bạn bị đình chỉ vô thời hạn. Hãy liên hệ với BQT");
    }
    if(!$TUANORI->get_row(" SELECT * FROM `users` WHERE `username` = '$tk' AND `password` = '$mk' ")) {
        $_SESSION['timeblock'] = time() + 30;
        if(empty($_SESSION['lanspam'])) {
            $_SESSION['lanspam'] = 1;
        }
        else
        {
            $_SESSION['lanspam'] = $_SESSION['lanspam'] + 1;
        }
        msg("error", "Mật khẩu đăng nhập không chính xác");

    }
    $check_login = $TUANORI->get_row(" SELECT * FROM `users` WHERE `username` = '$tk' AND `password` = '$mk' ");
    if($check_login) {
        /*THÔNG BÁO CHO THÀNH VIÊN*/
        // if($check_login['online'] == 'ONLINE') {
        //     pusher($tk, "error", "Tài khoản của bạn vừa được đăng nhập trên thiết bị có IP là: ".myip()." Vì thế bạn sẽ bị đăng xuất");
        // }
        $token = randomtoken();
        setcookie('token', $token, time() + 2678400, '/');
        $TUANORI->update("users", array(
            'tokenlog'      => $token,
            'timeon'        => gettime(),
            'ip'            => myip(),
            'user_agent'    => $_SERVER['HTTP_USER_AGENT']
        ), " `username` = '$tk'");
        msg("success", "Đăng nhập vào tài khoản thành công", "/", 1000);
    }

} else {
    require_once("../../pages/client/404.php");
}