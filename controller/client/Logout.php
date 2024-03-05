<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
// define("IN_SITE", true);
// require_once("../../core/config.php");
// require_once("../../core/function.php");
// setcookie("token", "", time() - 3600, "/");
// thực hiện xóa bỏ token log thì đăng xuất

// Thiết lập cookie
setcookie("token", "john_doe", time() + 3600, "/"); // Cookie "username" sẽ tồn tại trong 1 giờ

// Xóa cookie
setcookie("token", "", time() - 3600); // Đặt thời gian hết hạn của cookie "username" về quá kh

// Kiểm tra xem cookie có tồn tại hay không
if(isset($_COOKIE["username"])) {
    echo "Cookie 'username' tồn tại!";
} else {
    echo "Cookie 'username' không tồn tại!";
}
?>
