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
    $user       = check_string($_POST['userid']);
    $sotien     = check_string(numb($_POST['coin']));
    if(!$sotien || !$user){
        msg("error", "Vui lòng nhập đầy đủ thông tin");
    }
    if($sotien > $my_money) {
        msg("error", "Số tiền bạn không đủ để thực hiện chuyển tiền");
    }
    if($sotien < 10000) msg("error", "Số tiền chuyển tối thiểu là 10.000đ");
    if($sotien > 1000000) msg("error", "Số tiền chuyển tối đa là 1.000.000đ");
    if($sotien+1000 > $my_money) {
        msg("error", "Số tiền còn lại của bạn không đủ để trả phí");
    }
    if($getUser['id'] == $user) {
        msg("error", "Không thể tự chuyển cho chính mình");
    }
    $check = $TUANORI->get_row(" SELECT * FROM `users` WHERE `id` = '$user' AND `banned` = 'ON'");
    if(!$check)
    {
        msg("error", "Người nhận không tồn tại hoặc người dùng đã bị đình chỉ");
    }
    $job = 'Chuyển '.format_cash($sotien).'đ cho thành viên '.$check['username'].'';
    $isMoney = $TUANORI->tru("users", "money", $sotien+1000, " `tokenlog` = '".$_COOKIE['token']."'");
    if($isMoney)
    {
        $us =  $TUANORI->getId($user);
        $data = $TUANORI->insert("chuyentien", [
            'userchuyen'    => $getUser['username'],
            'usernhan'      => $us['username'],
            'sotien'        => $sotien,
            'time'          => time(),
            'ip'            => myip()
        ]);
        if($data) {
            $TUANORI->insert("biendongsodu", [
                'username'      => $getUser['username'],
                'truoc'         => $my_money,
                'sau'           => $my_money - $sotien - 1000, 
                'note'          => 'Chuyển '.format_cash($sotien).'đ cho thành viên '.$user.'. Phí GD là 1.000đ',
                'tongtien'      => $sotien,
                'time'          => gettime()
            ]);
            $TUANORI->insert("biendongsodu", [
                'username'      => $check['username'],
                'truoc'         => $us['money'],
                'sau'           =>$us['money'] + $sotien, 
                'note'          => 'Nhận '.format_cash($sotien).'đ từ thành viên '.$getUser['username'].'',
                'tongtien'      => $sotien,
                'time'          => gettime()
            ]);
            $isMoney2 = $TUANORI->cong("users", "money", $sotien, " `id` = '$user'");
            msg("success","Đã thực hiện chuyển tiền thành công.", "/client/history/chuyentien", 1000);
        }
    }
}