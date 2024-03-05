<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Chuyển tiền";
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
                                <h2>YÊU CẦU <span>CHUYỂN TIỀN</span> </h2>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="card p-0 col-lg-6 m-auto col-sm-12 bg-dark">
                                <div class="card-header text-center">
                                    <h3 class="text-uppercase m-0">Yêu cầu chuyển tiền</h3> </div>
                                <div class="card-body " style="padding-top: 0;">
                                    <form method="POST" class="row" id="transfer">
                                        <div class="col-12 mt-3">

                                            <label for="">Id người nhận</label>
                                            <input type="number" id="userid" class="input-nice" placeholder="Nhập ID người nhận">


                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="">Số tiền</label>
                                            <input type="text" id="coin" class="input-nice fnum" placeholder="1000">
                                        </div>


                                        <div class="col-12 mt-4">
                                            <div class="row">
                                                <div class="col-lg-3 text-center text-header-from">
                                                    <h4 class="text-uppercase text-danger"> <strong>Lưu ý:</strong></h4>
                                                </div>
                                                <div class="col-lg-9 col-sm-12">
                                                    <p style="text-align: left">
                                                        Khi đã chuyển tiền đi, tiền sẽ đc sang tài khoản của người kia NGAY LẬP TỨC và không thể hủy.
                                                        <br>
                                                        <strong style="font-weight:700;">Giới hạn và phí giao dịch: </strong>
                                                        <br> - Số tiền giao dịch tối thiểu: <strong class="text-warning"> 10.000 đ</strong>
                                                        <br> - Số tiền giao dịch tối đa một lần: <strong class="text-warning"> 1.000.000 đ</strong>
                                                        <br> - Phí giao dịch: <strong class="text-info">1.000 đ</strong>
                                                        <br/>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="d-flex" style="justify-content: center;
                    align-items: center;
                    width: 100%;
                    column-gap: 20px;
                }">
                                                <button type="button" id="chuyentien" class="w-100 btn-customer text-uppercase">Chuyển tiền ngay</button>
                                                <a href="/lichsu-ct.html" class="w-100 btn-customer text-uppercase">Lịch sử giao dịch</a>
                                            </div>

                                        </div>
                                    </form>
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
                $('#chuyentien').click(function(event) {
                $.ajax({
                        url: '/controller/client/Chuyentien.php',
                        type: 'POST',
                        method: 'POST',
                        data: {
                            userid: $("#userid").val(),
                            coin: $("#coin").val()
                        },
                        beforeSend: () => {
                            $('#chuyentien').html('Đang xử lý...').attr('disabled', '');
                        }
                    })
                    .done(function(result) {
                        let obj = JSON.parse(result);
                        $('#chuyentien').html('Chuyển tiền ngay').removeAttr('disabled');
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
                });
            });
        </script>
    
    </main>
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    require_once("../../pages/client/Footer.php");
?>