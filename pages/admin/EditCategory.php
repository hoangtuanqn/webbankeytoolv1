<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHỈNH SỬA DANH MỤC | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>
<?php
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $TUANORI->get_row(" SELECT * FROM `category` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row) {
        msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['LuuChuyenMuc']) && $getUser['level'] == 'admin' ) {
    $TUANORI->update("category", array(
        'img'       => check_string($_POST['img']),
        'name'      => check_string($_POST['name']),
        'mota'      => check_string($_POST['mota']),
        'seo_key'   => check_string($_POST['seo_key']),
        'status'    => check_string($_POST['status']),
        'slug'      => slug(check_string($_POST['name']))
    ), " `id` = '".$_GET['id']."' ");
    msg_success("Đã cập nhật thành công", '', 500);
}

?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CẬP NHẬT DANH MỤC <b style="color: red; text-uppercase"><?=$row['name'];?></b></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN CẬP NHẬT DANH MỤC </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên chuyên mục</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name" value="<?=$row['name'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea type="text" name="mota" class="form-control" required><?=$row['mota'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Từ khóa</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea type="text" name="seo_key" class="form-control" placeholder="Dùng cho việc tìm kiếm nhanh danh mục. VD: hack pupg, hack ios,.." required><?=$row['seo_key'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="url" name="img" value="<?=$row['img'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hiển thị</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="1" <?=($row['status'] == 1) ? 'selected': '';?>>SHOW</option>
                                        <option value="0" <?=($row['status'] == 0) ? 'selected': '';?>>HIDE</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="LuuChuyenMuc" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT NGAY</span></button>
                            <a type="button" href="<?=BASE_URL('Admin/Category');?>"
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







<?php 
    require_once(__DIR__."/Footer.php");
?>