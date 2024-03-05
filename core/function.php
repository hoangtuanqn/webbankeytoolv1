<?php
if (!defined('IN_SITE')) die('The Request Not Found');
$TUANORI = new TUANORI;
// $site_gmail_momo    = $TUANORI->site('email');
// $site_pass_momo     = $TUANORI->site('pass_email');
// require_once(__DIR__.'/../lib/Pusher.php');
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/

function sendCSM($mail_nhan,$ten_nhan,$chu_de,$noi_dung,$bcc)
{
    // return true;
    global $site_gmail_momo, $site_pass_momo;
        // PHPMailer Modify
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail ->Debugoutput = "html";
        $mail->isSMTP();
        $mail->Host = 'mail.tuanori.vn';
        $mail->SMTPAuth = true;
        $mail->Username = $site_gmail_momo; // GMAIL STMP
        $mail->Password = $site_pass_momo; // PASS STMP
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($site_gmail_momo, $bcc);
        $mail->addAddress($mail_nhan, $ten_nhan);
        $mail->addReplyTo($site_gmail_momo, $bcc);
        $mail->isHTML(true);
        $mail->Subject = $chu_de;
        $mail->Body    = $noi_dung;
        $mail->CharSet = 'UTF-8';
        $send = $mail->send();
        return $send;
}
$MEMO_PREFIX = $TUANORI->site('noidung_naptien');
function get_id_bank($des)
{
    global $MEMO_PREFIX;
    $re = '/'.$MEMO_PREFIX.'\d+/im';
    preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);
    if (count($matches) == 0 )
        return null;
    // Print the entire match result
    $orderCode = $matches[0][0];
    $prefixLength = strlen($MEMO_PREFIX);
    $orderId = intval(substr($orderCode, $prefixLength ));
    return $orderId ;
}

function send_tele($data)
{
    global $TUANORI;
    $id     = $TUANORI->site("id_tele");
    $key    = $TUANORI->site("key_tele");
    $json = json_decode(file_get_contents('https://api.telegram.org/bot'.$key.'/sendMessage?chat_id='.$id.'&text='.urlencode($data)), true);
    return $json;
}


function BASE_URL($url)
{
    global $base_url;
    return $base_url.$url;
}
function format_date($time){
    return date("H:i:s d/m/Y", $time);
}
function gettime()
{
    return date('Y/m/d H:i:s', time());
}
function gettime2($data)
{
    return date('Y-m-d H:i:s', $data);
}
function check_string($data)
{
    return trim(htmlspecialchars(addslashes($data)));
}
function format_cash($price)
{
    return str_replace(",", ".", number_format($price));
}
function sotienmua($data)
{
    if($data > 0)
    {
        return format_cash($data).'₫';
    }
    else
    {
        return 'Miễn phí';
    }
}
function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    
    curl_close($ch);
    return $data;
}
function random($string, $int)
{  
    return substr(str_shuffle($string), 0, $int);
}

function check_img($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("png","jpeg","jpg","PNG","JPEG","JPG","gif","GIF");
    if(in_array($ext, $valid_ext))
    {
        return true;
    }
}
function hienthi($data)
{
    if(!$data)
    {
        return '';
    }
    else
    {
        return $data;
    }
}
function msg($status, $msg, $url = '-1', $time = 0) {
    die(json_encode(['status' => $status, 'messages' => $msg, 'url' => $url, 'time'=> $time ]));
}
function chietkhau($data, $data1)
{
    return $data - ($data*$data1/ 100);
}
// function pusher($username = '', $status, $msg) {
//     // $username username nhận thông báo; $status // trạng thái success, error; $msg nội dung
//     $options = array(
//         'encrypted' => true
//     );
//     $pusher = new Pusher(
//             '10d5ea7e7b632db09c72', 'a496a6f084ba9c65fffb', '234217', $options
//     );
//     $arr['type'] = $status;
//     $arr['message'] = $msg;
//     $pusher->trigger($username, 'realtime', $arr);
// }
function msg_success2($text)
{
    return die('<script type="text/javascript">Swal.fire("Thành Công", "'.$text.'", "success");</script>');
}
function msg_error2($text)
{
    return die('<script type="text/javascript">Swal.fire("Thất Bại", "'.$text.'", "error");</script>');
}
function msg_warning2($text)
{
    return die('<script type="text/javascript">Swal.fire("Cảnh Báo", "'.$text.'", "warning");</script>');
}
function msg_success($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("Thành Công", "'.$text.'", "success");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_error($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("Thất Bại", "'.$text.'", "error");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_warning($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("Cảnh Báo", "'.$text.'", "warning");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function stnapthe($data) {
    if ($data == 'xuly'){
        $show = '<span class="badge bg-warning rounded-lg">Chờ xử lý</span>';
    }
    else if ($data == 'thanhcong'){
        $show = '<span class="badge bg-success rounded-lg">Thành công</span>';
    }
    else if ($data == 'thatbai'){
        $show = '<span class="badge bg-danger rounded-lg">Thất bại</span>';
    }
    return $show;
}
function display($data) {
    if ($data == 1) {
        $show = '<span class="badge badge-success">HIỂN THỊ</span>';
    } else {
        $show = '<span class="badge badge-danger">ẨN</span>';
    }
    return $show;
}
function status_gift($data) {
    if ($data == 1) {
        $show = '<span class="badge badge-success">CHƯA DÙNG</span>';
    } else {
        $show = '<span class="badge badge-danger">ĐÃ DÙNG</span>';
    }
    return $show;
}

function display_banned($data) {
    if ($data == 'OFF') {
        $show = '<span class="badge badge-danger">Banned</span>';
    }
    else  {
        $show = '<span class="badge badge-success">Hoạt động</span>';
    }
    return $show;
}
function slug($str)
{
	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	$str = preg_replace("/(đ)/", 'd', $str);
	$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
	$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|E)/", 'e', $str);
	$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
	$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
	$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|U)/", 'u', $str);
	$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ|Y)/", 'y', $str);
	$str = preg_replace("/(Đ)/", 'd', $str);
	$str = preg_replace("/(Q)/", 'q', $str);
	$str = preg_replace("/(R)/", 'r', $str);
	$str = preg_replace("/(T)/", 't', $str);
	$str = preg_replace("/(Y)/", 'y', $str);
	$str = preg_replace("/(I)/", 'i', $str);
	$str = preg_replace("/(O)/", 'o', $str);
	$str = preg_replace("/(P)/", 'p', $str);
	$str = preg_replace("/(A)/", 'a', $str);
	$str = preg_replace("/(S)/", 's', $str);
	$str = preg_replace("/(D)/", 'd', $str);
	$str = preg_replace("/(F)/", 'f', $str);
	$str = preg_replace("/(G)/", 'g', $str);
	$str = preg_replace("/(H)/", 'h', $str);
	$str = preg_replace("/(J)/", 'j', $str);
	$str = preg_replace("/(K)/", 'k', $str);
	$str = preg_replace("/(L)/", 'l', $str);
	$str = preg_replace("/(Z)/", 'z', $str);
	$str = preg_replace("/(X)/", 'x', $str);
	$str = preg_replace("/(C)/", 'c', $str);
	$str = preg_replace("/(V)/", 'v', $str);
	$str = preg_replace("/(B)/", 'b', $str);
	$str = preg_replace("/(N)/", 'n', $str);
	$str = preg_replace("/(M)/", 'm', $str);
	$str = preg_replace("/(W)/", 'w', $str);
	$str = preg_replace("/(  )/", '', $str);
    // $str = preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($str));
	return str_replace(' ', '-', $str);
}

function getid($id) {
    global $TUANORI;
    return $TUANORI->getId($id);
}
function getUser($username) {
    global $TUANORI;
    return $TUANORI->getUser($username);
}
function XoaDauCach($text)
{
    return trim(preg_replace('/\s+/',' ', $text));
}
function numb($data) {
    return str_replace('.', '', $data);
}
function active($url) {
    return ($_SERVER['REQUEST_URI'] == $url) ? 'active': '';
}
function giamgia($money, $pt) {
    return $money - $money *$pt/100;
}
/*XỬ LÝ UPLOAD ẢNH*/
function upload_imgur($images) {
    $file     = file_get_contents($images);
    $dataPost = array(
        'image' => base64_encode($file)
    );
    $ch       = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POST, 1);
    $header[] = 'Authorization: Client-ID d5062e24816be2a';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function inkq($data, $str = '') {
    return ($data) ? $data: $str;
}
function check_username($data)
{
    if (preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function check_email($data)
{
    if (preg_match('/^.+@.+$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function check_phone($data)
{
    if(preg_match('/^[0-9]{10}+$/', $data)) {
        return True;
    } else {
        return False;
    }
}

function myip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))     
    {  
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];  
    }  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))    
    {  
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    else  
    {  
        $ip_address = $_SERVER['REMOTE_ADDR'];  
    }
    return $ip_address;
}

function timeAgo($time_ago)
{
    $time_ago   = date("Y-m-d H:i:s", $time_ago);
    $time_ago   = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60)
    {
        return "$seconds giây trước";
    }
    //Minutes
    else if($minutes <= 60)
    {
        return "$minutes phút trước";
    }
    //Hours
    else if($hours <= 24)
    {
        return "$hours tiếng trước";
    }
    //Days
    else if($days <= 7)
    {
        if($days == 1)
        {
            return "Hôm qua";
        }
        else
        {   
            return "$days ngày trước";
        }
    }
    //Weeks
    else if($weeks <= 4.3)
    {
        return "$weeks tuần trước";
    }
    //Months
    else if($months <=12)
    {
        return "$months tháng trước";
    }
    //Years
    else
    {
        return "$years năm trước";
    }
}
function randomtoken($length = 25) {
    $bytes = random_bytes($length);
    return bin2hex($bytes);
}
function randomtoken2($length = 15) {
    $bytes = random_bytes($length);
    return bin2hex($bytes);
}
$onethang = 2592000;
if(isset($_COOKIE['token']))
{
    $TUANORI->update("users", array(
        'timeon' => gettime(),
        'online' => 'ONLINE',
        'user_agent'    => $_SERVER['HTTP_USER_AGENT']
    ), "tokenlog = '".$_COOKIE['token']."' ");
}
/*
function logclient()
{
    global $TUANORI;
    if(!$TUANORI->get_row(" SELECT * FROM `logclient` WHERE `ip` = '".myip()."' AND `time` >= DATE(NOW()) AND `time` < DATE(NOW()) + INTERVAL 1 DAY"))
    {
            $TUANORI->insert("logclient", [
            'ip'    => myip(),
            'time'  => gettime()
        ]);
    }
}
logclient();
*/
$tenmien = $_SERVER['SERVER_NAME'];
$fr = explode('.', $tenmien);