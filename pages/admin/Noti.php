<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CẤU HÌNH | '.$TUANORI->site('title');
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
                    <h1>Cấu hình</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH THÔNG TIN WEBSITE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status nhận thông báo</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="custom-select" name="status_tele">
                                            <option value="ON" <?=($TUANORI->site('status_tele') == 'ON') ? 'selected' : ''?>>Hoạt động</option>
                                            <option value="OFF" <?=($TUANORI->site('status_tele') == 'OFF') ? 'selected' : ''?>>Tắt</option>
                                        </select>
                                        <i>Nhận thông báo qua telegream</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID TELEGRAM</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="id_tele" value="<?=$TUANORI->site('id_tele');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TOKEN BOT TELE</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="key_tele" value="<?=$TUANORI->site('key_tele');?>"
                                            class="form-control">
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
    </section>
</div>

<script>
$(function() {
    // Summernote
    $('.textarea').summernote()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });
})
</script>

<?php 
    require_once("../../pages/admin/Footer.php");
?>