<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Nạp tiền ATM";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    CheckLogin();
    if($TUANORI->site('status_napbank') == 'OFF') {
        msg_error("Nạp tiền đang tạm bảo trì", "/", 1000);
    }
?>

    <main>
        <style>
            #table-nap.dataTable {
                border-collapse: collapse !important;
            }
            
            .form-search select,
            input {
                width: unset;
                color: #000000 !important;
            }
            
            .dataTables_wrapper .dataTables_length select {
                color: black !important;
            }
            
            .btn-custom-chuyentien {
                color: #3f51b5 !important;
                border: 1px solid #3f51b5 !important;
            }
            
            .btn-custom-chuyentien:hover {
                background: #3f51b5 !important;
                color: #ffff !important;
            }
            
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_processing,
            .dataTables_wrapper .dataTables_paginate {
                color: black !important;
            }
            
           
            
            #noidung-render p {
                color: #000;
                font-weight: 700;
                text-transform: uppercase;
            }
            
            table.dataTable tbody tr {
                color: #000 !important;
            }
        </style>
        <section class="third-about-area third-about-bg pb-90">
            <div class="container custom-container">
                <!--  -->
                <div class="see-my-info-wrap pt-50">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="third-section-title text-center mb-50">
                                <h2>nạp <span>ATM & MOMO</span> tự động</h2>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card bg-dark shadow">
                                <div class="row mobile-column-reverse" style="padding: 12px;">
                                    <div class="col-sm-12 col-lg-12  mb-5">
                                        <div class="row">
                                        <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `listbank`  ORDER BY id DESC") as $row){ ?>
                                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10">
                                                <div class="my-info-box mb-30">
                                                    <div class="header-info-box">
                                                        <h5><?=$row['bank'];?></h5>
                                                        <div class="liner"></div>
                                                    </div>
                                                    <div class="my-info-box-content">
                                                        <a href='#' class="mt-award">
                                                            <img src="<?=$row['img'];?>" height="100%" width="100%" alt="">
                                                        </a>
                                                        <div class="liner"></div>
                                                    </div>

                                                    <div class="">
                                                        <p>Số tài khoản: <b id="copySTK1" style="color: green;"><?=$row['stk'];?></b>
                                                            <button data-noidung="<?=$row['stk'];?>" class="copy btn-sm btn-saochep"><i class="fa fa-copy"></i></button>
                                                        </p>
                                                        <p>Chủ tài khoản: <b><?=$row['name'];?></b>
                                                        </p>
                                                        <p>Nội dung nạp: <b id="copyNoiDung1" style="color: red;"><?=$TUANORI->site('noidung_naptien').$getUser['id'];?></b>
                                                            <button data-noidung="<?=$TUANORI->site('noidung_naptien').$getUser['id'];?>" class="copy btn-sm btn-saochep"><i class="fa fa-copy"></i>
                                                            </button>
                                                        </p>


                                                    </div>
                                                    <div class="my-info-box-top">
                                                        <a href="#">
                                                            <h6><i class="fa fa-spinner fa-spin"></i>
                                                                Loading auto...</h6>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

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
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="1000">
                <div class="toast-header bg-dark">
                    <strong class="me-auto text-light">Thông báo</strong>
                </div>
                <div class="toast-body text-light bg-dark" id="noidung-toart">
                </div>
            </div>
        </div>
       
        <script>
            $(document).ready(function() {
                $('#table-nap').dataTable({
                    order: [
                        [0, 'asc']
                    ],
                });
            });
        </script>
    </main>
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    require_once("../../pages/client/Footer.php");
?>