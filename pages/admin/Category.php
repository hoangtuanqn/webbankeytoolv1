<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'QUẢN LÝ CHUYÊN MỤC | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>

<?php
if(isset($_POST['ThemChuyenMuc']) && $getUser['level'] == 'admin' ) {
    $TUANORI->insert("category", array(
        'img'       => check_string($_POST['img']),
        'name'      => check_string($_POST['name']),
        'mota'      => check_string($_POST['mota']),
        'seo_key'   => check_string($_POST['seo_key']),
        'status'    => check_string($_POST['status']),
        'slug'      => slug(check_string($_POST['name']))
    ));
    msg_success("Thêm thành công", '', 500);
}
if(isset($_GET['xoa']) && $getUser['level'] == 'admin')
{
    $user2 = $TUANORI->get_row(" SELECT * FROM `category` WHERE `id` = '".$_GET['xoa']."'");
    if(!$user2) {
        msg_error("Danh mục này không tồn tại", BASE_URL('Admin/Category'), 2000);
    } else {
        $dele = $TUANORI->remove("category", " `id` = '".$_GET['xoa']."' ");
        if($dele) {
            msg_success("Đã xóa danh mục thành công", BASE_URL('Admin/Category'), 2000);
        } else {
            msg_error("Xóa thất bại. Lỗi hệ thống", BASE_URL('Admin/Category'), 2000);
        }
    }
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chuyên mục</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM CHUYÊN MỤC</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên chuyên mục</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea type="text" name="mota" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Từ khóa</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea type="text" name="seo_key" class="form-control" placeholder="Dùng cho việc tìm kiếm nhanh danh mục. VD: hack pupg, hack ios,.." required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="url" name="img" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hiển thị</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="1">SHOW</option>
                                        <option value="0">HIDE</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="ThemChuyenMuc" class="btn btn-primary btn-block">
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
                                        <th>ẢNH</th>
                                        <th>TÊN CHUYÊN MỤC</th>
                                        <th>HIỂN THỊ</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `category` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td width="10%"><img width="100%" src="<?=$row['img'];?>" /></td>
                                        <td><?=$row['name'];?></td>
                                        <td><?=display($row['status']);?></td>
                                        <td>
                                            <a type="button" href="<?=BASE_URL('Admin/Category/Edit/');?><?=$row['id'];?>"
                                                class="btn btn-primary"><i class="fas fa-edit"></i>
                                                <span>Edit</span></a>
                                            <a type="button" href="<?=BASE_URL('Admin/Groups/');?><?=$row['id'];?>"
                                                class="btn btn-info"><i class="fas fa-file-medical"></i>
                                                <span>XEM NHÓM</span></a>
                                            <a type="button" href="<?=BASE_URL('Admin/Category?xoa='.$row['id']);?>"
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


<script type="text/javascript">
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