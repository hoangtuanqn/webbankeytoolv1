<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHỈNH SỬA THÀNH VIÊN | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>
<?php
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $TUANORI->get_row(" SELECT * FROM `users` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        msg_error("Người dùng này không tồn tại", BASE_URL(''), 500);
    }
}
else
{
    msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['btnCongTien']) && isset($_POST['value']) && isset($row['username']) && $getUser['level'] == 'admin')
{
    $value = check_string(numb($_POST['value']));
    $ghichu = check_string($_POST['ghichu']);
    if($value <= 0)
    {
        msg_error("Vui lòng nhập số tiền hợp lệ", "", 2000);
    }
    $create = $TUANORI->insert("biendongsodu", [
        'truoc'         => $row['money'],
        'tongtien'      => $value,
        'sau'           => $row['money'] + $value,
        'time'          => gettime(),
        'noidung'       => 'Admin cộng tiền ('.$ghichu.')',
        'username'      => $row['username']
    ]);
    if($create)
    {
        $TUANORI->cong("users", "money", $value, " `username` = '".$row['username']."' ");
        msg_success("Cộng tiền thành công!", "", 2000);
    }
    else
    {
        msg_error("Vui lòng liên hệ kỹ thuật Zalo 0812665001", "", 12000);
    }
    
}

if(isset($_POST['btnTruTien']) && isset($_POST['value']) && isset($row['username']) && $getUser['level'] == 'admin')
{
    $value = check_string(numb($_POST['value']));
    $ghichu = check_string($_POST['ghichu']);
    if($value <= 0) {
        msg_error("Vui lòng nhập số tiền hợp lệ", "", 2000);
    }
    $create = $TUANORI->insert("dongtien", [
        'truoc'         => $row['money'],
        'tongtien'      => $value,
        'sau'           => $row['money'] - $value,
        'time'          => gettime(),
        'noidung'       => 'Admin trừ tiền ('.$ghichu.')',
        'username'      => $row['username']
    ]);
    if($create) {
        $TUANORI->tru("users", "money", $value, " `username` = '".$row['username']."' ");
        msg_success("Trừ tiền thành công!", "", 2000);
    } else {
        msg_error("Vui lòng liên hệ kỹ thuật Zalo 0812665001", "", 12000);
    }
    
}
if(isset($_POST['btnSaveUser']) && isset($_GET['id']) && $getUser['level'] == 'admin') {
    $money = check_string(numb($_POST['money']));
    $level = check_string($_POST['level']);
    $banned = check_string($_POST['banned']);
    $email = check_string($_POST['email']);
    $total = check_string(numb($_POST['total_money']));
    $reason_banned = check_string($_POST['reason_banned']);
    $discount = check_string($_POST['discount']);
    if($discount < 0) {
        msg_error("Chiết khấu giảm giá không hợp lệ", "", 1000);
    }
    if($money < 0) {
        msg_error("Số tiền không hợp lệ", "", 1000);
    }
    if($total < 0) {
        msg_error("Tổng nạp không hợp lệ", "", 1000);
    }
    if($row['money'] != $money)  {
        $TUANORI->insert("biendongsodu", array(
            'truoc'         => $row['money'],
            'sau'           => $money,
            'tongtien'      => abs($money - $row['money']),
            'note'          => 'Admin thay đổi số dư ',
            'time'          => gettime(),
            'username'      => $row['username']
        ));
    }
    $TUANORI->update("users", array(
        'reason_banned' => $reason_banned,
        'email'         => $email,
        'money'         => $money,
        'total_money'   => $total,
        'level'         => $level,
        'banned'        => $banned,
        'discount'      => $discount
    ), " `id` = '".$row['id']."' ");
    msg_success("Thay đổi user thành công", "", 1000);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa thành viên</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CHỈNH SỬA THÀNH VIÊN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputEmail3"
                                            value="<?=$row['username'];?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="password"
                                            value="<?=$row['password'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="email"
                                            value="<?=$row['email'];?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="inputEmail3" value="<?=$row['username'];?>"
                                name="username" required>
                           
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Số dư</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control fnum" id="inputPassword3" name="money"
                                            value="<?=format_cash($row['money']);?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Tổng Nạp</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control fnum" id="inputPassword3" name="total_money"
                                            value="<?=format_cash($row['total_money']);?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">CK Giảm giá</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputPassword3" name="discount"
                                            value="<?=$row['discount'];?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Cấp độ</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="level" value="<?=$row['level'];?>"
                                            placeholder="Nếu muốn đưa lên Admin thì ghi: admin">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Trạng thái</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" name="banned">
                                        <option value="ON" <?=$row['banned'] == 'ON' ? 'selected' : ''?>>Hoạt động</option>
                                        <option value="OFF" <?=$row['banned'] == 'OFF' ? 'selected' : ''?>>Banned</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Lý do banned</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <textarea class="form-control" name="reason_banned" ><?=$row['reason_banned'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày đăng ký</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputEmail3"
                                            value="<?=$row['timereg'];?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày on gần đây</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputEmail3"
                                            value="<?=$row['timeon'];?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveUser" class="btn btn-primary btn-block waves-effect">
                                <span>LƯU</span>
                            </button>
                            <a type="button" href="<?=BASE_URL('Admin/Users');?>"
                                class="btn btn-danger btn-block waves-effect">
                                <span>TRỞ LẠI</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">CỘNG TIỀN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Số tiền cộng</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <input type="text" class="form-control fnum" name="value" value="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Ghi chú</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <textarea class="form-control" name="ghichu" rows="3"
                                            placeholder="Nhập ghi chú cộng tiền nếu có"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnCongTien" class="btn btn-primary btn-block waves-effect">
                                <span>XÁC NHẬN</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">TRỪ TIỀN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Số tiền trừ</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <input type="text" class="form-control fnum" name="value" value="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Ghi chú</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <textarea class="form-control" name="ghichu" rows="3"
                                            placeholder="Nhập ghi chú trừ tiền nếu có"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnTruTien" class="btn btn-primary btn-block waves-effect">
                                <span>XÁC NHẬN</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DÒNG TIỀN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>SỐ TIỀN TRƯỚC</th>
                                        <th>SỐ TIỀN THAY ĐỔI</th>
                                        <th>SỐ TIỀN HIỆN TẠI</th>
                                        <th>THỜI GIAN</th>
                                        <th>NỘI DUNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `biendongsodu` ORDER BY id DESC LIMIT 50 ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=format_cash($row['truoc']);?>đ</td>
                                        <td>
                                            <?php if($row['sau'] > $row['truoc']) { 
                                                echo '<b style="color: green">+ '.format_cash($row['tongtien']).'đ</b>';
                                            } else {
                                                echo '<b style="color: red">- '.format_cash($row['tongtien']).'đ</b>';
                                            }
                                            ?>
                                        </td>
                                        <td><?=format_cash($row['sau']);?>đ</td>
                                        <td><span class="badge badge-dark"><?=$row['time'];?></span></td>
                                        <td><?=$row['note'];?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>SỐ TIỀN TRƯỚC</th>
                                        <th>SỐ TIỀN THAY ĐỔI</th>
                                        <th>SỐ TIỀN HIỆN TẠI</th>
                                        <th>THỜI GIAN</th>
                                        <th>NỘI DUNG</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>






<?php 
    require_once("../../pages/admin/Footer.php");
?>