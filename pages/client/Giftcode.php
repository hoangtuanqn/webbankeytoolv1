<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Nhập Giftcode";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    CheckLogin();

?>
    <main>
        <section class="third-about-area third-about-bg pb-90">
            <div class="container custom-container">
                <!--  -->
                <div class="see-my-info-wrap pt-50">
                    <div class="row">
                        <div class="col-12">
                            <div class="third-section-title text-center mb-50">
                                <h2>Nhận thưởng <span>Giftcode</span> </h2>
                                <p>Nhập giftcode để nhận tiền.</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="row">
                            <div class="col-xl-4 col-sm-12">
                                <h3 class="text-uppercase">Hướng dẫn</h3>
                                <p>
                                    - Nhận Giftcode khi tham gia sự kiện.
                                    <br> - Nhập đúng giftcode, sẽ nhận được số tiền của giftcode
                                </p>
                            </div>
                            <div class="col-xl-8 col-sm-12">
                                <div>
                                    <h3 class="text-uppercase">Nhập Giftcode</h3>
                                </div>
                                <label for="">Nhập Giftcode</label>
                                <input type="text" placeholder="AG-XCFERTXCVC" name="giftcode">
                                <div class="input-forms mt-3 col-xl-6 col-sm-12">
                                    <button class="w-100" id="nhap-giftcode-ngay">Nhận ngay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
        </section>
        <script>
            $(document).ready(function() {
                $('#nhap-giftcode-ngay').click(function(event) {
                    /* Act on the event */
                    let giftcode = $('input[name="giftcode"]').val();
                    if (giftcode == '') {
                        Swal.fire({
                            title: 'Thông báo',
                            html: "không được bỏ trống thông tin.",
                            icon: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#ccfe1e',
                            confirmButtonText: 'Đồng ý',
                            customClass: "custom_modal",
                            showLoaderOnConfirm: true,
                            background: '#1f2029',
                        })
                    } else {
                        $.ajax({
                                url: '/controller/client/Giftcode.php',
                                type: 'POST',
                                method: 'POST',
                                data: {
                                    giftcode: giftcode
                                },
                                beforeSend: () => {
                                    $('#nhap-giftcode-ngay').html('Đang xử lý...').attr('disabled', '');
                                }
                            })
                            .done(function(result) {
                                let obj = JSON.parse(result);
                                $('#nhap-giftcode-ngay').html('Nhận ngay').removeAttr('disabled');
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
                                console.log("error");
                            });

                    }
                });
            });
        </script>
    </main>
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    require_once("../../pages/client/Footer.php");
?>