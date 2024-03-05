<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Đăng Ký Thành Viên";
    require_once("../../pages/client/Head.php");
?>
<div class="register-login">
    <div class="logo-auth">
        <a href="/"><img src="<?=$TUANORI->site('logo');?>" alt="ĐĂNG KÝ THÀNH VIÊN"></a>
    </div>
    <div class="d-flex h-100">
        <div class="right-form">
            <div class="carousel slide carousel-fade h-100" data-bs-ride="carousel">
                <div class="carousel-inner h-100">
                    <div class="carousel-item active h-100" data-interval="200">
                        <img src="https://i.imgur.com/QrbzQPx.jpg" width="1280" class="d-block w-100 h-100" alt="">
                    </div>
                    <div class="carousel-item  h-100" data-interval="200">
                        <img src="https://i.imgur.com/N9HsdxI.jpg" width="1280" class="d-block w-100 h-100" alt="">
                    </div>
                    <div class="carousel-item  h-100" data-interval="200">
                        <img src="https://i.imgur.com/H8ViipK.jpg" width="1280" class="d-block w-100 h-100" alt="">
                    </div>
                    <div class="carousel-item  h-100" data-interval="200">
                        <img src="https://i.imgur.com/8yS8l2g.jpg" width="1280" class="d-block w-100 h-100" alt="">
                    </div>

                </div>
            </div>
            <div class="black-background">

            </div>
        </div>
        <div class="left-form">
            <h5 class="text-uppercase">Đăng ký thành viên</h5>
            <form id="register">
                <div class="row" id="form-register-login">
                    <div class="col-12 input-forms mt-3">
                        <label for="">Tài khoản</label>
                        <input name="username" id="username" class="input-nice" type="text" placeholder="Từ 6 - 24 ký tự" autocomplete="off">
                    </div>
                    <div class="col-12 input-forms mt-3">
                        <label for="">Mật khẩu</label>
                        <input name="password" id="password" class="input-nice" type="password" placeholder="********" autocomplete="off">
                    </div>
                    <div class="col-12 input-forms mt-3">
                        <label for="">Nhập lại mật khẩu</label>
                        <input name="repassword" id="repassword" class="input-nice" type="password" placeholder="********" autocomplete="off">
                    </div>
                    <div class="col-12 input-forms mt-3">
                        <label for="">Email</label>
                        <input name="email" id="email" class="input-nice" type="email" placeholder="user@gmail.com" autocomplete="off">
                    </div>
                    <div class="col-12 input-forms mt-3">
                        <label for="">Phone</label>
                        <input name="phone" id="phone" class="input-nice" type="number" placeholder="0 123-888-999" autocomplete="off">
                    </div>
                    <div class="col-12 input-forms mt-3">
                        <button type="submit" class="w-100" id="btn-send-auth">Đăng ký ngay</button>
                    </div>

                    <div class="col-12 mt-3 text-center w-100">
                        <p>Đã có tài khoản? <a href="/client/login">Đăng nhập ngay.</a> </p>
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
            return this.optional(element) || /^(0|84)[0-9]/.test(value);
        }, "Số điện thoại phải là chữ số và có đầu số là 0 hoặc 84");
        // fullname
        $.validator.addMethod("fullname", function(value, element) {
            return this.optional(element) || /^[A-Z-' ]*$/g.test(value);
        }, "Vui lòng nhập họ tên không dấu.");
        // check form valid
        $('#register').validate({
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
                },
                repassword: {
                    required: true,
                    minlength: 6,
                    maxlength: 24,
                    equalTo: '#password'
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    phoneVN: true,
                    maxlength: 11,
                    number: true
                },
                captcha: {
                    required: true,
                    maxlength: 4,
                    minlength: 4,
                    number: true
                }

            },
            messages: {
                fullname: {
                    required: 'Không bỏ trống thông tin.',
                    minlength: 'Tối thiểu 3 ký tự.',
                    maxlength: 'Tối đa 24 ký tự.'
                },
                username: {
                    required: 'Không bỏ trống thông tin.',
                    minlength: 'Tối thiểu 6 ký tự.',
                    maxlength: 'Tối đa 24 ký tự.'
                },
                password: {
                    required: 'Không bỏ trống thông tin.',
                    minlength: 'Tối thiểu 6 ký tự.',
                    maxlength: 'Tối đa 24 ký tự.'
                },
                repassword: {
                    required: 'Không bỏ trống thông tin.',
                    minlength: 'Tối thiểu 6 ký tự.',
                    maxlength: 'Tối đa 24 ký tự.',
                    equalTo: 'Mật khẩu không trùng khớp.'
                },
                email: {
                    required: 'Không bỏ trống thông tin.',
                    email: 'Email không đúng định dạng.'
                },
                phone: {
                    phoneVN: 'Số điện thoại phải có đầu số là 0 hoặc 84.',
                    maxlength: 'Số điện thoại phải là 11 ký tự.',
                    number: 'Số điện thoại phải là chữ số'
                }
            }
        })
    });

    $('#register').submit(function(event) {
        event.preventDefault();
        if ($(this).valid() == true) {
            $.ajax({
                    url: '/controller/client/Register.php',
                    type: 'POST',
                    method: 'POST',
                    data: {
                        username: $("#username").val(),
                        password: $("#password").val(),
                        repassword: $("#repassword").val(),
                        email: $("#email").val(),
                        phone: $("#phone").val()
                    },
                    beforeSend: () => {
                        $('#btn-send-auth').html('Đang xử lý...').attr('disabled', '');
                    }
                })
                .done(function(result) {

                    let obj = JSON.parse(result);
                    $('#btn-send-auth').html('Đăng ký ngay').removeAttr('disabled');
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