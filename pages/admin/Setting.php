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
                                <label class="col-sm-3 col-form-label">Tên website</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="title" value="<?=$TUANORI->site('title');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả website</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="mota" value="<?=$TUANORI->site('mota');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Từ khóa tìm kiếm</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="tukhoa" value="<?=$TUANORI->site('tukhoa');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Logo website</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="logo" value="<?=$TUANORI->site('logo');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Favicon website</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="favicon" value="<?=$TUANORI->site('favicon');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh giới thiệu website</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="anhbia" value="<?=$TUANORI->site('anhbia');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Link Facebook</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="fbadmin" value="<?=$TUANORI->site('fbadmin');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Link Youtube</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="ytbadmin" value="<?=$TUANORI->site('ytbadmin');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email nhận thông báo</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="email_admin" value="<?=$TUANORI->site('email_admin');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Config Gmail</label>
                                <div class="col-sm-9">
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" placeholder="Nhập Email"
                                                        name="email" value="<?=$TUANORI->site('email');?>"
                                                        placeholder="col-sm-6" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" class="form-control"
                                                        placeholder="Nhập mật khẩu Email" name="pass_email"
                                                        value="<?=$TUANORI->site('pass_email');?>"
                                                        placeholder="col-sm-6" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông báo</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="thongbao"
                                            rows="6"><?=$TUANORI->site('thongbao');?></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">JavaSciprt</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="script_live_chat"
                                            rows="6"><?=$TUANORI->site('script_live_chat');?></textarea>
                                    </div>
                                    <i>Chứa sciprt Live Chat, Google Analytics hoặc các sciprt khác.</i>
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