<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Lịch sử chuyển tiền";
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
                                <h2>Lịch sử <span>chuyển tiền</span> </h2>
                                <a href="/client/chuyentien" class=" w-25 m-auto btn-customer text-uppercase">Chuyển tiền ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="lichsu-ct">
                            <thead class="text-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Người chuyển</th>
                                    <th scope="col">Người nhận</th>
                                    <th scope="col">Số tiền</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Ip thực hiện</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `chuyentien` WHERE `userchuyen` = '".$getUser['username']."' or `usernhan` = '".$getUser['username']."' ORDER BY id DESC") as $row){ ?>
                                <tr style="vertical-align: middle;">
                                    <td><?=++$i;?></td>
                                    <td><?=$row['userchuyen'];?></td>
                                    <td><?=$row['usernhan'];?></td>
                                    <?php if($row['usernhan'] == $getUser['username']) { ?>
                                        <td style="color: green">+ <?=number_format($row['sotien']);?> ₫</td>
                                    <?php } else { ?>
                                        <td style="color: red">- <?=number_format($row['sotien']);?> ₫</td>
                                    <?php } ?>
                                    <td><?=gettime2($row['time']);?></td>
                                    <td class="text-green-500"><?=$row['ip'];?></td>
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