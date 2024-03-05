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
    
    // status == 99 là vô
    $id = check_string($_POST['pack_id']); // id gói
    $amount = check_string($_POST['soluong']); // số lượng mua
    $key = check_string($_POST['key']);
    if(!$id) {
        msg("error", "Bạn vui lòng chọn gói");
    }
    if($amount < 1) {
        msg("error", "Số lượng mua không hơp lệ");
    }
    if(!$goi = $TUANORI->get_row(" SELECT * FROM `category_goi` WHERE `id` = '$id' AND `status` = '1'")) {
        msg("error", "Gói mua không hợp lệ");
    }
    $sl = $TUANORI->num_rows(" SELECT * FROM `list_key` WHERE `category_goi` = '$id' AND `status` = '1' ");
    if(!$sl) {
        msg("error", "Gói này hiện đã hết key, vui lòng chọn gói khác");
    }
    if($sl < $amount) {
        msg("error", "Chúng tôi hiện có ".$sl." sản phẩm cho gói này, vui lòng mua ít lại");
    }
    $sotien = giamgia($goi['money'], $my_gg)* $amount;
    if($sotien > $getUser['money']) {
        msg("error", "Số tiền của bạn không đủ để thanh toán, vui lòng nạp thêm.");
    }
    $name = $TUANORI->get_row(" SELECT * FROM `categories_sp` WHERE `category` = '$id' AND `status` = '1'");
    if($key == 0) {
        // msg("99", $name['name']);
        $data = [
            'status' => 99,
            'messages' => [
                'banhack'   => $name['name'],
                'pack' => $id,
                'soluong' => $amount,
                'price' => number_format($sotien),
                'time' => $goi['time'].' giờ',
                'type' => number_format($goi['money']).' vnđ'
            ]
        ];
        die(json_encode($data));
    }
    if($key == 1) {
        $TUANORI->tru("users", "money", $sotien, " `tokenlog` = '".$_COOKIE['token']."'"); // trừ tiền thành viên
        $add = $TUANORI->insert("biendongsodu", [
            'username'      => $getUser['username'],
            'truoc'         => $my_money,
            'sau'           => $my_money - $sotien,
            'note'          => 'Đã mua '.$amount.' key thành công với giá '.number_format($sotien).'đ',
            'tongtien'      => $sotien,
            'time'          => gettime()
        ]); // lưu lại lịch sử
        foreach($TUANORI->get_list(" SELECT * FROM `list_key` WHERE `category_goi` = '$id' AND `status` = '1' ORDER BY id DESC") as $row){
            $TUANORI->insert("ls_mua", [
                'username'      => $getUser['username'],
                'categories_sp' => $name['id'],
                'category_goi'  => $id,
                'token'         => $row['token'],
                'thoigian'      => gettime(),
                'sotien'        => giamgia($goi['money'], $my_gg)
            ]); // thêm lịch sử vào hệ thống
            $TUANORI->update("list_key", array(
                'status'        => 0
            ), " `category_goi` = '$id' AND `status` = '1'  ");
        }
        msg(99, "Đã thanh toán thành công");
    }
}