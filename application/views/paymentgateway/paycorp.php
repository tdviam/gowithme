<form action="<?php echo $initResponse->getPaymentPageUrl(); ?>">
    <input type="hidden" name="reqid" value="<?php echo $initResponse->getReqid(); ?>">
    <button type="submit">Pay</button>
</form>