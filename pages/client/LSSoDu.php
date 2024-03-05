<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Biến động số dư";
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
                                <h2>Lịch sử <span>dòng tiền</span> </h2>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="lichsu-ct">
                            <thead class="text-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th>Số dư trước</th>
                                    <th>Số tiền</th>
                                    <th>Số dư sau </th>
                                    <th>Nội dung</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `biendongsodu` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC LIMIT 100") as $row){ ?>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td><?=++$i;?></td>
                                    <td><?=number_format($row['truoc']);?> ₫</td>
                                    <?php if($row['sau'] >= $row['truoc']) { ?>
                                        <td style="color: green; font-weight: bold">+ <?=number_format($row['tongtien']);?>₫</td>
                                    <?php } else { ?>
                                        <td style="color: red; font-weight: bold">- <?=number_format($row['tongtien']);?>₫</td>
                                    <?php } ?>
                                    <td><?=number_format($row['sau']);?> ₫</td>
                                    <td><?=$row['note'];?></td>
                                    <td><?=$row['time'];?></td>
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