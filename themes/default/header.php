<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo @$metadescription; ?>">
<meta name="keywords" content="<?php echo @$metakeywords; ?>">
<meta name="author" content="PHPTRAVELS">
<title><?php echo @$pageTitle; ?></title>
<link rel="shortcut icon" href="<?php echo PT_GLOBAL_IMAGES_FOLDER.'favicon.png';?>">
<link href="<?php echo $theme_url; ?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo $theme_url; ?>style.css" rel="stylesheet">
<link href="<?php echo $theme_url; ?>assets/css/navigation.css" rel="stylesheet">
<!--<link href="<?php echo $theme_url; ?>eder.css" rel="stylesheet"> -->
<link href="<?php echo $theme_url; ?>assets/css/mobile.css" rel="stylesheet" media="screen">
<!-- facebook --> <meta property="og:title" content="<?php echo @$pageTitle; ?>"/> <meta property="og:site_name" content="<?php echo $app_settings[0]->site_title;?>"/> <meta property="og:description" content="<?php if($app_settings[0]->seo_status == "1"){echo $metadescription;}?>"/> <meta property="og:image" content="<?php echo base_url(); ?>uploads/global/favicon.png"/>  <meta property="og:url" content="<?php echo $app_settings[0]->site_url;?>/"/> <meta property="og:publisher" content="https://www.facebook.com/<?php echo $app_settings[0]->site_title;?>"/> <script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"<?php echo $app_settings[0]->site_title;?>","url":"<?php echo $app_settings[0]->site_url;?>/","logo":"<?php echo base_url(); ?>uploads/global/favicon.png","sameAs":"https://www.facebook.com/<?php echo $app_settings[0]->site_title;?>","sameAs":"https://twitter.com/<?php echo $app_settings[0]->site_title;?>","sameAs":"https://www.pinterest.com/<?php echo $app_settings[0]->site_title;?>/","sameAs":"https://plus.google.com/u/0/<?php echo $app_settings[0]->site_title;?>/posts","contactPoint":{"@type":"ContactPoint","telephone":"<?php echo $phone; ?>","contactType":"Customer Service"}}{"@context":"http://schema.org","@type":"WebSite","name":"<?php echo $app_settings[0]->site_title;?>","url":"<?php echo $app_settings[0]->site_url;?>"}  </script>
<!-- Child Theme --> <style> @import "<?php echo $theme_url; ?>assets/css/childstyle.css"; </style>
<!-- Google Maps --> <?php if (pt_main_module_available('ean') || $loadMap) { ?> <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=<?php echo $app_settings[0]->mapApi; ?>&libraries=places"></script> <script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script><?php } ?>
<!-- jQuery --> <script src="<?php echo $theme_url; ?>assets/js/jquery-1.11.2.min.js"></script>
<!-- RTL CSS --> <?php if($isRTL == "RTL"){ ?> <link href="<?php echo $theme_url; ?>RTL.css" rel="stylesheet"> <?php } ?>
<!-- Mobile Redirect --> <?php if($mSettings->mobileRedirectStatus == "Yes"){ if($ishome != "invoice"){ ?> <script>if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){ window.location ="<?php echo $mSettings->mobileRedirectUrl; ?>";}</script> <?php } } ?>
<!--[if lt IE 7] > <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>assets/css/font-awesome-ie7.css" media="screen" /> <![endif]-->
<!-- Autocomplete CSS files-->
<link href="<?php echo $theme_url; ?>assets/js/autocomplete/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
<!-- Autocomplete CSS files-->
<!-- Autocomplete JS files-->
<script src="<?php echo $theme_url; ?>assets/js/autocomplete/jquery.easy-autocomplete.min.js" type="text/javascript" ></script>
<!-- Autocomplete JS files-->
<script>var base_url = '<?php echo base_url(); ?>';</script>
<?php echo $app_settings[0]->google; ?>
</head>
<body>
    <div id="preloader" class="loader-wrapper">
    <div class="progress">
     <div class="indeterminate"></div>
    </div>
    <!--
    <div style="margin-top:-120px">
    <h4 class="text-center"><?php echo trans('0555');?> <strong><?php echo $app_settings[0]->site_title;?></strong></h4>
    <h5 class="text-center"><?php echo trans('0556');?></h5>
    </div>
   -->
</div>
<div class="modal <?php if($isRTL == "RTL"){ ?> right <?php } else { ?> left <?php } ?> fade" id="sidebar_left" tabindex="1" role="dialog" aria-labelledby="sidebar_left">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close go-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="close icon-angle-<?php if($isRTL == "RTL"){ ?>right<?php } else { ?>left<?php } ?>"></i></span></button>
        <h4 class="modal-title go-text-right" id="sidebar_left"><i class="icon_set_1_icon-65 go-right"></i> <?php echo trans('0296');?></h4>
      </div>
      <?php include 'settings.php'; ?>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div class="tbar-top hidden-sm hidden-xs">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-4 col-xs-7 go-right">
        <div class="contact-box">
          <ul class="hidden-sm hidden-xs">
            <?php if( ! empty($phone) ) { ?>
            <li class="go-right">
              <i class="icon_set_1_icon-55 go-right align-M mrg5-R f-grey66 fs13"></i>
              <span class="contact-no align-M"><?php echo trans('0438');?>: <a href="#tel:<?php echo $phone; ?>" class="number"><?php echo $phone; ?></a></span>
            </li>
            <?php } ?>
            <?php if( ! empty($contactemail) ) { ?>
            <li class="go-right">
              <span class="sep go-right">|</span>
              <span class="tp-mail"><a title="Mail" href="mailto:<?php echo $contactemail; ?>"><?php echo $contactemail; ?></a></span>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="col-md-6 col-sm-8 col-xs-5 go-left">
        <?php include 'settings.php'; ?>
      </div>
    </div>
  </div>
</div>
<div class="navbar navbar-static-top navbar-default <?php echo @$hidden; ?> hidden-lg hidden-md">
  <div class="container">
    <div class="navbar">
      <!-- Navigation-->
      <div class="navbar-header">
        <button data-toggle="modal" data-target="#sidebar_left" class="navbar-toggle go-left" type="button" style="margin-top: 30px;">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a href="<?php echo base_url(); ?>" class="navbar-brand go-right loader"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" alt="<?php echo $app_settings[0]->site_title;?>" class="logo"/></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right currency_btn"  style="padding-top: 20px;">
          <?php include 'settings.php'; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="tbar-bottom hidden-xs hidden-sm">
  <div class="container">
    <div class="row">
      <div class="col-xs-2 visible-xs pos-rel">
      </div>
      <div class="col-md-4 col-sm-3 col-xs-7 go-right">
        <a href="<?php echo base_url(); ?>" class="navbar-brand go-right loader"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" alt="<?php echo $app_settings[0]->site_title;?>" class="logo"/></a>
      </div>
      <div class="col-md-8 col-sm-9 hidden-xs go-left">
        <nav id="offcanvas-menu">
          <ul class="main-menu go-left RTL">
            <?php foreach($modulesList as $module): ?>
              <?php if(pt_main_module_available($module->module_name) || module_status_check($module->module_name) || pt_module_has_enable($module->module_name)): ?>
              <li class="main-lnk">
                <a class="loader" href="<?php echo base_url($module->module_uri); ?>" title="<?=$module->module_display_name?>">
                  <span class="nav-icon hidden-xs"><img src="<?php echo $theme_url; ?>assets/img/icons/<?=$module->module_icon?>"></span>
                  <span><?php echo trans($module->module_display_name); ?></span>
                </a>
              </li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="color_line"></div>
<div id="body-section">