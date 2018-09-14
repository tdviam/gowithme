<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'SericeController.php';
include_once 'Datatype/AvailabilityReq.php';

class HotelbedsLib extends SericeController {

    public function availability($availabilityReq)
    {
        $resp = $this->service($availabilityReq);
        return $resp;
    }

    public function checkrate()
    {
        $resp = $this->service('checkrates');
        return $resp;
    }

    public function booking()
    {
        $resp = $this->service('bookings');
        return $resp;
    }

    /**
     * API health test
     */
    public function status()
    {
        $resp = $this->service('status');
        var_dump($resp);
    }
}