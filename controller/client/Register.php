<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
define("IN_SITE", true);
require_once("../../core/config.php");
require_once("../../core/function.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($TUANORI->get_row(" SELECT * FROM `blockip` WHERE `ip` = '".myip()."' ")) {
        msg("error", "IP của bạn đã bị cấm sử dụng dịch vụ của chúng tôi");
    }
    // if(isset($_COOKIE['token'])) {
    //     msg("error", "Bạn đã đăng nhập trước đó rồi");
    // }
    $email      = check_string($_POST['email']);
    $user       = check_string($_POST['username']);
    $pass       = check_string($_POST['password']);
    $pass2      = check_string($_POST['repassword']);
    $phone      = check_string($_POST['phone']);
    if(!$email || !$user || !$pass  ) {
        msg("error", "Vui lòng không để trống thông tin");
    }
    if(strlen($user) < 6 || strlen($user) > 24) {
        msg("error", "Tài khoản của bạn phải trên 6 và dưới 24 kí tự");
    }
    if(strlen($pass) < 6) {
        msg("error", "Mật khẩu của bạn phải trên 6 kí tự");
    }
    if(check_email($email) != 'True') {
        msg("error", "Email của bạn không hợp lệ để đăng ký");
    }
    if(check_username($user) != 'True') {
        msg("error", "Tài khoản của bạn không được chứa kí tự lạ");
    }
    if(check_username($phone) != 'True') {
        msg("error", "Số điện thoại không đúng định dạng");
    }
    if($pass != $pass2) {
        msg("error", "Nhập lại mật khẩu không đúng");
    }
    if($TUANORI->get_row(" SELECT * FROM `users` WHERE `username` = '$user' ")) {
        msg("error", "Tên đăng nhập đã tồn tại!");
    }
    if($TUANORI->get_row(" SELECT * FROM `users` WHERE `email` = '$email' ")) {
        msg("error", "Email đã tồn tại!");
    }
    if($TUANORI->num_rows(" SELECT * FROM `users` WHERE `ip` = '".myip()."' ") >= 10) {
        msg("error", "Bạn đã đạt giới hạn tạo tài khoản!");
    }
    $token = randomtoken();
    $timegio = time();
    $create = $TUANORI->insert("users", [
        'username'          => $user,
        'password'          => md5($pass),
        'email'             => $email,
        'phone'             => $phone, 
        'money'             => 0,
        'total_money'       => 0,
        'level'             => 'member',
        'tokenlog'          => $token,
        'timereg'           => gettime(),
        'timeon'            => gettime(),
        'online'            => 'ONLINE',
        'ip'                => myip(),
        'user_agent'        => $_SERVER['HTTP_USER_AGENT']
    ]);
    if($create) {
        setcookie('token', $token, time() + 2678400, '/');
        // $kq = sendCSM($email, $hoten, $subject, $noi_dung, $bcc);
        msg("success", "Đăng ký thành công! Chờ chuyển hướng ..", "/", 1000);

    }
    else {
        msg("error", "Lỗi cấu hình CSDL rồi");
    }
}