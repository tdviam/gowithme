<style> .modal-backdrop { z-index: 0; } </style>
<form autocomplete="off" name="hotelportSearch" action="<?php echo base_url('travelport_hotels/hotelApi'); ?>" method="GET" role="search">
    <div class="row">
        <div class="go-text-right">
            <div class="col-md-12 form-group go-right col-xs-12">
                <label class="go-right"><?php echo trans('0120'); ?></label>
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-41"></i>
                <input type="text" name="destination" class="widget-select2" required value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="bgfade col-md-6 form-group go-right col-xs-6 focusDateInput">
            <label class="go-right"><?php echo trans('07');?></label>
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" placeholder="<?php echo trans('07'); ?>" name="checkin" value="" class="form input-lg hpcheckin" required>
        </div>
        <div class="bgfade col-md-6 form-group go-right col-xs-6 focusDateInput">
            <label class="go-right"><?php echo trans('09');?></label>
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" placeholder="<?php echo trans('09'); ?>" name="checkout" value="" class="form input-lg hpcheckout">
        </div>
        <div class="go-text-right">
            <div class="col-md-6 form-group go-right col-xs-12">
                <label class="go-right"><?php echo trans('010');?></label>
                <div class="clearfix"></div>
                <select class="form-control fs12" name="adults">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <div class="bgfade col-md-12 col-xs-12">
            <div class="clearfix"></div>
            <button type="submit"  class="btn-danger btn btn-lg btn-block pfb0">
                <i class="icon_set_1_icon-66"></i> <?php echo trans('012'); ?>
            </button>
        </div>
    </div>
</form>

<script>
$(function(){
    $("[name=hotelportSearch] .widget-select2").select2({
        placeholder: "Enter Location",
        minimumInputLength: 3,
        width: '100%',
        maximumSelectionSize: 1,
        ajax:{
            url: '<?php echo base_url('Suggestions/airports'); ?>',
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
    // Checkin time
    var checkin = $('[name=hotelportSearch] .hpcheckin').datepicker({
        format: 'yyyy-mm-dd',
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    })
    .on('changeDate', function(e){
        $(this).datepicker('hide');
        var newDate = new Date(e.date);
        checkout.setValue(newDate.setDate(newDate.getDate() + 1));
        $('[name=hotelportSearch] .hpcheckout').focus();
    }).data('datepicker');

    // Checkout time
    var checkout = $('[name=hotelportSearch] .hpcheckout').datepicker({
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
});
</script>