<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "DANH MỤC";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    CheckLogin();
?>
<?php
$slug = check_string($_GET['slug']);
$check = $TUANORI->get_row(" SELECT * FROM `category` WHERE `slug` = '$slug' AND `status` = 1");
if(!$check) {
    msg_error('Link bạn truy cập không đúng hoặc đã bị xóa', BASE_URL(''), 3000);
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
}
?>
    <main>
        <section class="third-about-area third-about-bg">
            <div class="container custom-container">
                <!--  -->
                <div class="see-my-info-wrap pt-50">
                    <div class="row">
                        <div class="col-12">
                            <div class="third-section-title text-center mb-25">
                                <h2><?=$check['name'];?></h2>
                            </div>
                        </div>
                    </div>
                    <div>

                        <div class="row ">
                            <!-- right -->
                            <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `categories_sp` WHERE `status` = '1' AND `category` = '".$check['id']."' ORDER BY id DESC") as $row){ ?>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-5 item-hax">
                                <div class="hax-editor-status shadow-sm " style="z-index:10;">
                                    <span>Đã cập nhật</span>
                                </div>
                                <div class="hax-editor">
                                    <div class="hax-images-left">
                                        <a href="/huongdan/<?=$row['id'];?>">
                                            <div class="swiper mySwiper">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide w-100"> <img src="<?=$row['img'];?>" width='100%' height='100%' alt="<?=$row['name'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="hax-editor-right">
                                        <h4 class="text-uppercase"><?=$row['name'];?></h4>
                                        <div class="hax-info">
                                            <p style="text-align: justify;"><?=$row['mota'];?></p>
                                        </div>
                                        <div class="hax-button " style="padding: 0px 12px;">
                                            <div class="row">
                                                <div class="col-sm-6 col-6">
                                                    <select name="pack_hax_<?=$row['id'];?>" class="input-nice text-center">
                                                        <option value="">--Chọn gói--</option>
                                                        <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `category_goi` WHERE `status` = '1' AND `categories_sp` = '".$check['id']."' ORDER BY time DESC") as $rs){ ?>
                                                            <option value="<?=$rs['id'];?>"><?=number_format(giamgia($rs['money'], $my_gg));?> vnđ / <?=number_format($rs['time']);?> Giờ</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 col-6 input-forms">
                                                    <button class="w-100 btn-buy-hack" data-id='<?=$row['id'];?>'>Mua ngay</button>
                                                </div>
                                                <div class="col-sm-12 col-12 mt-3 mb-3">
                                                    <a href='/huongdan/<?=$row['id'];?>' class="w-100 text-uppercase btn-custom-hd">Tải tool và hướng dẫn sử dụng</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                         
                            <!-- right -->
                        </div>

                    </div>
                </div>
                <!--  -->
            </div>
        </section>
        <script>
            var swiper = new Swiper(".mySwiper", {
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.btn-buy-hack').click(function(event) {
                    /* Act on the event */
                    let id = $(this).data('id');
                    let pack = $(`select[name="pack_hax_${id}"]`).val();
                    if (pack == '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Vui lòng chọn gói trước khi bấm mua ngay.',
                            confirmButtonColor: '#ccfe1e',
                            confirmButtonText: 'Đồng ý',
                            customClass: "custom_modal",
                            background: '#1f2029',
                        })
                    } else {
                        Swal.fire({
                            customClass: "custom_modal",
                            background: '#1f2029',
                            confirmButtonColor: '#ccfe1e',
                            confirmButtonText: 'Đồng ý',
                            input: 'number',
                            title: 'Nhập số lượng muốn mua',
                            inputPlaceholder: 'Nhập số lượng',
                            inputValue: 1,
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            showCancelButton: true,
                            showLoaderOnConfirm: true,
                            preConfirm: (soluong) => {

                                return $.ajax({
                                        url: '/controller/client/Buy.php',
                                        type: 'POST',
                                        data: {
                                            pack_id: pack,
                                            soluong: soluong,
                                            key: 0
                                        },
                                    })
                                    .done(function(result) {
                                        return result;
                                    })
                                    .fail(function() {
                                        alert('Lỗi mạng kết nối');
                                    });


                            },

                        }).then((result) => {
                            if (result.isConfirmed) {
                                // get result
                                let obj2 = JSON.parse(result.value);
                                if (obj2.status == 99) {

                                    Swal.fire({
                                        title: 'Thông báo',
                                        html: `Bạn đang thực hiện mua hack: <b style="color: red">${obj2.messages.banhack}</b>
                                        <br>
                                        Giá tiền: <strong style="color: green">${obj2.messages.price} vnđ</strong>
                                        <br>
                                        Số lượng: <strong>${obj2.messages.soluong}</strong>
                                        <br>
                                        Gói: <strong>${obj2.messages.type} / ${obj2.messages.time}</strong>
                                        <br>
                                        <small>Kiểm tra kĩ thông tin trên trước khi bấm vào nút thanh toán!</small>
                                        `,
                                        icon: 'warning',
                                        showCancelButton: true,
                                        customClass: "custom_modal",
                                        background: '#1f2029',
                                        confirmButtonColor: '#ccfe1e',
                                        confirmButtonText: 'Thanh toán ngay',
                                        showLoaderOnConfirm: true,
                                        preConfirm: () => {
                                            return $.ajax({
                                                url: '/controller/client/Buy.php',
                                                type: 'POST',
                                                data: {
                                                    key: 1,
                                                    pack_id: obj2.messages.pack,
                                                    soluong: obj2.messages.soluong
                                                },
                                            }).done(function(re) {
                                                return re;
                                            })
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {

                                            obj3 = JSON.parse(result.value);
                                            if (obj3.status == 99) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Thông Báo',
                                                    text: obj3.messages,
                                                    confirmButtonColor: '#ccfe1e',
                                                    confirmButtonText: 'Đồng ý',
                                                    customClass: "custom_modal",
                                                    background: '#1f2029',
                                                }).then(() => {
                                                    location.reload();
                                                })
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: obj3.messages,
                                                    confirmButtonColor: '#ccfe1e',
                                                    confirmButtonText: 'Đồng ý',
                                                    customClass: "custom_modal",
                                                    background: '#1f2029',
                                                })
                                            }


                                        }
                                    })
                                } else {
                                    // 
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: obj2.messages,
                                        confirmButtonColor: '#ccfe1e',
                                        confirmButtonText: 'Đồng ý',
                                        customClass: "custom_modal",
                                        background: '#1f2029',
                                    })
                                }
                            }
                        })
                    }


                });
            });
        </script>
    </main>
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    require_once("../../pages/client/Footer.php");
?>