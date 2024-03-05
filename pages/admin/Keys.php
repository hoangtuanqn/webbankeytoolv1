<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'THÊM KEY | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>
<?php
// if(isset($_GET['xoa']) && $getUser['level'] == 'admin') {
//     $user2 = $TUANORI->get_row(" SELECT * FROM `category_goi` WHERE `id` = '".$_GET['xoa']."'");
//     if(!$user2) {
//         msg_error("Gói hàng này không tồn tại", BASE_URL('Admin/Gois/'.$_GET['id']), 1000);
//     } else {
//         $dele = $TUANORI->remove("category_goi", " `id` = '".$_GET['xoa']."' ");
//         if($dele) {
//             msg_success("Đã xóa gói thành công", BASE_URL('Admin/Gois/'.$_GET['id']), 1000);
//         } else {
//             msg_error("Xóa thất bại. Lỗi hệ thống", BASE_URL('Admin/Gois/'.$_GET['id']), 1000);
//         }
//     }
// }
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $TUANORI->get_row(" SELECT * FROM `category_goi` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row) {
        msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['ThemKey']) && $getUser['level'] == 'admin' ) {
    $s = 0;
    foreach(explode("\n", $_POST['keys']) as $ok) {
        $TUANORI->insert("list_key", array(
            'category_goi'      => $row['id'],
            'token'             => check_string($ok),
            'status'            => 1
        ));
        ++$s;
    }
    msg_success("Đã thêm $s key thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>THÊM KEY</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM KEY BÁN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gói</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" class="form-control" value="<?=number_format($row['money']);?>đ / <?=number_format($row['time']);?> giờ" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Danh sách key</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea type="text" name="keys" rows="6" class="form-control" placeholder="Có thể thêm nhiều key, mỗi key 1 hàng." required></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="ThemKey" class="btn btn-primary btn-block">
                                <span>THÊM NGAY</span></button>
                            <a type="button" href="<?=BASE_URL('Admin/Gois/'.$row['id']);?>"
                                class="btn btn-danger btn-block waves-effect">
                                <span>TRỞ LẠI</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
         

            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH KEY</h3>
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
                                        <th>SỐ TIỀN</th>
                                        <th>SỐ GIỜ</th>
                                        <th>GÓI</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `category_goi` WHERE `categories_sp` = '".check_string($_GET['id'])."' ORDER BY time DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td><b style="color: green"><?=number_format($row['money']);?>đ</b></td>
                                        <td><b style="color: red"><?=number_format($row['time']);?> giờ</b></td>
                                        <td><b style="color: blue"><?=number_format($row['money']);?>đ / <?=number_format($row['time']);?> giờ</b></td>
                                        
                                        <td><?=display($row['status']);?></td>
                                        <td>
                                            <a type="button" href="<?=BASE_URL('Admin/EditGois/');?><?=$row['id'];?>"
                                                class="btn btn-primary"><i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </a>
                                          
                                            <a type="button" href="<?=BASE_URL('Admin/Gois/'.$_GET['id'].'/'.$row['id']);?>"
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