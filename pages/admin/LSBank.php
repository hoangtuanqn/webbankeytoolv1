<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'LỊCH SỬ NẠP BANK | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>
<?php

if(isset($_POST['btnTimKiem']))
{
    $daterangepicker = check_string($_POST['daterangepicker']);
    $daterangepicker = explode(' - ', $daterangepicker);
    $total_menhgia = $TUANORI->get_row(" SELECT SUM(`sotien`) FROM `napatm` WHERE `hinhthuc` != 'MOMO' AND `thoigian` >= '".$daterangepicker[0]."' AND `thoigian` <= '".$daterangepicker[1]."' ORDER BY id DESC ")['SUM(`sotien`)'];
    $list_bank = $TUANORI->get_list(" SELECT * FROM `napatm` WHERE `thoigian` >= '".$daterangepicker[0]."' AND `thoigian` <= '".$daterangepicker[1]."' ORDER BY id DESC LIMIT 100 ");
}  
else
{
    $total_menhgia = $TUANORI->get_row(" SELECT SUM(`sotien`) FROM `napatm` WHERE `hinhthuc` != 'MOMO' ORDER BY id DESC ")['SUM(`sotien`)'];
    $list_bank = $TUANORI->get_list(" SELECT * FROM `napatm` ORDER BY id DESC LIMIT 100 ");
}
// if(isset($_GET['huy']) && $getUser['level'] == 'admin')
// {
//     $id = check_string($_GET['huy']);
//     $row = $TUANORI->get_row("SELECT * FROM `napatm` WHERE `id` = '$id' ");
//     $getUser = $TUANORI->get_row("SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");
//     if(!$row)
//     {
//         msg_error("Thẻ này không tồn tại trong hệ thống", BASE_URL('Admin/Cards'), 2000);
//     }
//     if($row['status'] == 'thanhcong') {
//         msg_error("Thẻ này đã được duyệt rồi", BASE_URL('Admin/Cards'), 2000);
//     }
//     $TUANORI->update("napatm", [
//         'status' => 'thatbai',
//         'uptime'    => gettime()
//     ], " `id` = '$id' ");

//     msg_success("Hủy thành công!", BASE_URL('Admin/Cards'), 500);
// }

// if(isset($_GET['duyet']) && $getUser['level'] == 'admin')
// {
//     $id = check_string($_GET['duyet']);
//     $row = $TUANORI->get_row("SELECT * FROM `napatm` WHERE `id` = '$id' ");
//     $getUser = $TUANORI->get_row("SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");

//     if(!$row){
//         msg_error("Thẻ này không tồn tại trong hệ thống", BASE_URL('Admin/Cards'), 2000);
//     }
//     if($row['status'] == 'thanhcong') {
//         msg_error("Thẻ này đã được duyệt rồi", BASE_URL('Admin/Cards'), 2000);
//     }

//     $TUANORI->update("napatm", [
//         'status' => 'thanhcong',
//         'uptime'    => gettime()
//     ], " `id` = '$id' ");

//     $TUANORI->cong("users", "money", $row['thucnhan'], " `username` = '".$row['username']."' ");
//     $TUANORI->cong("users", "total_money", $row['thucnhan'], " `username` = '".$row['username']."' ");
//     /* CẬP NHẬT DÒNG TIỀN */
//     $TUANORI->insert("biendongsodu", array(
//         'truoc'         => $getUser['money'],
//         'tongtien'      => $row['thucnhan'],
//         'sau'           => $getUser['money'] + $row['thucnhan'],
//         'time'          => gettime(),
//         'note'          => 'Nạp thẻ '.number_format($row['menhgia']).'đ có seri ('.$row['seri'].')',
//         'username'      => $getUser['username']
//     ));
//     msg_success("Đã duyệt thành công!", BASE_URL('Admin/Cards'), 500);
// }
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý NẠP ATM</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH NẠP ATM</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="daterangepicker" class="form-control float-right"
                                                id="reservationtime">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <button type="submit" name="btnTimKiem" class="btn btn-primary">
                                        <span>TÌM KIẾM</span></button>
                                </div>
                            </div>
                        </form>
                        <ul>
                            <li>Số tiền nạp: <b style="color: blue;"><?=format_cash($total_menhgia);?>đ</b></li>
                        </ul>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>USERNAME</th>
                                        <th>NGÂN HÀNG</th>
                                        <th>MÃ GD</th>
                                        <th>SỐ TIỀN</th>
                                        <th>THỜI GIAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; foreach($list_bank as $row){ ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td><a
                                                href="<?=BASE_URL('Admin/User/Edit/'.getuser($row['username']));?>"><?=$row['username'];?></a>
                                        </td>
                                        <td style="color: red; font-weight: bold"><?=$row['hinhthuc'];?></td>
                                        <td><?=$row['magd'];?></td>
                                        <td><b style="color: green;">+ <?=number_format($row['sotien']);?>đ</b></td>
                                        <td><span class="badge badge-dark"><?=$row['thoigian'];?></span></td>
                          
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
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'YYYY/MM/DD/ hh:mm:ss'
        }
    })
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>
<?php 
    require_once("../../pages/admin/Footer.php");
?>