<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'DANH SÁCH KEY | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>

<?php
/* BẢN QUYỀN THUỘC VỀ CMSNT.CO | NTTHANH LEADER NT TEAM */
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $CMSNT->get_row(" SELECT * FROM `groups` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
}
else
{
    msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['ThemTaiKhoan']) && $getUser['level'] == 'admin' ) {
    // $rand = random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 6);
    // if(check_img('img') == true)
    // {
    //     $uploads_dir = '../../assets/storage/images';
    //     $tmp_name = $_FILES['img']['tmp_name'];
    //     $url_img = "/account_".$rand.".png";
    //     move_uploaded_file($tmp_name, $uploads_dir.$url_img);
    // }
   
    $listacc = explode(PHP_EOL, check_string($_POST['listacc']));

    foreach($listacc as $data)
    {
        $CMSNT->insert("accounts", array(
        'img'           => $_POST['img'],
        'chitiet'       => check_string($_POST['chitiet']),
        'listimg'       => $_POST['listimg'],
        'account'       => $data,
        'groups'        => check_string($_GET['id']),
        'money'         => check_string($_POST['money']),
        'createdate'    => gettime()
        ));
    }
    
    admin_msg_success("Thêm tài khoản thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách tài khoản <?=$row['title'];?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM TÀI KHOẢN MỚI</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="img" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">List tài khoản</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea rows="5" name="listacc"
                                            placeholder="Định dạng: Tài khoản | Mật khẩu (1 dòng 1 nick nếu cần nhập nhiều nick 1 lần)"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chi tiết</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea name="chitiet" rows="5" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">List hình ảnh</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea rows="5" name="listimg"
                                            placeholder="Mỗi ảnh 1 hàng"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá bán</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="money" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="ThemTaiKhoan" class="btn btn-primary btn-block">
                                <span>THÊM NGAY</span></button>
                            <a type="button" href="<?=BASE_URL('Admin/Groups/'.$row['id']);?>"
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
                        <h3 class="card-title">CHI TIẾT NHÓM</h3>
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
                        <h3 class="card-title">DANH SÁCH TÀI KHOẢN</h3>
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
                                        <th>ID</th>
                                        <th>ẢNH</th>
                                        <th>TÀI KHOẢN</th>
                                        <th>THỜI GIAN ĐĂNG</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `accounts` WHERE `groups` = '".check_string($_GET['id'])."'  ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td width="5%"><?=$i++;?></td>
                                        <td width="5%">#<?=$row['id'];?></td>
                                        <td width="8%"><img width="100%" src="<?=$row['img'];?>" /></td>
                                        <td><?=explode("|", $row['account'])[0];?></td>
                                        <td><?=$row['createdate'];?></td>
                                        <td><?php if($row['username'] != NULL) { echo 'Đã bán';} else { echo 'Đang bán';};?>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="<?=BASE_URL('Admin/Account/Edit/'.$row['id']);?>"><i
                                                    class="fas fa-edit"></i>
                                                <span>EDIT</span></a>
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