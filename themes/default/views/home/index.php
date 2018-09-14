<?php require $themeurl. 'views/home/slider.php';?>

<!--<div class="features hidden-sm hidden-xs">
    <div class="row slidericons">
        <div class="container hidden-xs hidden-sm">
            <div data-wow-duration="0.1s" data-wow-delay="0.9s" class="wow fadeInUp col-md-3">
                <div class="row">
                    <div class="col-md-4 row"> <i data-wow-duration="1s" data-wow-delay="1s" class="homeicons wow fadeInUp icon_set_1_icon-23"></i> </div>
                    <div class="col-md-8">
                        <h4><?php echo trans('0380');?></h4>
                    </div>
                </div>
            </div>
            <div data-wow-duration="0.5s" data-wow-delay="0.9s" class="wow fadeInUp col-md-3">
                <div class="row">
                    <div class="col-md-4"> <i data-wow-duration="1.2s" data-wow-delay="1.2s" class="homeicons wow fadeInUp icon_set_1_icon-94"></i> </div>
                    <div class="col-md-8 row">
                        <h4><?php echo trans('0382');?></h4>
                    </div>
                </div>
            </div>
            <div data-wow-duration="0.9s" data-wow-delay="0.9s" class="wow fadeInUp col-md-3">
                <div class="row">
                    <div class="col-md-4"> <i data-wow-duration="1.3s" data-wow-delay="1.3s" class="homeicons wow fadeInUp icon_set_1_icon-100"></i> </div>
                    <div class="col-md-8 row">
                        <h4><?php echo trans('0381');?></h4>
                    </div>
                </div>
            </div>
            <div data-wow-duration="0.9s" data-wow-delay="0.9s" class="wow fadeInUp col-md-3">
                <div class="row">
                    <div class="col-md-4"> <i data-wow-duration="1.4s" data-wow-delay="1.4s" class="homeicons wow fadeInUp icon_set_1_icon-35"></i> </div>
                    <div class="col-md-8 row">
                        <h4><?php echo trans('0383');?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<div class="clearfix"></div>

<?php if(pt_main_module_available('ean')){ ?>
<div class="featured-back hidden-xs hidden-sm">
    <div class="container">
            <h2 class="destination-title go-right ttu">
                <i class="fa fa-building-o"></i> <?php echo trans('056');?>
            </h2>
        <div class="main_slider">
            <div class="set fa-left hotels-left"> <i class="icon-left-open-3"></i> </div>
            <div class="hotels" class="get">
            <?php foreach($featuredHotelsEan->hotels as $item){ ?>
                <div class="owl-item">
                    <div class="imgLodBg">
            <div class="load"></div>
            <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="<?php echo $item->thumbnail;?>">
            <div class="country-name wow fadeIn">
                <h4 class="ellipsis go-text-right"><?php echo character_limiter($item->title,25);?></h4>
                <p class="go-text-right"><i class="icon-location-6 go-text-right go-right"></i>
                    <?php echo character_limiter($item->location,20);?> &nbsp;
                </p>
            </div>
            <div class="overlay">
                <div class="textCenter">
                    <div class="textMiddle">
                        <a class="loader" href="<?php echo $item->slug;?>">
                        <?php echo trans( '0142');?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
                    <div class="additional-info">
                        <div class="pull-left rating-passive"> <span class="stars"><?php echo $item->stars;?></span> </div>
                        <div class="pull-right"> <i data-toggle="tooltip" title="Price" class="icon-tag-6"></i>
                            <?php if($item->price > 0){ ?> <span class="text-center">
                            <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                            </span>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="set fa-right hotels-right"> <i class="icon-right-open-3"></i> </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if(pt_main_module_available( 'hotels')){ ?>
<div class="featured-back hidden-xs hidden-sm">
    <div class="container">
            <h2 class="destination-title go-right ttu">
                <i class="fa fa-building-o"></i> <?php echo trans('056');?>
            </h2>
        <div class="main_slider">
            <div class="set fa-left hotels-left"> <i class="icon-left-open-3"></i> </div>
            <div class="hotels" class="get">
                <?php foreach($featuredHotels as $item){ ?>
                <div class="owl-item">
                    <div class="imgLodBg">
            <div class="load"></div>
            <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="<?php echo $item->thumbnail;?>">
            <div class="country-name wow fadeIn">
                <h4 class="ellipsis go-text-right"><?php echo character_limiter($item->title,25);?></h4>
                <p class="go-text-right"><i class="icon-location-6 go-text-right go-right"></i>
                    <?php echo character_limiter($item->location,20);?> &nbsp;
                </p>
            </div>
            <div class="overlay">
                <div class="textCenter">
                    <div class="textMiddle">
                        <a class="loader" href="<?php echo $item->slug;?>">
                        <?php echo trans( '0142');?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
                    <div class="additional-info">
                        <div class="pull-left rating-passive"> <span class="stars"><?php echo $item->stars;?></span> </div>
                        <div class="pull-right"> <i data-toggle="tooltip" title="Price" class="icon-tag-6"></i>
                            <?php if($item->price > 0){ ?> <span class="text-center">
                            <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                            </span>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="set fa-right hotels-right"> <i class="icon-right-open-3"></i> </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- flights slider -->
<?php include $themeurl. 'views/includes/flights_slider.php';?>

<?php if(pt_main_module_available( 'tours')){ ?>
<div class="container  hidden-xs hidden-sm">
        <h2 class="destination-title destination-title-home go-text-right ttu">
            <i class="icon_set_1_icon-30"></i> <?php echo trans('0451');?>
        </h2>
    <?php foreach($featuredTours as $item){ ?>
    <div class="col-md-3 owl-item mt25">
        <div class="imgLodBg">
            <div class="load"></div>
            <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="<?php echo $item->thumbnail;?>">
            <div class="country-name wow fadeIn">
                <h4 class="ellipsis go-text-right"><?php echo character_limiter($item->title,25);?></h4>
                <p class="go-text-right"><i class="icon-location-6 go-text-right go-right"></i>
                    <?php echo character_limiter($item->location,20);?> &nbsp;
                </p>
            </div>
            <div class="overlay">
                <div class="textCenter">
                    <div class="textMiddle">
                        <a class="loader" href="<?php echo $item->slug;?>">
                        <?php echo trans( '0142');?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="additional-info">
            <div class="pull-left rating-passive"> <span class="stars"><?php echo $item->stars;?></span> </div>
            <div class="pull-right"> <i data-toggle="tooltip" title="Price" class="icon-tag-6"></i>
                <?php if($item->price > 0){ ?> <span class="text-center">
                <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                </span>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php } ?>
</div>
<?php } ?>




<?php if(pt_main_module_available( 'cars')){ ?>
<div class="container hidden-xs hidden-sm">
        <h2 class="destination-title destination-title-home go-text-right ttu">
            <i class="icon_set_1_icon-21"></i> <?php echo trans('0490');?>
        </h2>
    <?php foreach($featuredCars as $item){ ?>
    <div class="col-md-3 owl-item mt25">
         <div class="imgLodBg">
            <div class="load"></div>
            <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="<?php echo $item->thumbnail;?>">
            <div class="country-name wow fadeIn">
                <h4 class="ellipsis go-text-right"><?php echo character_limiter($item->title,25);?></h4>
                <p class="go-text-right"><i class="icon-location-6 go-text-right go-right"></i>
                    <?php echo character_limiter($item->location,20);?> &nbsp;
                </p>
            </div>
            <div class="overlay">
                <div class="textCenter">
                    <div class="textMiddle">
                        <a class="loader" href="<?php echo $item->slug;?>">
                        <?php echo trans( '0142');?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="additional-info">
            <div class="pull-left rating-passive"> <span class="stars"><?php echo $item->stars;?></span> </div>
            <div class="pull-right"> <i data-toggle="tooltip" title="Price" class="icon-tag-6"></i>
                <?php if($item->price > 0){ ?> <span class="text-center">
                <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                </span>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
</div>
<?php if($offersCount> 0){ ?>
<div class="more hidden-xs hidden-sm">
    <div class="container">
        <div class="row">
            <?php if($offersCount> 0){ ?>
            <?php //foreach($specialoffers as $offer){ ?>
            <div class="col-md-7">
                <?php if($specialoffers[0]->price > 0){ ?> <span class="wow bounce ttu"><?php echo trans('0536');?> <b><?php echo trans('0388');?></b> <small><?php echo $specialoffers[0]->currCode;?></small> <?php echo $specialoffers[0]->currSymbol; ?><?php echo $specialoffers[0]->price;?></span>
                <?php } ?>

                 <div class="imgLodBg">
            <div class="load"></div>
            <a href="<?php echo base_url(); ?>offers">
            <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="<?php echo $specialoffers[0]->thumbnail;?>">
            </a>
            </div>
            </div>
            <div class="col-md-5">
                <h3><strong class="ttu"><?php echo character_limiter($specialoffers[0]->title,30);?></strong></h3>
                <p>
                    <?php echo character_limiter($specialoffers[0]->desc,240);?>
                </p>
                <a href="<?php echo base_url(); ?>offers" class="loader btn btn-primary btn-block p16">
                <?php echo trans( '0297');?>
                </a>
                <?php // } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php if(pt_main_module_available( 'blog')){ if($showOnHomePage !="No" ){ ?>
<div class="container hidden-xs hidden-sm">
        <h2 class="destination-title destination-title-home tr ttu">
            <?php echo trans('0402');?>
        </h2>
    <?php foreach($posts as $p){ ?>
    <div class="col-md-4 owl-item mt25">
     <div class="imgLodBg">
            <div class="load"></div>
            <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="<?php echo $p->thumbnail;?>">
            </div>
            <h4 class="ellipsis bold mb0"><?php echo character_limiter($p->title,25);?></h4>
            <p class="tr">
                <?php echo $p->shortDesc;?> &nbsp;
            </p>
            <a class="btn btn-primary loader btn-block" href="<?php echo $p->slug;?>">
            <?php echo trans( '0286');?>
            </a>
    </div>
    <?php } ?>
</div>
<?php } ?>
<?php } ?>