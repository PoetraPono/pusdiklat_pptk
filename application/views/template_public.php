<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="description" content="StudyPress | Education & Courses HTML Template" />
<meta name="keywords" content="academy, course, education, education html theme, elearning, learning," />
<meta name="author" content="ThemeMascot" />

<!-- Page Title -->
<title>PPATK | Website PPATK</title>

<!-- Favicon and Touch Icons -->
<link href="<?php echo base_url();?>assets/images/favicon.png" rel="shortcut icon" type="image/png">
<link href="<?php echo base_url();?>assets/images/apple-touch-icon.png" rel="apple-touch-icon">
<link href="<?php echo base_url();?>assets/images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="<?php echo base_url();?>assets/images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
<link href="<?php echo base_url();?>assets/images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

<!-- Stylesheet -->
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/css-plugin-collections.css" rel="stylesheet"/>
<!-- CSS | menuzord megamenu skins -->
<link id="menuzord-menu-skins" href="<?php echo base_url();?>assets/css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
<!-- CSS | Main style file -->
<link href="<?php echo base_url();?>assets/css/style-main.css" rel="stylesheet" type="text/css">
<!-- CSS | Preloader Styles -->
<link href="<?php echo base_url();?>assets/css/preloader.css" rel="stylesheet" type="text/css">
<!-- CSS | Custom Margin Padding Collection -->
<link href="<?php echo base_url();?>assets/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
<!-- CSS | Responsive media queries -->
<link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css">
<!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
<!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->

<!-- Revolution Slider 5.x CSS settings -->
<link  href="<?php echo base_url();?>assets/js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
<link  href="<?php echo base_url();?>assets/js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
<link  href="<?php echo base_url();?>assets/js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>

<!-- CSS | Theme Color -->
<link href="<?php echo base_url();?>assets/css/colors/theme-skin-color-set-1.css" rel="stylesheet" type="text/css">

<!-- external javascripts -->
<script src="<?php echo base_url();?>assets/js/jquery-2.2.4.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<!-- JS | jquery plugin collection for this theme -->
<script src="<?php echo base_url();?>assets/js/jquery-plugin-collection.js"></script>

<!-- Revolution Slider 5.x SCRIPTS -->
<script src="<?php echo base_url();?>assets/js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  
<![endif]-->
<script type="text/javascript">
    var assetPath = "<?php echo base_url('assets'); ?>";
</script>
</head>
<body class="">
<div id="wrapper" class="clearfix">
  <!-- preloader -->
  <div id="preloader">
    <div id="spinner">
      <div class="preloader-dot-loading">
        <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
      </div>
    </div>
    <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
  </div> 
  
  <!-- Header -->
  <header id="header" class="header">
    <div class="header-top bg-theme-color-2 sm-text-center p-0">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="widget no-border m-0">
              <ul class="list-inline font-13 sm-text-center mt-5">
                <li>
                  <a class="text-white" href="<?php echo base_url();?>main/faq">FAQ</a>
                </li>
                <li class="text-white">|</li>
                <li>
                  <a class="text-white" href="<?php echo base_url();?>main/login">Login</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-8">
            <div class="widget m-0 pull-right sm-pull-none sm-text-center">
              <ul class="list-inline pull-right">
                <li class="mb-0 pb-0">
                  
                </li>
                <li class="mb-0 pb-0">
                  <div class="top-dropdown-outer pt-5 pb-10">
                    <a class="top-search-box has-dropdown text-white text-hover-theme-colored"><i class="fa fa-search font-13"></i> &nbsp;</a>
                    <ul class="dropdown">
                      <li>
                        <div class="search-form-wrapper">
                          <form method="get" class="mt-10">
                            <input type="text" onfocus="if(this.value =='Enter your search') { this.value = ''; }" onblur="if(this.value == '') { this.value ='Enter your search'; }" value="Enter your search" id="searchinput" name="s" class="">
                            <label><input type="submit" name="submit" value=""></label>
                          </form>
                        </div>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
            <div class="widget no-border m-0 mr-15 pull-right flip sm-pull-none sm-text-center">
              <ul class="styled-icons icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
                <li><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus text-white"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram text-white"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-middle p-0 bg-lightest xs-text-center">
      <div class="container pt-0 pb-0">
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-5">
            <div class="widget no-border m-0">
              <a class="menuzord-brand pull-left flip xs-pull-center mb-15" href="javascript:void(0)"><img src="<?php echo base_url();?>assets/images/logo-ppatk.png" alt=""></a>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
           <!--  <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
              <ul class="list-inline">
                <li><i class="fa fa-phone-square text-theme-colored font-36 mt-5 sm-display-block"></i></li>
                <li>
                  <a href="#" class="font-12 text-gray text-uppercase">Call us today!</a>
                  <h5 class="font-14 m-0"> +(012) 345 6789</h5>
                </li>
              </ul>
            </div> -->
          </div>  
         <!--  <div class="col-xs-12 col-sm-4 col-md-3">
            <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
              <ul class="list-inline">
                <li><i class="fa fa-clock-o text-theme-colored font-36 mt-5 sm-display-block"></i></li>
                <li>
                  <a href="#" class="font-12 text-gray text-uppercase">We are open!</a>
                  <h5 class="font-13 text-black m-0"> Mon-Fri 8:00-16:00</h5>
                </li>
              </ul>
            </div>
          </div> -->
        </div>
      </div>
    </div>
    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored border-bottom-theme-color-2-1px">
        <div class="container">
          <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive">
            <ul class="menuzord-menu">
              <li class="active"><a href="<?php echo base_url();?>main/home">Beranda</a> </li>

              <li><a href="">Profil </a>
                <ul class="dropdown">
                   <li><a href="<?php echo base_url();?>main/profil">Tentang PPATK</a></li>
                   <li><a href="<?php echo base_url();?>main/gallery">Gallery</a></li>
                </ul>
              </li>
              <li><a href="#">Program Diklat</a>
                <ul class="dropdown">
                  <li><a href="<?php echo base_url();?>main/program_diklat">Program Diklat PPATK</a></li>
                  <li><a href="<?php echo base_url();?>main/modul_diklat">Modul Diklat</a></li>
                  <li><a href="<?php echo base_url();?>main/kalender_diklat">Kalender Diklat</a></li>
                  <li><a href="<?php echo base_url();?>main/sertifikasi">Sertifikasi AML CFT</a>
                    <ul class="dropdown">
                      <li><a href="<?php echo base_url();?>main/jadwal_diklat">Jadwal  </a></li>
                      <li><a href="<?php echo base_url();?>main/calon_peserta_dan_hasil_ujian">Calon Peserta Dan Hasil Ujian</a></li>
                      <li><a href="<?php echo base_url();?>main/pendaftaran_sertifikasi">Pendaftaran</a></li>
                      <li><a href="<?php echo base_url();?>main/contact_person">Contact Person</a></li>
                    </ul>
                  </li> 
                  
                  <li><a href="<?php echo base_url();?>main/alumni"">Alumni</a></li>
                    
                  <li><a href="<?php echo base_url();?>main/login">Member Login</a></li>
                
                </ul>
              </li>
              <li><a href="#">Publikasi </a>
                <ul class="dropdown">
                  <li><a href="<?php echo base_url();?>main/artikel">Artikel</a></li>
                  <li><a href="<?php echo base_url();?>main/jurnal">Jurnal</a></li>
                  <li><a href="<?php echo base_url();?>main/annual_report">Annual Report</a></li>
                  <li><a href="<?php echo base_url();?>main/majalah">Majalah</a></li>
                 </ul>
               </li>
                      
               <li><a href="#">Informasi Publik </a>
                <ul class="dropdown">
                  <li><a href="<?php echo base_url();?>main/informasi_publik">Daftar Informasi Publik</a></li>
                  <li><a href="http://ppid.ppatk.go.id/">PPID</a></li>
                   <li><a href="<?php echo base_url();?>main/lakip">LAKIP</a> </li>
                   <li><a href="#">RKA K/L</a></li>
                   <li><a href="#">Pengadaan Barang Dan Jasa</a>
                    <ul class="dropdown">
                      <li><a href="features-header-style1.html">Pengumuman Pengadaan  </a></li>
                      <li><a href="features-header-style2.html">Pengumuman Pemenang</a></li>
                    </ul>
                  </li>
                   <li><a href="#">Link Terkait</a></li>
                </ul>
              </li>

              <li><a href="#">Layanan</a>
                <ul class="dropdown">
                  <li><a href="http://elearning.ppatk.go.id/">e-Learning</a></li>
                  <li><a href="#">e-Registration</a></li>
                   <li><a href="#">LAKIP</a> </li>
                   <li><a href="#">Digital Library</a></li>
                   <li><a href="http://jdih.ppatk.go.id/">JDIH</a>
                </ul>
              </li>

              <li><a href="<?php echo base_url();?>main/kontak">Kontak</a></li>
         </ul>
            <ul class="pull-right flip hidden-sm hidden-xs">
              <li>
                <!-- Modal: Book Now Starts -->
                <a class="btn btn-colored btn-flat bg-theme-color-2 text-white font-14 bs-modal-ajax-load mt-0 p-25 pr-15 pl-15"  href="<?php echo base_url();?>main/pendaftaran_peserta">Pendaftaran Peserta</a>
                <!-- Modal: Book Now End -->
              </li>
            </ul>
            <div id="top-search-bar" class="collapse">
              <div class="container">
                <form role="search" action="#" class="search_form_top" method="get">
                  <input type="text" placeholder="Type text and press Enter..." name="s" class="form-control" autocomplete="off">
                  <span class="search-close"><i class="fa fa-search"></i></span>
                </form>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>
  
  <!-- Start main-content -->
   <section id="content">
                <div class="container">
                    <?php echo $_content; ?>
                </div>
    </section>

  <!-- Footer -->
  <footer id="footer" class="footer divider layer-overlay overlay-dark-9" data-bg-img="http://placehold.it/1920x1280">
    <div class="container">
      <div class="row border-bottom">
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <img class="mt-5 mb-20" alt="" src="<?php echo base_url();?>assets/images/logo-ppatk.png">
            <p>203, PPATK, Jakarta.</p>
            <ul class="list-inline mt-5">
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">123-456-789</a> </li>
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">contact@yourdomain.com</a> </li>
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">www.yourdomain.com</a> </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h4 class="widget-title">Useful Links</h4>
            <ul class="list angle-double-right list-border">
              <li><a href="<?php echo base_url();?>main/profil">Tentang PPATK</a></li>
              <li><a href="<?php echo base_url();?>main/program_diklat">Program Diklat</a></li>
              <li><a href="<?php echo base_url();?>main/faq">FAQ</a></li>
              <li><a href="<?php echo base_url();?>main/gallery">Gallery</a></li>
                          
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h4 class="widget-title">Twitter Feed</h4>
            <div class="twitter-feed list-border clearfix" data-username="Envato" data-count="2"></div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h4 class="widget-title line-bottom-theme-colored-2">Opening Hours</h4>
            <div class="opening-hours">
              <ul class="list-border">
                <li class="clearfix"> <span> Mon - Tues :  </span>
                  <div class="value pull-right"> 6.00 am - 10.00 pm </div>
                </li>
                <li class="clearfix"> <span> Wednes - Thurs :</span>
                  <div class="value pull-right"> 8.00 am - 6.00 pm </div>
                </li>
                <li class="clearfix"> <span> Fri : </span>
                  <div class="value pull-right"> 3.00 pm - 8.00 pm </div>
                </li>
                <li class="clearfix"> <span> Sun : </span>
                  <div class="value pull-right"> Closed </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-30">
        <div class="col-md-2">
          <div class="widget dark">
            <h5 class="widget-title mb-10">Call Us Now</h5>
            <div class="text-gray">
              +61 3 1234 5678 <br>
              +12 3 1234 5678
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="widget dark">
            <h5 class="widget-title mb-10">Connect With Us</h5>
            <ul class="styled-icons icon-bordered icon-sm">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-skype"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-5 col-md-offset-2">
          <div class="widget dark">
            <h5 class="widget-title mb-10">Subscribe Us</h5>
            <!-- Mailchimp Subscription Form Starts Here -->
            <form id="mailchimp-subscription-form-footer" class="newsletter-form">
              <div class="input-group">
                <input type="email" value="" name="EMAIL" placeholder="Your Email" class="form-control input-lg font-16" data-height="45px" id="mce-EMAIL-footer">
                <span class="input-group-btn">
                  <button data-height="45px" class="btn bg-theme-color-2 text-white btn-xs m-0 font-14" type="submit">Subscribe</button>
                </span>
              </div>
            </form>
            <!-- Mailchimp Subscription Form Validation-->
            <script type="text/javascript">
              $('#mailchimp-subscription-form-footer').ajaxChimp({
                  callback: mailChimpCallBack,
                  url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
              });

              function mailChimpCallBack(resp) {
                  // Hide any previous response text
                  var $mailchimpform = $('#mailchimp-subscription-form-footer'),
                      $response = '';
                  $mailchimpform.children(".alert").remove();
                  if (resp.result === 'success') {
                      $response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                  } else if (resp.result === 'error') {
                      $response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                  }
                  $mailchimpform.prepend($response);
              }
            </script>
            <!-- Mailchimp Subscription Form Ends Here -->
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom bg-black-333">
      <div class="container pt-20 pb-20">
        <div class="row">
          <div class="col-md-6">
            <p class="font-11 text-black-777 m-0">Copyright &copy;2016 ThemeMascot. All Rights Reserved</p>
          </div>
          <div class="col-md-6 text-right">
            <div class="widget no-border m-0">
              <ul class="list-inline sm-text-center mt-5 font-12">
                <li>
                  <a href="<?php echo base_url();?>main/faq">FAQ</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper -->

<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<script src="<?php echo base_url();?>assets/js/custom.js"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
      (Load Extensions only on Local File Systems ! 
       The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>

</body>
</html>