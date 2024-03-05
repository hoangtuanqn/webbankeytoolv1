<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'DASHBROAD | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>
<div class="content-wrapper">
 
    
        <div id="thongbao"></div>
        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="total_users"><?=$TUANORI->num_rows("SELECT * FROM `users` ");?></h3>
                        <p>Tổng thành viên</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="total_money">
                            <?=format_cash($TUANORI->get_row("SELECT SUM(`money`) FROM `users` WHERE `money` > 0 ")['SUM(`money`)']);?>đ
                        </h3>
                        <p>Tổng số dư thành viên</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="the_hop_le">
                            <?=format_cash($TUANORI->num_rows("SELECT * FROM `ls_mua` "));?>
                        </h3>
                        <p>Tổng key đã bán</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-store"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id="tong_tien_the">
                            <?=format_cash($TUANORI->get_row("SELECT SUM(`sotien`) FROM `ls_mua` ")['SUM(`sotien`)']);?>đ
                        </h3>
                        <p>Tổng tiền bán</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="doanh_thu_today">
                            <?=format_cash($TUANORI->get_row("SELECT SUM(`sotien`) FROM `napatm` WHERE `thoigian` >= DATE(NOW()) AND `thoigian` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`sotien`)'] + 
                            $TUANORI->get_row("SELECT SUM(`thucnhan`) FROM `napcard` WHERE `status` = 'thanhcong' AND `thoigian` >= DATE(NOW()) AND `thoigian` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`thucnhan`)']
                            );?>đ
                        </h3>
                        <p>DOANH THU HÔM NAY</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>
                            <?=format_cash($TUANORI->get_row("SELECT SUM(`sotien`) FROM `napatm` WHERE YEAR(thoigian) = ".date('Y')." AND MONTH(thoigian) = ".date('m')." ")['SUM(`sotien`)'] + 
                            $TUANORI->get_row("SELECT SUM(`thucnhan`) FROM `napcard` WHERE `status` = 'thanhcong' AND YEAR(thoigian) = ".date('Y')." AND MONTH(thoigian) = ".date('m')." ")['SUM(`thucnhan`)']
                        );?>đ
                        </h3>
                        <p>DOANH THU THÁNG NÀY</p>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-3 col-12">
        
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="total_web_api">
                       
                        </h3>
                        <p>WEBSITE ĐANG ĐẤU API</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
             
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id="loi_nhuan_today">
                        </h3>
                        <p>LỢI NHUẬN HÔM NAY</p>
                    </div>
                </div>
            </div> -->


            <!-- <script type="text/javascript">
            function GetUsageServer() {
                $.ajax({
                    url: "<?=BASE_URL('assets/ajaxs/realtime_dashboard.php');?>",
                    method: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#total_money').text(data.total_money);
                        $('#total_users').text(data.total_users);
                        $('#the_hop_le').text(data.the_hop_le);
                        $('#tong_tien_the').text(data.tong_tien_the);
                        $('#doanh_thu_today').text(data.doanh_thu_today);
                        $('#san_luong_today').text(data.san_luong_today);
                        $('#total_web_api').text(data.total_web_api);
                        $('#loi_nhuan_today').text(data.loi_nhuan_today);

                    }
                });

            }
            setInterval(function() {
                $('#thongbao').load(GetUsageServer());
            }, 2000);
            </script> -->
            <section class="col-lg-12 connectedSortable">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            LỊCH SỬ GẦN NHẤT
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>USERNAME</th>
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
                                        <td><?=++$i;?></td>
                                        <td><a
                                                href="<?=BASE_URL('Admin/User/Edit/'.getUser($row['username'])['id'] );?>"><?=$row['username'];?></a>
                                        </td>
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
                                        <th>STT</th>
                                        <th>USERNAME</th>
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
            </section>
            <section class="col-lg-12 connectedSortable">
                <section class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            KEY ĐÃ MUA GẦN ĐÂY
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Loại</th>
                                        <th>Token</th>
                                        <th>Số tiền</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `ls_mua` ORDER BY id DESC LIMIT 50 ") as $row){ ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td><a
                                                href="<?=BASE_URL('Admin/User/Edit/'.getUser($row['username'])['id'] );?>"><?=$row['username'];?></a>
                                        </td>
                                        <td><?=$TUANORI->get_row(" SELECT * FROM `categories_sp` WHERE `id` = '".$row['categories_sp']."' ")['name'];?></td>
                                        <td><a style="font-weight: bold"><?=$row['token'];?></a></td>
                                        <td class="text-center;" style="color: green; font-weight: bold"><?=number_format($row['sotien']);?>đ</td>
                                        <td><?=gettime2(strtotime($row['thoigian']));?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
        </div>

</div>
</section>
<!-- /.content -->
</div>



<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": false,
        "autoWidth": false,
    });
    $("#datatable1").DataTable({
        "responsive": false,
        "autoWidth": false,
    });
});
</script>

<?php 
    require_once("../../pages/admin/Footer.php");
?>