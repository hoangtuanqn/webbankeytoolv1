<footer class="home-six-footer">
    <div class="footer-top footer-bg">
        <!-- newsletter-area -->
        <div class="newsletter-area s-newsletter-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="newsletter-wrap">
                            <div class="section-title newsletter-title">
                                <h2><?=$fr[0];?><span>.<?=substr($tenmien, strlen($fr[0])+1);?></span></h2>
                            </div>
                            <div class="newsletter-form">
                                <form action="#">
                                    <div class="newsletter-form-grp">
                                        <i class="fa fa-youtube-play"></i>
                                        <input type="text" placeholder="<?=$TUANORI->site('ytbadmin');?>" readonly>
                                    </div>
                                    <button type="button" onclick="location.href='<?=$TUANORI->site('ytbadmin');?>'">SUBSCRIBE
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- newsletter-area-end -->
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget mb-50">
                        <div class="footer-logo mb-35">
                            <a href="https://thichthihack.com/"><img width="100%" src="<?=$TUANORI->site('logo');?>" alt="">
                            </a>
                        </div>
                        <div class="footer-text">
                            <p><?=$TUANORI->site('mota');?></p>
                            <div class="footer-contact">
                                <ul>
                                    <li><i class="fas fa-headphones"></i> <span>Phone :</span><b style="color: white"> <?=$TUANORI->site('phone');?></b></li>
                                    <li><i class="fas fa-envelope-open"></i><span>Email : </span><b style="color: white"> <?=$TUANORI->site('email');?></b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-50">
                        <div class="fw-title mb-35">
                            <h5>Danh mục</h5>
                        </div>
                        <div class="fw-link">
                            <ul>
                                <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `category`  ORDER BY id DESC") as $row){ 
                                    ++$i;    
                                ?>
                                    <li><a href="/category/<?=$row['slug'];?>"><?=$row['name']?></a></li>
                                <?php if($i >=4) break; } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-50">
                        <div class="fw-title mb-35">
                            <h5>Dịch vụ</h5>
                        </div>
                        <div class="fw-link">
                            <ul>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget mb-50">
                        <div class="fw-title mb-35">
                            <h5>Theo dõi</h5>
                        </div>
                        <div class="footer-social">
                            <ul>
                                <li><a href="<?=$TUANORI->site('fbadmin');?>"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li><a href="<?=$TUANORI->site('ytbadmin');?>"><i class="fab fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap s-copyright-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="copyright-text">
                        <p>Bản quyền thuộc về <a href="#"><?=strtoupper($tenmien)?></a> | <b>Website được phát triển bởi <a href="https://www.facebook.com/phamhoangtuan.ytb/">TUANORI.VN</a></b>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<?=$TUANORI->site('script_live_chat');?>
<script>
        function updateTextView(_obj){
            var num = getNumber(_obj.val());
            if(num==0){
                _obj.val('');
            }else{
                _obj.val(num.toLocaleString());
            }
        }
        function getNumber(_str){
            var arr = _str.split('');
            var out = new Array();
            for(var cnt=0;cnt<arr.length;cnt++){
                if(isNaN(arr[cnt])==false){
                    out.push(arr[cnt]);
                }
            }
            return Number(out.join(''));
        }
        $(document).ready(function(){
            $('.fnum').on('keyup',function(){
                updateTextView($(this));
            });
        });

        $(document).ready(function() {
            $('.btn-saochep').click(function(event) {
                let data = $(this).data('noidung');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(data).select();
                document.execCommand("copy");
                $temp.remove();
                /* Act on the event */
                let noticer = $('#liveToast');
                $('#noidung-toart').html('Đã coppy nội dung: <strong class="text-warning">' + data + '</strong>');
                noticer.show();
                setTimeout(function() {
                    noticer.hide();
                }, 1500);
            });
        });
    </script>


    <!-- JS here -->
    <script src="/public/js/ajax.js"></script>

    <script src="/public/js/router.js"></script>
    <script src="/public/js/popper.min.js"></script>

    <script src="/public/js/isotope.pkgd.min.js"></script>
    <script src="/public/js/slick.min.js"></script>
    <script src="/public/js/jquery.meanmenu.min.js"></script>
    <script src="/public/js/wow.min.js"></script>
    <script src="/public/js/aos.js"></script>
    <script src="/public/js/jquery.lettering.js"></script>
    <script src="/public/js/jquery.textillate.js"></script>
    <script src="/public/js/jquery.odometer.min.js"></script>
    <script src="/public/js/jquery.appear.js"></script>
    <script src="/public/js/jquery.countdown.min.js"></script>
    <script src="/public/js/jquery.scrollUp.min.js"></script>
    <script src="/public/js/imagesloaded.pkgd.min.js"></script>
    <script src="/public/js/jquery.magnific-popup.min.js"></script>
    <script src="/public/js/plugins.js"></script>
    <script src="/public/js/main.js"></script>
</body>

</html>