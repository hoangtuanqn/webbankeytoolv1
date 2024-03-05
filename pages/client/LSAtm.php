<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Lịch sử NẠP ATM";
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
                                <h2>Lịch sử <span>nạp atm</span> </h2>
                                <a href="/client/napatm" class=" w-25 m-auto btn-customer text-uppercase">nạp ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="lichsu-ct">
                            <thead class="text-light">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">NGÂN HÀNG</th>
                                    <th scope="col">MÃ GD</th>
                                    <th scope="col">SỐ TIỀN</th>
                                    <th scope="col">THỜI GIAN</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `napatm` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC") as $row){ ?>
                            <tr>
                                <td><?=++$i;?></td>
                                <td><?=$row['hinhthuc'];?></td>
                                <td><?=$row['magd'];?></td>
                                <td style="color: green; font-weight: bold">+ <?=number_format($row['sotien']);?>đ</td>
                                <td><?=$row['thoigian'];?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--  -->
            </div>
        </section>
        <script>
            $(document).ready(function() {
                $('#lichsu-ct').DataTable({
                    order: ['0', 'asc']
                });
            });
        </script>
    </main>
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    require_once("../../pages/client/Footer.php");
?>