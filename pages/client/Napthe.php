<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Nạp Thẻ Cào";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    CheckLogin();
    if($TUANORI->site('status_card') == 'OFF') {
        msg_error("Nạp tiền đang tạm bảo trì", "/", 1000);
    }
?>
    <main>
        <section class="third-about-area third-about-bg pb-90">
            <div class="container custom-container">
                <!--  -->
                <div class="see-my-info-wrap pt-50">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="third-section-title text-center mb-50">
                                <h2>nạp <span>thẻ cào</span> tự động</h2>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card bg-dark shadow">
                                <div class="row mobile-column-reverse" style="padding: 12px;">
                                    <div class="col-sm-12 col-lg-4 text-center">
                                        <h3 class="text-uppercase">Bảng giá nạp thẻ</h3>
                                        <table class="w-100" id="thongtin-thecao">
                                            <thead>
                                                <tr>
                                                    <th>Loại thẻ</th>
                                                    <th>Thực nhận</th>
                                                    <th>Ưu đãi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `ck_card` ") as $row){ ?>
                                                <tr class="mt-2">
                                                    <td><?=$row['loaithe'];?></td>
                                                    <td><?=100-$row['ck'];?>%</td>
                                                    <td>0 %</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-12 col-lg-8  mb-5">
                                        <h3 class="text-uppercase text-center">Nạp thẻ ngay</h3>
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                <label for="">Số serial</label>
                                                <input name="serial" type="number" class="input-nice" placeholder="Nhập số serial">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                <label for="">Mã thẻ</label>
                                                <input name="pin" type="number" class="input-nice" placeholder="Nhập mã thẻ">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                <label for="">Mệnh giá</label>
                                                <select name="menhgia" class="input-nice">
                                                    <option value="10000">10.000Đ</option>
                                                    <option value="20000">20.000Đ</option>
                                                    <option value="50000">50.000Đ</option>
                                                    <option value="100000">100.000Đ</option>
                                                    <option value="200000">200.000Đ</option>
                                                    <option value="500000">500.000Đ</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                <label for="">Nhà mạng</label>
                                                <select name="nhamang" class="input-nice">
                                                <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `ck_card` ") as $row){ ?>
                                                    <option value="<?=$row['loaithe']?>"><?=$row['loaithe']?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 input-forms col-lg-6 mt-2 mb-2">
                                                <p><span class="text-danger">*Lưu ý:</span> Hãy kiểm tra kĩ mệnh giá nếu sai sẽ bị mất thẻ.</p>
                                                <button class="w-100" id="nap-ngay">Nạp ngay</button>
                                            </div>
                                        </div>
                                    </div>
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
                $('#nap-ngay').click(function(event) {
                    /* Act on the event */
                    let pin = $('input[name="pin"]').val();
                    let serial = $('input[name="serial"]').val();
                    let nhamang = $('select[name="nhamang"]').val();
                    let menhgia = $('select[name="menhgia"]').val();
                    if (pin == '' || serial == '' || nhamang == '' || menhgia == '') {
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
                                url: '/controller/client/Napthe.php',
                                type: 'POST',
                                method: 'POST',
                                data: {
                                    pin: pin,
                                    serial: serial,
                                    nhamang: nhamang,
                                    menhgia: menhgia
                                },
                                beforeSend: () => {
                                    $('#nap-ngay').html('Đang xử lý...').attr('disabled', '');
                                }
                            })
                            .done(function(result) {
                                let obj = JSON.parse(result);
                                $('#nap-ngay').html('Nạp ngay').removeAttr('disabled');
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