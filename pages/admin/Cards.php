<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CẤU HÌNH NẠP THẺ | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>
<?php

if(isset($_POST['btnSaveOption']) && $getUser['level'] == 'admin') {
    foreach ($_POST as $key => $value)
    {
        $TUANORI->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
    msg_success('Lưu thành công', '', 500);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cấu hình nạp thẻ</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH NẠP CARD</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Nạp tiền CARD</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status_card" required>
                                        <option value="ON" <?=($TUANORI->site('status_card') == 'ON') ? 'selected': '';?>>ON</option>
                                        <option value="OFF" <?=($TUANORI->site('status_card') == 'OFF') ? 'selected': '';?>>OFF</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">PARTNER ID</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="partner_id" value="<?=$TUANORI->site('partner_id');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">PARTNER KEY</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="partner_key" value="<?=$TUANORI->site('partner_key');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CK CARD (%)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="ckcard" value="<?=$TUANORI->site('ckcard');?>"
                                            class="form-control">
                                        <i>VD khách nạp <b style="color: green">100.000đ</b> sẽ nhận được <b style="color: green"><?=format_cash(100000*(100-$TUANORI->site('ckcard'))/100)?>đ</b></i>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
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