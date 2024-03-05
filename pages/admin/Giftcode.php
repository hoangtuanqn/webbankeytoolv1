<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'GIFTCODE | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>

<?php
if(isset($_POST['ThemGift']) && $getUser['level'] == 'admin' ) {
    $sotien = check_string(numb($_POST['amount']));
    if($sotien < 0) {
        msg_error("Số tiền không hợp lệ", '', 500);
    }
    $TUANORI->insert("giftcode", array(
        'gift'      => check_string($_POST['giftcode']),
        'amount'    => $sotien,
        'status'    => 1
    ));
    msg_success("Thêm thành công", '', 500);
}
if(isset($_GET['xoa']) && $getUser['level'] == 'admin')
{
    $user2 = $TUANORI->get_row(" SELECT * FROM `giftcode` WHERE `id` = '".$_GET['xoa']."'");
    if(!$user2) {
        msg_error("Giftcode này không tồn tại", BASE_URL('Admin/Giftcode'), 1000);
    } else {
        $dele = $TUANORI->remove("giftcode", " `id` = '".$_GET['xoa']."' ");
        if($dele) {
            msg_success("Đã xóa giftcode thành công", BASE_URL('Admin/Giftcode'), 1000);
        } else {
            msg_error("Xóa thất bại. Lỗi hệ thống", BASE_URL('Admin/Giftcode'), 1000);
        }
    }
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Giftcode</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM GIFTCODE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mã Giftcode</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="giftcode" id="giftcode" class="form-control" placeholder="Nhập mã gift code" required>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" onclick="randomCode()" class="btn btn-danger">Tạo mã ngẫu nhiên</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số tiền</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="amount" class="form-control fnum" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="ThemGift" class="btn btn-primary btn-block">
                                <span>THÊM NGAY</span></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH CHUYÊN MỤC</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>MÃ GIFT</th>
                                        <th>SỐ TIỀN</th>
                                        <th>TÌNH TRẠNG</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `giftcode` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td style="color: black; font-weight: bold"><?=$row['gift'];?></td>
                                        <td><b style="color: green"><?=number_format($row['amount']);?>đ</b></td>
                                        <td><?=status_gift($row['status']);?></td>
                                        <td>
                                            <a type="button" href="<?=BASE_URL('Admin/Giftcode?xoa='.$row['id']);?>"
                                                class="btn btn-danger"><i class="fas fa-trash"></i>
                                                <span> Xóa</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script>
function random(length) {
    var result = '';
    var characters = 'QWERTYUPASDFGHJKZXCVBNM123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() *
            charactersLength));
    }
    return 'AG-' + result;
}
function randomCode(){
    document.getElementById('giftcode').value = random(8);
}
$('.btnEdit').on('click', function(e) {
    var btn = $(this);
    $("#title").val(btn.attr("data-title"));
    $("#display").val(btn.attr("data-display"));
    $("#id").val(btn.attr("data-id"));
    $("#img").val(btn.attr("data-img"));
    $("#staticBackdrop").modal();
    return false;
});
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable2").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once(__DIR__."/Footer.php");
?>