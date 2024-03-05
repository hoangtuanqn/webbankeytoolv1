<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Đăng Nhập Thành Viên";
    require_once("../../pages/client/Head.php");
?>
<!--  -->
<div class="register-login">
    <div class="logo-auth">
        <a href="/"><img src="<?=$TUANORI->site('logo');?>" alt="ĐĂNG KÝ THÀNH VIÊN"></a>
    </div>
    <div class="d-flex h-100">
        <div class="right-form">
            <div class="carousel slide carousel-fade h-100" data-bs-ride="carousel">
                <div class="carousel-inner h-100">
                    <div class="carousel-item active h-100" data-interval="200">
                        <img src="https://i.imgur.com/HdzIrHv.jpg" width="1280" class="d-block w-100 h-100" alt="">
                    </div>
                    <div class="carousel-item  h-100" data-interval="200">
                        <img src="https://i.imgur.com/sb0PGXr.jpg" width="1280" class="d-block w-100 h-100" alt="">
                    </div>
                    <div class="carousel-item  h-100" data-interval="200">
                        <img src="https://i.imgur.com/027p0TZ.jpg" width="1280" class="d-block w-100 h-100" alt="">
                    </div>
                    <div class="carousel-item  h-100" data-interval="200">
                        <img src="https://i.imgur.com/KqdRJDw.jpg" width="1280" class="d-block w-100 h-100" alt="">
                    </div>

                </div>
            </div>
            <div class="black-background">

            </div>
        </div>
        <div class="left-form">
            <h5 class="text-uppercase">Đăng nhập hệ thống</h5>
            <form id="login">
                <div class="row" id="form-register-login">

                    <div class="col-12 input-forms mt-3">
                        <label for="">Tài khoản</label>
                        <input name="username" id="username" class="input-nice" data-label='label-username' type="text" placeholder="Từ 6 - 24 ký tự." autocomplete="off">
                    </div>
                    <div class="col-12 input-forms mt-3">
                        <label for="">Mật khẩu</label>
                        <input name="password" id="password" class="input-nice" data-label='label-username' type="password" placeholder="********" autocomplete="off">
                    </div>
                    <div class="col-12 mt-3">
                        <small>Bạn quên mật khẩu? <a href="forget.html">Lấy lại mật khẩu ngay.</a></small>
                    </div>
                    <div class="col-12 input-forms mt-3">
                        <button type="submit" class="w-100" id="btn-send-auth">Đăng nhập ngay</button>
                    </div>
                    <div class="col-12 mt-3 text-center w-100">
                        <p>Chưa có tài khoản? <a href="/client/register">Đăng ký thành viên.</a> </p>
                    </div>
                    <div class="col-12 diveler mt-3">
                        <p class="diveler-text">hoặc</p>
                    </div>
                    <div class="col-12 mt-3 icon-auth">
                        <ul class="d-flex justify-content-center">
                            <li><a href="https://accounts.google.com/o/oauth2/auth?response_type=code&amp;access_type=online&amp;client_id=&amp;redirect_uri=http%3A%2F%2Flocalhost%2FhandleGoogle.php&amp;state&amp;scope=email%20profile&amp;approval_prompt=auto"><i class="fab fa-google"></i></a>
                            </li>
                            <li><a href="#"><i class="fab fa-facebook"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        // check phone
        $.validator.addMethod("phoneVN", function(value, element) {
            return this.optional(element) || /^(0|84)[0-9]/g.test(value);
        }, "Số điện thoại phải là chữ số và có đầu số là 0 hoặc 84");
        // check form valid
        $('#login').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 6,
                    maxlength: 24
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 24
                }

            },
            messages: {
                username: {
                    required: 'Không bỏ trống thông tin.',
                    minlength: 'Tối thiểu 6 ký tự.',
                    maxlength: 'Tối đa 24 ký tự.'
                },
                password: {
                    required: 'Không bỏ trống thông tin.',
                    minlength: 'Tối thiểu 6 ký tự.',
                    maxlength: 'Tối đa 24 ký tự.'
                }
            }
        })
    });

    $('#login').submit(function(event) {
        /* Act on the event */
        event.preventDefault();
        // check valid before submit
        if ($(this).valid() == true) {
            $.ajax({
                    url: '/controller/client/Login.php',
                    type: 'POST',
                    method: 'POST',
                    data: {
                        username: $("#username").val(),
                        password: $("#password").val()
                    },
                    beforeSend: () => {
                        $('#btn-send-auth').html('Đang xử lý...').attr('disabled', '');
                    }
                })
                .done(function(result) {

                    let obj = JSON.parse(result);
                    $('#btn-send-auth').html('Đăng nhập ngay').removeAttr('disabled');
                        Swal.fire({ 
                            icon: obj.status,
                            title: 'Thông Báo',
                            text: obj.messages,
                            background: '#1f2029',
                            confirmButtonColor: '#ccfe1e',
                            customClass: 'custom_modal'
                        });
                        if(obj.url != '-1') {
                            setTimeout("location.href = '" + obj.url + "';", obj.time);
                        }
                })
                .fail(function() {
                    alert('Lỗi kết nối đến hệ thống!');
                });

        }
    });
</script>