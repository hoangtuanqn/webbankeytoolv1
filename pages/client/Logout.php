<?php
define("IN_SITE", true);
require_once("../../core/config.php");
require_once("../../core/function.php");
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
// thực hiện xóa bỏ token log thì đăng xuất
setcookie("token", "", time() - 3600, "/");
echo 'done';