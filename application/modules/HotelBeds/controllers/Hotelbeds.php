<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

include_once __DIR__ . "/../Libraries/Exceptions/HotelException.php";

/**
 *  Module Controller
 */
class Hotelbeds extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('HotelbedsLib');
        // $chk = modules::run('Home/is_main_module_enabled', 'Travelpayoutshotels');
        // if (!$chk) {
        //   Error_404($this);
        // }
        $this->data['lang_set'] = $this->session->userdata('set_lang');
        $this->data['phone'] = $this->load->get_var('phone');
        $this->data['contactemail'] = $this->load->get_var('contactemail');
        $defaultlang = pt_get_default_language();
        if (empty($this->data['lang_set'])) {
          $this->data['lang_set'] = $defaultlang;
        }
        $this->lang->load("front", $this->data['lang_set']);

        // Filters
        $this->dbhb = $this->load->database('hotelbeds', TRUE);
        $this->data['facilities'] = $this->dbhb->get('facilities')->result();
        $this->data['accommodations'] = $this->dbhb->get('accommodations')->result();
    }

    public function index() 
    {
        $stay = new StdClass();
        $stay->checkIn = date('Y-m-d');
        $stay->checkOut = date('Y-m-d', strtotime('+1 Days'));

        $occupancies = new StdClass();
        $occupancies->rooms = 1;
        $occupancies->adults = 2;
        $occupancies->children = 0;

        $availabilityReq = new AvailabilityReq();
        $availabilityReq->stay = $stay;
        $availabilityReq->occupancies = [$occupancies];
        $availabilityReq->hotels = ['hotel' => [
            1067,1070,1075,135813,145214,1506,1508,1526,
            1533,1539,1550,161032,170542,182125,187939,
            212167,215417,228671,229318,23476
        ]];
        // Al Ain
        // $availabilityReq->destination = [
        //     'code' => 'AAN'
        // ];

        try {
            $hotel = new HotelbedsLib();
            $availabilityResp = $hotel->availability($availabilityReq);
            $this->data['hotels'] = $availabilityResp->get_hotels();
            $this->theme->view('integrations/hotelbeds/listing', $this->data, $this);
        } catch (HotelException $e) {
            echo $e->getMessage();
        }
    }

    public function search($filter = NULL)
    {
        $availabilityReq = new AvailabilityReq();
        $availabilityReq->filter = $filter;
        if( ! empty($filter) )
        {
             list($minRate, $maxRate) = explode(',', $this->input->get('price'));
             $filter = new StdClass();
             $filter->minRate = $minRate;
             $filter->maxRate = $maxRate;
             $review = new StdClass();
             $review->type = 'TRIPADVISOR';
             $review->maxRate = '5';
             $review->minReviewCount = '3';
             $filter->reviews = [$review];
        }
        $stay = new StdClass();
        $stay->checkIn = $this->input->get('checkin');
        $stay->checkOut = $this->input->get('checkout');

        $occupancies = new StdClass();
        $occupancies->rooms = 1;
        $occupancies->adults = $this->input->get('adult');
        $occupancies->children = $this->input->get('children');

        $availabilityReq->stay = $stay;
        $availabilityReq->occupancies = [$occupancies];
//        $availabilityReq->hotels = [
//            'hotel' => [$this->input->get('destination')]
//        ];
        $availabilityReq->destination = [
            'code' => $this->input->get('destination')
        ];

        try {
            $hotel = new HotelbedsLib();
            $availabilityResp = $hotel->availability($availabilityReq);
            $this->data['hotels'] = $availabilityResp->get_hotels();
            $this->data['input'] = (object) $this->input->get();
            $this->theme->view('integrations/hotelbeds/listing', $this->data, $this);
        } catch (HotelException $e) {
            echo $e->getMessage();
        }
    }
}