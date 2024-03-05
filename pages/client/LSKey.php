<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Lịch sử giao dịch";
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
                                <h2>Lịch sử <span>giao dịch</span> </h2>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="lichsu-giaodich">
                            <thead class="text-light bg-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>KEY</th>
                                    <th>LOẠI HACK</th>
                                    <th>Gói</th>
                                    <th>THANH TOÁN</th>
                                    <th>THỜI GIAN MUA</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `ls_mua` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC") as $row){ 
                                $TUANORI->get_row(" SELECT * FROM `categories_sp` WHERE `id` = '".$row['categories_sp']."' ")
                            ?>
                                <tr style="vertical-align: middle;">
                                    <td style="color: white;"><?=++$i;?></td>
                                    <td><a style="color: white; font-weight: bold;"><?=$row['token'];?></a>
                                        <button data-noidung="<?=$row['token'];?>" class="copy btn-sm btn-saochep"><i class="fa fa-copy"></i>
                                    </td>
                                    <td style="color: white; font-weight: bold;"><?=$TUANORI->get_row(" SELECT * FROM `categories_sp` WHERE `id` = '".$row['categories_sp']."' ")['name'];?></td>
                                    <td style="color: red"><?=$TUANORI->get_row(" SELECT * FROM `category_goi` WHERE `id` = '".$row['category_goi']."' ")['time'];?> giờ</td>

                                    <td class="text-center;" style="color: green; font-weight: bold"><?=number_format($row['sotien']);?>đ</td>
                                    <td style="color: white;"><?=gettime2(strtotime($row['thoigian']));?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
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
                $('#lichsu-giaodich').dataTable({
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