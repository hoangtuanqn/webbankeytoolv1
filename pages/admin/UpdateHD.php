<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'QUẢN LÝ GÓI | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>
<?php
/* BẢN QUYỀN THUỘC VỀ TUANORI.CO | NTTHANH LEADER NT TEAM */
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $TUANORI->get_row(" SELECT * FROM `categories_sp` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row) {
        msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['UpdateHD']) && $getUser['level'] == 'admin' ) {
    $TUANORI->update("categories_sp", array(
        'id_video'      => check_string($_POST['id_video']),
        'download'      => check_string($_POST['download']),
        'download2'     => check_string($_POST['download2'])
    ), " `id` = '".check_string($_GET['id'])."' ");
    msg_success("Cập nhật thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập nhật hướng dẫn: <b style="color: red"><?=$row['name'];?></b></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẬP NHẬT HƯỚNG DẪN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID VIDEO</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="id_video" value="<?=$row['id_video'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">LINK TẢI HACK</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="download" value="<?=$row['download'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">LINK TẢI HACK (DỰ PHÒNG)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="download2" value="<?=$row['download2'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="UpdateHD" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT</span></button>
                            <a type="button" href="<?=BASE_URL('Admin/Groups/'.$row['category']);?>"
                                class="btn btn-danger btn-block waves-effect">
                                <span>TRỞ LẠI</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CHI TIẾT DANH MỤC</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <img width="100%" src="<?=$row['img'];?>" />
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>




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