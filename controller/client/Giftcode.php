<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
define("IN_SITE", true);
require_once("../../core/config.php");
require_once("../../core/function.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($TUANORI->get_row(" SELECT * FROM `blockip` WHERE `ip` = '".myip()."' ")) {
        msg("error", "IP của bạn đã bị cấm sử dụng dịch vụ của chúng tôi");
    }
    if(empty($_COOKIE['token'])) {
        msg("error", "Bạn vui lòng đăng nhập để sử dụng tính năng này");
    }
    $gift = check_string($_POST['giftcode']);
    if(!$gift) {
        msg("error", "Vui lòng nhập giftcode");
    }
    if(!$row = $TUANORI->get_row(" SELECT * FROM `giftcode` WHERE `gift` = '$gift' AND `status` = '1' ")) {
        msg("error", "Giftcode của bạn không đúng");
    }
    if($row['gift'] !== $gift) { // PHÂN BIỆT CHỮ HOA THƯỜNG
        msg("error", "Giftcode của bạn không đúng");
    }
    $TUANORI->cong("users", "money", $row['amount'], " `tokenlog` = '".$_COOKIE['token']."'"); // cộng tiền thành viên
    $add = $TUANORI->insert("biendongsodu", [
        'username'      => $getUser['username'],
        'truoc'         => $my_money,
        'sau'           => $my_money +  $row['amount'],
        'note'          => 'Nhập giftcode mã '.$gift.' thành công',
        'tongtien'      => $row['amount'],
        'time'          => gettime()
    ]); // lưu lại lịch sử
    if($add) {
        $TUANORI->update("giftcode", array( // cập nhật thông tin
            'status'    => 0,
            'username'  => $getUser['username'],
            'uptime'    => gettime()
        ), " `gift` = '$gift'");
        msg("success", "Nhập giftcode thành công, bạn nhận được ".number_format($row['amount'])."đ", "", 1500);
    }
}