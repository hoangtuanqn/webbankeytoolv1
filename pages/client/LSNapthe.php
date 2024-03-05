<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Lịch sử nạp thẻ cào";
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
                                <h2>Lịch sử <span>nạp thẻ cào</span> </h2>
                                <a href="/client/napthe" class=" w-25 m-auto btn-customer text-uppercase">Nạp thẻ ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="lichsu-ct">
                            <thead class="text-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Số Serial</th>
                                    <th scope="col">Mã Thẻ</th>
                                    <th scope="col">Thực Nhận </th>
                                    <th scope="col">Mệnh Giá</th>
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">Nạp lúc</th>
                                    <th scope="col">Cập nhật</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `napcard` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC LIMIT 100") as $row){ ?>
                                <tr style="vertical-align: middle;">
                                    <td><?=++$i;?></td>
                                    <td><?=$row['seri'];?></td>
                                    <td><?=$row['pin'];?></td>
                                    <td><span style="color: <?php echo (($row['status'] == 'thatbai') ? 'red': 'green');?>; font-weight: bold"><?=number_format($row['thucnhan']);?>₫</span></td>
                                    <td><?=number_format($row['menhgia']);?>₫</td>
                                    <td><?=stnapthe($row['status']);?></td>
                                    <td><?=$row['thoigian'];?></td>
                                    <td><?=$row['uptime'];?></td>
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