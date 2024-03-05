<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHỈNH SỬA GÓI BÁN | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>
<?php
if(isset($_GET['id']) && $getUser['level'] == 'admin') {
    $row = $TUANORI->get_row(" SELECT * FROM `category_goi` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row) {
        msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['UpdateGoi']) && $getUser['level'] == 'admin' ) {
    $TUANORI->update("category_goi", array(
        'time'          => check_string($_POST['time']),
        'money'         => check_string(numb($_POST['money'])),
        'status'        => check_string($_POST['status'])
    ), " `id` = '".$_GET['id']."' ");
    msg_success("Cập nhật thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>EDIT CÁC GÓI BÁN</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẬP NHẬT GÓI BÁN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số tiền</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="money" value="<?=format_cash($row['money']);?>" class="form-control fnum" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số giờ bán</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="time" value="<?=$row['time'];?>" class="form-control" required>
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
                            <button type="submit" name="UpdateGoi" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT NGAY</span></button>
                            <a type="button" href="<?=BASE_URL('Admin/Gois/'.$row['categories_sp']);?>"
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
                        <h3 class="card-title">DANH SÁCH CÁC GÓI</h3>
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
                                    foreach($TUANORI->get_list(" SELECT * FROM `category_goi` WHERE `categories_sp` = '".check_string($row['categories_sp'])."' ORDER BY time DESC ") as $row){
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
                                          
                                            <a type="button" href="<?=BASE_URL('Admin/Gois/'.$row['categories_sp'].'/'.$row['id']);?>"
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