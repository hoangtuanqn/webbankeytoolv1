<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'QUẢN LÝ NHÓM | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>
<?php
/* BẢN QUYỀN THUỘC VỀ TUANORI.CO | NTTHANH LEADER NT TEAM */
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $TUANORI->get_row(" SELECT * FROM `category` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row) {
        msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['ThemChuyenMuc']) && $getUser['level'] == 'admin' ) {
    $TUANORI->insert("categories_sp", array(
        'category'  => $_GET['id'],
        'name'      => check_string($_POST['name']),
        'mota'      => check_string($_POST['mota']),
        'img'       => check_string($_POST['img']),
        'status'    => check_string($_POST['status'])
    ));
    msg_success("Thêm thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nhóm chuyên mục <?=$row['name'];?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM NHÓM MỚI</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên nhóm</label>
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
                                <label class="col-sm-3 col-form-label">Ảnh nhóm</label>
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

            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH NHÓM</h3>
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
                                        <th>TÊN NHÓM</th>
                                        <th>HIỂN THỊ</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `categories_sp` WHERE `category` = '".check_string($_GET['id'])."' ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td width="10%"><img width="100%" src="<?=$row['img'];?>" /></td>
                                        <td><?=$row['name'];?></td>
                                    
                                        <td><?=display($row['status']);?></td>
                                        <td>
                                            <a type="button" href="<?=BASE_URL('Admin/Group/Edit/');?><?=$row['id'];?>"
                                                class="btn btn-primary"><i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a type="button" href="<?=BASE_URL('Admin/UpdateHD/');?><?=$row['id'];?>"
                                                class="btn btn-info"><i class="fa-solid fa-cloud-arrow-up"></i>
                                                <span>Hướng dẫn</span>
                                            </a>
                                            <a type="button" href="<?=BASE_URL('Admin/Gois/');?><?=$row['id'];?>"
                                                class="btn btn-info"><i class="fa-solid fa-cart-shopping"></i>
                                                <span>GÓI BÁN</span></a>
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