</div> <!--/ .body-section -->
<!-- ********************   Removing powered by linkback will result to cancellation of your support service.    ********************  -->
<div class="hidden-xs hidden-sm" style="padding:10px;background:#dcdcdc;margin-top:36px;">
<div class="container">
    <div class="text-center">
        Powered by <a href="http://www.phptravels.com" target="_blank">
            <img src="<?php echo base_url(); ?>uploads/global/phptravels.png" style="height:22px" height="22" alt="PHPTRAVELS" />
            <strong>PHPTRAVELS</strong></a>
    </div>
</div>
</div>
<!-- ********************   Removing powered by linkback will result to cancellation of your support service.    ********************  -->

<?php if($mSettings->mobileSectionStatus == "Yes"){  ?>
<section class="app-bg mobside visible-lg">
    <div class="container">
        <div class="col-md-4 fr">
            <img class="img-responsive" src="assets/img/apps.png">
        </div>
        <div class="col-md-8 fr tr">
            <h3><?php echo trans('0386'); ?></h3>
            <h5><?php echo trans('0387'); ?></h5>
            <div class="buttons">
                <div class="mdl-cell mdl-cell--12-col">
                    <?php if(!empty($mSettings->iosUrl)){ ?>
                    <a href="<?php echo $mSettings->iosUrl; ?>" target="_blank" class="footer__downloadButton">
                        <span class="footer__appIcon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="22" viewBox="0 0 19 22">
                                <path fill="#FFF" fill-rule="evenodd" d="M13.42 4.74c2.46 0 4.032 2.38 4.032 2.38s-2.4 1.303-2.4 4.13c0 3.357 3.015 4.334 3.015 4.334s-2.38 5.645-5.05 5.645c-1.503 0-1.604-.866-3.6-.866-1.734 0-2.32.864-3.64.864C3.257 21.23 0 15.725 0 11.25c0-4.648 3.297-6.51 5.364-6.51 1.815 0 2.57 1.07 4.032 1.07 1.23 0 2.2-1.07 4.023-1.07zM12.995 0c.363 2.28-1.704 5.097-4.174 5.005C8.46 2.105 11.12.153 12.996 0z"></path>
                            </svg>
                        </span>
                        <span class="footer__appText">
                        Download on the
                        <span class="footer__appStoreName">App Store</span>
                        </span>
                    </a>
                    <?php } ?>
                    <!--<a href="javascript:void(0)" class="footer__downloadButton">
                        <span class="footer__appIcon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="24" viewBox="0 0 21 24"><path fill="#FFF" fill-rule="evenodd" d="M9.66 2.227c.04.173.062.383.066.63-.886.384-1.227.658-1.212 1.97v.806l-.607.123v-.932c0-1.936.74-2.24 1.754-2.597zm1.767-.415c.04.188.072.393.094.61 1.59-.227 1.558.428 1.558 1.794v.505l.6-.12v-.383c0-2.122-.33-2.69-2.25-2.404zm-6.255 4.49v-2.79c-.02-1.73.873-2.26 2.522-2.647 2.484-.582 2.642 1.02 2.642 2.038V5.27l.608-.123v-2.19c-.006-1.93-.607-3.373-3.37-2.746-1.49.34-3.01.72-3.01 3.246v2.97l.608-.12zm7.276 7.338H7.774v-3.382l4.674-.685v4.067zm0 4.78l-4.674-.684v-3.63h4.674v4.314zm-5.14-4.78H3.6v-2.83l3.708-.524v3.355zm0 4.067L3.6 17.185v-3.078h3.708v3.6zm9.41-12.98L.008 8.067V20.22l16.71 3.342 3.34-1.215V5.942l-3.34-1.216z"></path></svg>
                        </span>
                        <span class="footer__appText">
                                Download from
                                <span class="footer__appStoreName">Windows Store</span>
                        </span>
                        </a>-->
                    <?php if(!empty($mSettings->androidUrl)){ ?>
                    <a href="<?php echo $mSettings->androidUrl; ?>" target="_blank" class="footer__downloadButton">
                        <span class="footer__appIcon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="25" viewBox="0 0 24 25">
                                <defs>
                                    <linearGradient id="a" x1="19.215%" x2="69.302%" y1="-35.157%" y2="93.537%">
                                        <stop offset="0%" stop-color="#19A3B4"></stop>
                                        <stop offset="34.817%" stop-color="#5BC3AF"></stop>
                                        <stop offset="92.234%" stop-color="#C9F7A6"></stop>
                                        <stop offset="100%" stop-color="#D7FEA5"></stop>
                                    </linearGradient>
                                    <path id="b" d="M17.453 8.308L2.697.248C2.28.02 1.893-.032 1.58.065L13.668 12.07l3.786-3.762"></path>
                                    <linearGradient id="c" x1="-14.698%" x2="74.844%" y1="-114.322%" y2="114.156%">
                                        <stop offset="0%" stop-color="#FC227C"></stop>
                                        <stop offset="100%" stop-color="#FEEB7B"></stop>
                                    </linearGradient>
                                    <linearGradient id="d" x1="28.151%" x2="48.188%" y1="-14.814%" y2="82.894%">
                                        <stop offset="0%" stop-color="#0E4DA0"></stop>
                                        <stop offset="100%" stop-color="#6BFED4"></stop>
                                    </linearGradient>
                                    <path id="e" d="M1.58.065C1.13.205.84.655.84 1.34l.004 21.49c0 .675.28 1.12.717 1.268L13.67 12.072 1.58.065"></path>
                                    <linearGradient id="f" x1="132.245%" x2="5.959%" y1="16.466%" y2="126.31%">
                                        <stop offset="0%" stop-color="#FC472E"></stop>
                                        <stop offset=".332%" stop-color="#FC472E"></stop>
                                        <stop offset="100%" stop-color="#893CD8"></stop>
                                    </linearGradient>
                                    <path id="g" d="M1.56 24.098c.315.106.71.056 1.137-.177l14.773-8.07-3.803-3.78L1.56 24.1"></path>
                                </defs>
                                <g fill="none" fill-rule="evenodd">
                                    <use fill="url(#a)" xlink:href="#b"></use>
                                    <path fill="url(#c)" d="M17.472 15.85l5.037-2.75c1.02-.56 1.02-1.47 0-2.03L17.45 8.308l-3.786 3.762 3.805 3.78"></path>
                                    <use fill="url(#d)" xlink:href="#e"></use>
                                    <use fill="url(#f)" xlink:href="#g"></use>
                                </g>
                            </svg>
                        </span>
                        <span class="footer__appText">
                        Get it on
                        <span class="footer__appStoreName">Google Play</span>
                        </span>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<footer id="footer" class="hidden-xs hidden-sm <?php echo @$hidden; ?>">
    <div class="container">
        <div class="col-md-3 grey go-right col-xs-12">
            <?php if(pt_is_module_enabled('newsletter')){ ?>
            <h2 class="go-text-right"><strong><?php echo trans('023');?></strong></h2>
            <div class="col-md-12">
                <div id="message-newsletter_2"></div>
                <form role="search" onsubmit="return false;">
                </form>
                <div class="row">
                    <input type="email" class="form-control fccustom2 sub_email form-group" id="exampleInputEmail1" placeholder="<?php echo trans('023');?> <?php echo trans('0403');?>" required>
                    <div class="clearfix"></div>
                    <button type="submit" class="btn btn-success btn-block sub_newsletter ttu"> <?php echo trans('024');?></button>
                </div>
                <ul class="nav navbar-nav">
                    <li>
                        <a class="newstext" href="javascript:void(0);">
                            <div style="color:white" class="subscriberesponse"></div>
                        </a>
                    </li>
                </ul>
            </div>
            <?php } ?>
        </div>
        <?php get_footer_menu_items(22,"wow fadeIn col-sm-4 col-xs-12 col-md-3 go-right","go-text-right","footerlist go-right go-text-right" );?>
        <?php get_footer_menu_items(19, "wow fadeIn col-sm-4 col-xs-12 col-md-3 go-right","go-text-right","footerlist go-right go-text-right"  );?>
        <?php get_footer_menu_items(25,"wow fadeIn col-sm-4 col-xs-12 col-md-3 go-right","go-text-right","footerlist go-right go-text-right" );?>
        <div class="clearfix"></div>
    </div>
</footer>
<div class="foot hidden-xs hidden-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 text-right footbrand nopadding">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" class="pull-right brand img-responsive"/></a>
            </div>
            <div class="col-md-1 footside"></div>
            <div class="col-3 col-sm-3 col-md-2">
                <img src="<?php echo $theme_url; ?>assets/img/payments.png" class="img-responsive payments" alt="">
            </div>
            <div class="col-md-4">
                <?php if($allowsupplierreg){ ?>
                <div class="col-md-6">
                    <a class="btn btn-warning btn-block" target="_blank" href="<?php echo base_url(); ?>supplier-register/"><?php echo trans('0241');?></a>
                </div>
                <?php } ?>
                <div class="col-md-6">
                    <a class="btn btn-success btn-block" target="_blank" href="<?php echo base_url(); ?>supplier/"><?php echo trans('0527');?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="rightsdiv">
<div class="container hidden-xs hidden-sm">
        <div class="col-md-6">
            <?php foreach($footersocials as $fs){ ?>
            <a href="<?php echo $fs->social_link;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $fs->social_name;?>" target="_blank"><img src="<?php echo PT_SOCIAL_IMAGES; ?><?php echo $fs->social_icon;?>" class="social-icons-footer" /></a>
            <?php } ?>
        </div>
        <div class="col-md-6">
            <p class="copyright text-right"><strong>&copy; <?php echo $app_settings[0]->copyright;?></strong></p>
        </div>
</div>
<!-- tripadvisors block -->
<?php if($tripmodule){ ?>
<div class="footerbg text-center hidden-xs hidden-sm">
    <a class="btn-block" target="_blank" href="//www.tripadvisor.com/pages/terms.html"><img width="200" lass="block-center" src="<?php echo PT_GLOBAL_IMAGES_FOLDER . 'tripadvisor.png';?>" alt="TripAdvisor" /></a>
    <p>Ratings and Reviews Powered by TripAdvisor</p>
</div>
<?php } ?>
<!-- tripadvisors block -->
<div class="hidden-xs hidden-sm gotopDiv">
    <div class="container text-right">
        <a href="javascript:void" class="gotop scroll wow fadeInUp btn btn-default"><i class="icon-up-open-big"></i></a>
    </div>
</div>
</div>
<?php include 'scripts.php'; ?>
</body>
</html>