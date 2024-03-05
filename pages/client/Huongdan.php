<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $id = check_string($_GET['id']);
    $check = $TUANORI->get_row(" SELECT * FROM `categories_sp` WHERE `id` = '$id' AND `status` = 1");
    if(!$check) {
        header("Location: /");
    }
    $title = "Hướng dẫn sử dụng ".$check['name'];
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    CheckLogin();
?>
<?php
$id = check_string($_GET['id']);
$check = $TUANORI->get_row(" SELECT * FROM `categories_sp` WHERE `id` = '$id' AND `status` = 1");
if(!$check) {
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    msg_error('Link bạn truy cập không đúng hoặc đã bị xóa', BASE_URL(''), 3000);
}
?>
    <main>
        <section class="third-about-area third-about-bg pb-90">
            <div class="container custom-container">
                <!--  -->
                <div class="see-my-info-wrap pt-50">
                    <div class="row">
                        <div class="col-12">
                            <div class="third-section-title text-center mb-25">
                                <h2>Hướng dẫn sử dụng <span><?=$check['name'];?></span></h2>
                            </div>
                        </div>

                        <div class="col-lg-7 mb-5">
                            <div class="w-100" id="video-huongdan">
                                <h3 class="text-uppercase title-video">Video cài đặt <?=$check['name'];?></h3>

                                <iframe width="752" height="460" src="https://www.youtube.com/embed/<?=$check['id_video'];?>" title="<?=$check['name'];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>

                        </div>
                        <div class="col-lg-5 info-list-details">
                            <h3 class="text-uppercase title-video">Thông tin</h3>
                            <p><?=$check['mota'];?></p>
                            <a href="/category/<?=$TUANORI->get_row(" SELECT * FROM `category` WHERE `id` = '".$check['category']."' AND `status` = 1")['slug'];?>" class="w-100 btn-customer mb-3" style="border: 1px solid #c8ff0b;">Thuê tool ngay</a>
                            <h5 class="text-uppercase title-video">Link tải - liên hệ</h5>
                            <div class="row mb-3">
                                <small class="mb-2">Nếu không tải được link chính hãy tải link phụ* </small>
                                <div class="col-12 mt-3">
                                    <a href="<?=$TUANORI->site('grzalo');?>" class="w-100 btn-customer btn-lg text-info" style="border: 1px solid #c8ff0b;">Tham gia nhóm hỗ trợ cài đặt <i class="fas fa-user-shield"></i></a>
                                    <small>Trang web chỉ có hướng dẫn bằng video. Gặp khó khăn liên hệ admin*</small>
                                </div>
                                <div class="col-6 mt-3">
                                    <a href="<?=$check['download'];?>" class="w-100 btn-customer text-info" style="border: 1px solid #c8ff0b;">Link tải Hack</a>
                                </div>
                                <div class="col-6 mt-3">
                                    <a href="<?=$check['download2'];?>" class="w-100 btn-customer text-info" style="border: 1px solid #c8ff0b;">Link tải phụ</a>
                                </div>

                            </div>
                            <!-- hình ảnh -->
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide w-100"><img src="<?=$check['img'];?>" width='100%' height='240px' alt="">
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>


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
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        </script>
    </main>
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    require_once("../../pages/client/Footer.php");
?>