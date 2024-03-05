<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
define("IN_SITE", true);
require_once(__DIR__."/core/config.php");
require_once(__DIR__."/core/function.php");
$title = "TRANG CHỦ";
require_once(__DIR__."/pages/client/Head.php");
require_once(__DIR__."/pages/client/Header.php");
?>
<main>
    <!-- slider-area -->
    <section class="donation-area donation-bg fix pt-50 pb-50" id="banner-home">
        <div class="container custom-container">
            <div class="donation-wrap">
                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <div class="donation-content">
                            <div class="third-title-style text-center">
                                <h2 style="color: #DD0000;"><?=$fr[0];?><span>.<?=substr($tenmien, strlen($fr[0])+1);?></span></h2>
                                <h4 style="color: #CC0000;"> BEST TEAM CHEAT VIET NAM - THẮNG BẠI TẠI BẢN HACK</h4>
                                <div class="inner">

                                </div>
                                <div class="header-notice">
                                    <?=$TUANORI->site('thongbao')?>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- slider-area-end -->

    <!-- third-about-area -->
    <section class="third-about-area third-about-bg pb-90">
        <div class="container custom-container">
            <div class="row align-items-center">
        
            </div>
            <div id="games-list">

                <!--  -->
                <div class="see-my-info-wrap pt-25">
                    <div class="row">
                        <div class="col-12">
                            <div class="third-section-title text-center mb-25">
                                <h2>Danh sách <span>game</span></h2>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="text" id="search-input" class="form-control mt-2 m-auto mb-2 p-2" placeholder="Nhập thiết bị đang sử dụng ( PC, Android, IOS, Giả lập )">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `category` WHERE `status` = '1' ORDER BY id DESC") as $row){ ?>
                        <div class="home-item col-xl-4 col-lg-6 col-md-6 col-sm-10">
                            <div class="my-info-box mb-30">
                                <div class="header-info-box">
                                    <h5><?=$row['name'];?></h5>
                                    <div class="liner"></div>
                                </div>
                                <div class="my-info-box-content">
                                    <a href="/category/<?=$row['slug'];?>" class="mt-award">
                                        <img src="<?=$row['img'];?>" alt="">
                                    </a>
                                    <div class="liner"></div>
                                </div>
                                <div class="info-categogries">
                                    <p><?=$row['mota'];?>
                                        <p style="display: none;"><?=$row['seo_key'];?></p>
                                    </p>
                                </div>
                                <div class="my-info-box-top">
                                    <a href="/category/<?=$row['slug'];?>">
                                        <h6>Mua ngay</h6>
                                        <img src="/public/img/bg/my_info_box_hover.png" alt="" class="info-box-top-hover">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                     

                    </div>
                </div>
                <!--  -->

            </div>
        </div>
    </section>
    <!-- third-about-area-end -->
    <script>
        $(document).ready(function() {
            $("#search-input").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".home-item").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <!-- brand-area -->

    <!-- brand-area-end -->

</main>
<?php
    require_once(__DIR__."/pages/client/Footer.php");
?>