<?php if(pt_main_module_available('flights')){ ?>
    <section class="flights-home hidden-sm hidden-xs">
        <div class="container">
                <h2 class="destination-title go-text-right ttu">
                    <i class="ti-Line-Airplane"></i> <?php echo trans('013');?> <strong><?php echo trans('0564');?></strong>
                </h2>
            <div class="main_slider">
                <div class="set2 fa-left">
                    <i class="glyphicon-chevron-right icon-angle-left flight-left"></i>
                </div>
                <div class="flights" class="get">
                    <?php foreach($featuredFlights as $item){ ?>
                    <div class="owl-item">
                        <div class="item">
                            <div class="flight-box-styling">
                                <img class="" src="<?php echo $item->thumbnail; ?>">
                                <div class="airline-name">
                                    <?php echo $item->title; ?>
                                </div>
                                <hr class="flightsHR">
                                <div class="flight-price">
                                    <?php echo $item->currCode;?> <strong><?php echo $item->price; ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="set2 fa-right">
                    <i class="glyphicon-chevron-right icon-angle-right flight-right"></i>
                </div>
            </div>
        </div>
    </section>
<?php } ?>