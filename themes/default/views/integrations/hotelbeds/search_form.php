<?php 
    // $requestType = $travelportSearchFormData['requestType']; // Ajax or PHP
    $query = new StdClass();
    $query->triptype = 'oneway';
    $query->cabinclass = 'economy';
    $query->origin = ""; // requestType->default_origin;
    $query->destination = ""; // $travelportSearchFormData['configuration']->default_destination;
?>
<form autocomplete="off" name="hotelbedsSearch" action="<?php echo base_url('hotelbeds/hotelbeds/search'); ?>" method="GET" role="search">
    <div class="col-md-12 col-xs-12 go-text-right form-group">
        <div class="row">
            <label class="go-right"><?php echo trans('0254'); ?></label>
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-41"></i>
            <input type="text" name="destination" id="location" class="form input-lg RTL" placeholder="<?php echo trans('026'); ?>" required />
        </div>
    </div>
    <div class="row">
        <div class="bgfade col-md-6 form-group go-right col-xs-6 focusDateInput">
            <label class="go-right"><?php echo trans('07');?></label>
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" name="checkin" placeholder="<?php echo trans('07'); ?>" class="form input-lg checkin" value="" required />
        </div>
        <div id="dpd2" class="bgfade col-md-6 form-group go-right col-xs-6 focusDateInput">
            <label class="go-right"><?php echo trans('09');?></label>
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" name="checkout" placeholder="<?php echo trans('09'); ?>" class="form input-lg checkout" value="" required />
        </div>
        <div class="col-md-6 form-group go-right col-xs-12">
            <label class="go-right"><?php echo trans('010'); ?></label>
            <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-70"></i>
            <div class="clearfix"></div>
            <select name="adult" class="form input-lg">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="col-md-6 form-group go-right col-xs-12">
            <label class="go-right"><?php echo trans('011'); ?></label>
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-70"></i>
            <div class="clearfix"></div>
            <select name="children" class="form input-lg">
                <option selected>0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="bgfade col-md-12 col-xs-12">
            <div class="clearfix"></div>
            <button type="submit" class="btn-danger btn btn-lg btn-block pfb0 loader"><i class="icon_set_1_icon-66"></i> <?php echo trans('012'); ?></button>
        </div>
    </div>
</form>

<script>
    // First, checks if it isn't implemented yet.
    if (!String.prototype.format) {
        String.prototype.format = function() {
            var args = arguments;
            return this.replace(/{(\d+)}/g, function(match, number) {
                return typeof args[number] != 'undefined' ? args[number] : match;
            });
        };
    }

    $(function(){
        var adult = parseInt($("[name='adult']").val());
        var children = parseInt($("[name='children']").val());

        $("#location").select2({
            placeholder: "Enter Location",
            minimumInputLength: 3,
            width: '100%',
            maximumSelectionSize: 1,
            ajax:{
                url: '<?php echo base_url('Suggestions/hotels'); ?>',
                dataType: 'json',
                data: function(term, page) {
                    return {
                        q: term
                    }
                },
                results: function(data, page) {
                    return {
                        results: data
                    }
                }
            },
            initSelection : function (element, callback) {
                var elementText = $(element).val();
                callback({"text": elementText, "id": elementText});
            }
        });

        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        // Depature time
        var checkin = $('.checkin').datepicker({
            format: 'yyyy-mm-dd',
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        })
        .on('changeDate', function(e){
            $(this).datepicker('hide');
            if (triptype == 'round') {
                var newDate = new Date(e.date);
                checkout.setValue(newDate.setDate(newDate.getDate() + 1));
                $('.checkout').focus();
            }
        }).data('datepicker');

        // Arrival time
        var checkout = $('.checkout').datepicker({
                format: 'yyyy-mm-dd',
                onRender: function(date) {
                    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                }
        }).on('changeDate', function(){
                $(this).datepicker('hide');
        }).data('datepicker');

        // Default fill up date
        if(checkin.element.val()) {
            checkin.setValue(checkin.element.val());
        }
        if(checkout.element.val()) {
            checkout.setValue(checkout.element.val());
        }

        $("[name='adult']").on('change', function() { adult = parseInt($(this).val()); });
        $("[name='children']").on('change', function() { children = parseInt($(this).val()); });
        $("#sumPassenger").on('click', function() {
            totalPassenger = (adult + children + infant);
            $("[name='totalPassenger']").val(totalPassenger);
        });

        $("form[name='hotelbedsSearch']").on('submit', function(e) {
            e.preventDefault();
            var payload = {
                passenger: {
                    adult: adult,
                    children: children
                },
                destination: $(this).find("[name='destination']").val(),
                checkin: $(this).find("[name='checkin']").val(),
                checkout: $(this).find("[name='checkout']").val(),
            };
            
            $('.loader-wrapper').show();
            // $.post(base_url + 'hotelbeds/hotelbeds/search', payload, function(response) {
            //     $('.loader-wrapper').hide();
            //     console.log(response);
            //     // $('#body-section').html(response.body);
            //     // window.history.pushState("", "", get_path('flight/search', payload));
            // });
            window.location.href = base_url + 'hotelbeds/hotelbeds/search?destination='+payload.destination+'&checkin='+payload.checkin+'&checkout='+payload.checkout+'&adult='+payload.passenger.adult+'&children='+payload.passenger.children;
        });
    });
</script>