</section>

<footer id="footer" class="clearfix ">
    <div class="footer">
        <div class="container">
            <div class="footer-inner">
                <div class="row">


                  <div class="col-md-3">
                      <div class="footer-content">
                        <h2 class="title">درباره ما</h2>
                        <div class="separator-2"></div>
                        <ul>
                             <li><a href='/about-us.php'>درباره ما</a></li>
                            <li><a href='/contact-us.php'>تماس با ما</a></li>
                            <li><a href='/termofservices.php'>قوانین و مقررات</a></li>
                            <li><a href='/report.php'>ثبت شکایات</a></li>
                        </ul>
                        <div class="separator-2"></div>
                   </div>
                  </div>

                    <div class="col-md-6">
                        <div class="footer-content">
                            <h2 class="title">پشتیبانی</h2>
                            <div class="separator-2"></div>
                            <p>
                            آدرس: تبریز - سه راهی فرودگاه ، جاده سنتو به طرف راه آهن روبروی اولین پمپ گاز
                                <br />

                                ایمیل: shamimtable@gmail.com
                            </p>

                            <div class="separator-2"></div>
                            <ul class="list-icons">
                                <li><i class="fa fa-phone pr-10 text-default"></i> {TELEPHONE}</li>
                            </ul>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="footer-content" >
                      {SITE_ENAMAD}
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
    <div class="subfooter">
        <div class="container">
            <div class="subfooter-inner">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">Copyright &copy; 2014 - 2018 <a href="http://www.shamimgraphic.ir/">شمیم گرافیک</a> - {lang.All rights reserved}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<script>check_carts('');</script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{TEMPLATE_ROOT}assets/js/template.js"></script>
<script src="{SITE_ROOT}inc/jquery.colorbox-min.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
  $(document).on('ready', function() {

    $(".variable").slick({
  rtl: true,
  infinite: false,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 2,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,

      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
    });

  });
</script>
</body>
</html>
