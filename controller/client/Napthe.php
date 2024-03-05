<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
define("IN_SITE", true);
require_once("../../core/config.php");
require_once("../../core/function.php");
// msg("error", "Nhập lại mật khẩu không đúng");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($TUANORI->get_row(" SELECT * FROM `blockip` WHERE `ip` = '".myip()."' ")) {
        msg("error", "IP của bạn đã bị cấm sử dụng dịch vụ của chúng tôi");
    }
    if(empty($_COOKIE['token'])) {
        msg("error", "Bạn vui lòng đăng nhập để sử dụng tính năng này");
    }
    if(
        $TUANORI->num_rows("SELECT * FROM `napcard` WHERE `status` = 'thatbai' AND `username` = '".$getUser['username']."' AND `thoigian` >= DATE(NOW()) AND `thoigian` < DATE(NOW()) + INTERVAL 1 DAY  ") - 
        $TUANORI->num_rows("SELECT * FROM `napcard` WHERE `status` = 'hoantat' AND `username` = '".$getUser['username']."' AND `thoigian` >= DATE(NOW()) AND `thoigian` < DATE(NOW()) + INTERVAL 1 DAY  ") >= 6) {
        msg("error", "Rất tiếc. Bạn đang có nhiều thẻ nạp sai. Vui lòng chờ hôm sau để nạp tiếp");

    }
    $seri           = check_string($_POST['serial']);
    $pin            = check_string($_POST['pin']);
    $type           = check_string($_POST['nhamang']);
    $amount         = check_string($_POST['menhgia']);
    $tranid         = rand(111111111111,999999999);
    if(!$seri || !$pin || !$type || !$amount) {
        msg("error", "Vui lòng nhập đầy đủ thông tin");
    }
    if(strlen($pin) < 7) {
        msg("error", "Độ dài mã thẻ không đúng định dạng");
    }
    if(strlen($seri) < 7) {
        msg("error", "Độ dài seri không đúng định dạng");
    }
    if($TUANORI->num_rows(" SELECT * FROM `napcard` WHERE `username` = '".$getUser['username']."' AND `status` = 'xuly'") >= 3) {
        msg("error", "Bạn đang có 3 thẻ chờ duyệt. Vui lòng duyệt xong rồi nạp tiếp");
    }
    else {
        $partner_id = $TUANORI->site('partner_id');
        $partner_key = $TUANORI->site('partner_key');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CONNECTTIMEOUT => 0,
            CURLOPT_TIMEOUT => 16,
          CURLOPT_URL => 'https://cardvip.vn/chargingws/v2',
            CURLOPT_USERAGENT => 'TUANORI CURL',
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_POSTFIELDS => http_build_query(array(
                'sign' => md5($partner_key.$pin.$seri),
                'telco' => $type,
                'code' => $pin,
                'serial' => $seri,
                'amount' => $amount,
                'request_id' => $tranid,
                'partner_id' => $partner_id,
                'command'   => 'charging'
            ))
        ));
        $resp = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($resp, true);
        if(isset($data['status'])) {
            if($data['status'] == 99) {
                $thucnhan = chietkhau($amount, $TUANORI->site('ckcard'));
                $create = $TUANORI->insert("napcard", [
                    'username'          => $getUser['username'],
                    'loaithe'           => $type,
                    'menhgia'           => $amount,
                    'seri'              => $seri,
                    'pin'               => $pin,
                    'thucnhan'          => $thucnhan,
                    'requestid'         => $tranid,
                    'status'            => 'xuly',
                    'thoigian'          => gettime()
                ]);
                msg("success", "Đã gửi thẻ thành công. Mã thẻ $pin đang chờ xử lý. Vui lòng đợi 10 - 30s", "/", 1500);
            } else {
                msg("error", $data['message']);
            }
        } else {
            msg("error", "Liên hệ với ADMIN để nạp thẻ. Chức năng đang lỗi");
        }
    }
}