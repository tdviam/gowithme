<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class HotelApi extends MX_Controller
{
    public $cacheResponse;

    public function __construct()
    {
        parent :: __construct();
        ini_set('display_errors', 1);
		// $chk = modules::run('Home/is_main_module_enabled', 'travelport_hotel');
		// if ( ! $chk ) { Module_404(); }
		// For contact detail display in header.
		$this->data['phone'] = $this->load->get_var('phone');
		$this->data['contactemail'] = $this->load->get_var('contactemail');
		$this->data['usersession'] = $this->session->userdata('pt_logged_customer');
		$this->data['appModule'] = "travelport_hotel";
		$languageid = $this->uri->segment(2);
		$this->validlang = pt_isValid_language($languageid);
		if( $this->validlang ) {
			$this->data['lang_set'] =  $languageid;
		} else {
			$this->data['lang_set'] = $this->session->userdata('set_lang');
		}
		$defaultlang = pt_get_default_language();
		if ( empty($this->data['lang_set']) ) {
			$this->data['lang_set'] = $defaultlang;
		}
		// For menu `HOME` and `My Account` link in header.
		$this->lang->load("front", $this->data['lang_set']);
		$user_id = $this->session->userdata('pt_logged_customer');
        $this->data['userAuthorization'] = (isset($user_id) && ! empty($user_id)) ? 1 : 0;
		$this->data['pageTitle'] = "Hotels List";

		$this->load->library('HotelApiClient');
        $this->data['facilities'] = $this->HotelApiClient->getAmenities();
        $this->cacheResponse = FALSE;
    }

    public function index()
    {
        $_SESSION['destination'] = $this->input->get('destination', true)?$this->input->get('destination',true):$_SESSION['destination'];
        $_SESSION['rooms'] = 1; // $this->input->get('rooms', true)?$this->input->get('rooms',true):$_SESSION['rooms'];
        $_SESSION['adults'] = $this->input->get('adults', true)?$this->input->get('adults',true):$_SESSION['adults'];
        $_SESSION['provider'] = 'TRM';
        $_SESSION['checkinDate'] = $this->input->get('checkin', true)?$this->input->get('checkin',true):$_SESSION['checkinDate'];
        $_SESSION['checkoutDate'] = $this->input->get('checkout', true)?$this->input->get('checkout',true):$_SESSION['checkoutDate'];
        try {
            $request = new HotelSearch();
            $request->setHotelSearchLocation($_SESSION['destination']);
            /**
             * For testing select PostPay as a HotelPaymentType.
             * https://support.travelport.com/webhelp/uapi/uAPI.htm#Hotel/Hotel_TRM/TRM%20Testing.htm#BestPractices%3FTocPath%3DHotel%7CTravelport%2520Rooms%2520and%2520More%2520via%2520Universal%2520API%7CTesting%7C_____2
             * setHotelSearchModifiers(rooms, adults, provider, HotelPaymentType)
             */
			$request->setHotelSearchModifiers($_SESSION['rooms'], $_SESSION['adults'], $_SESSION['provider']);
            $request->setHotelStay($_SESSION['checkinDate'], $_SESSION['checkoutDate']);
            $this->data['hotels'] = $this->HotelApiClient->callApi($request, $this->cacheResponse);
            $this->theme->view('integrations/travelport_hotels/index', $this->data, $this);
        } catch(SoapFault $e) {
            echo $e->getMessage();
        }
	}
    
    /**
     * Address (Both)
     * Phone (Both) 
     * Name (Both)
     * HotelRating (TRM)
     * Gallery (TRM, 1G(In seperate call))
     * Mape (TRM)
     * Description (TRM)
     */
	public function detail()
    {
        try {
            $_SESSION['hotelCode'] = $this->input->post('hotelCode',true);
            $_SESSION['hotelChain'] = $this->input->post('hotelChain',true);
            $_SESSION['RateSupplier'] = $this->input->post('RateSupplier',true);
            $_SESSION['HostToken'] = $this->input->post('HostToken',true);
            $request = new HotelDetails();
            $request->setHotelProperty($_SESSION['hotelChain'], $_SESSION['hotelCode']);
            $request->setHotelDetailsModifiers($_SESSION['rooms'], $_SESSION['adults'], $_SESSION['checkinDate'], $_SESSION['checkoutDate'], $_SESSION['provider']);
            $request->setPermittedAggregators($_SESSION['RateSupplier']);
            $request->setBookingGuestInformation($_SESSION['rooms'], $_SESSION['adults']);
            $request->setHostToken($_SESSION['HostToken']);
            $this->data['hotelDetail'] = $this->HotelApiClient->callApi($request, $this->cacheResponse);
            $hotelSearchRsp = $this->HotelApiClient->readFromCache('HotelSearch');
            $hotelSearchObj = array_filter($hotelSearchRsp->HotelSearchResult, function($hotel) {
                $hotelCode = ($_SESSION['hotelCode'])?$_SESSION['hotelCode']:$this->data['hotelDetail']->AggregatorHotelDetails->HotelProperty->HotelCode;
                return ($hotel->HotelProperty->HotelCode == $hotelCode);
            });
            $this->data['hotelSearch'] = current($hotelSearchObj);
            $this->theme->view('integrations/travelport_hotels/detail'.'_'.$_SESSION['provider'], $this->data, $this);
        } catch(SoapFault $e) {
            echo $e->getMessage();
        }
    }

    public function rateAndRule()
    {
        try {
            $_SESSION['checkinDate'] = ($this->input->get('checkin', true))?$this->input->get('checkin',true):$_SESSION['checkin'];
            $_SESSION['checkoutDate'] = ($this->input->get('checkout', true))?$this->input->get('checkout',true):$_SESSION['checkout'];
            $_SESSION['adults'] = ($this->input->get('adults', true))?$this->input->get('adults',true):$_SESSION['adults'];
            $request = new HotelDetails();
            $request->setHotelProperty($_SESSION['hotelChain'], $_SESSION['hotelCode']);
            $request->setHotelDetailsModifiers($_SESSION['rooms'], $_SESSION['adults'], $_SESSION['checkinDate'], $_SESSION['checkoutDate'], $_SESSION['provider']);
            $request->setPermittedAggregators($_SESSION['RateSupplier']);
            $request->setBookingGuestInformation($_SESSION['rooms'], $_SESSION['adults']);
            $request->setHostToken($_SESSION['HostToken']);
            $this->data['hotelDetail'] = $this->HotelApiClient->callApi($request, $this->cacheResponse);
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'body' => $this->theme->partial('integrations/travelport_hotels/hotelRateDetail', $this->data, TRUE)
            ]));
        } catch(SoapFault $e) {
            echo $e->getMessage();
        }
    }
    
    public function reserve()
	{
        $Prefix = 'Mr';
        $First = 'John';
        $Last = 'Smith';
        $Age = '40';
        $DOB = '1978-03-03';
        $Gender = 'M';
        $Nationality = 'US';
        $TravelerType = 'ADT';
        $Location = 'DEN';
        $CountryCode = '1';
        $AreaCode = '303';
        $PhoneNumber = '123456789';
        $EmailID = 'johnsmith@travelportuniversalapidemo.com';
        $AddressName = 'DemoSiteAddress';
        $Street = 'Via Augusta 59 5';
        $City = 'Madrid';
        $State = 'IA';
        $PostalCode = '50156';
        $Country = 'US';
        $RatePlanType = $this->input->post('RatePlanType');
        $GuaranteeType = $this->input->post('GuaranteeType');
        $CardType = 'CA';
        $CardNumber = '5412675985890474';
        $ExpDate = '2018-12';
        $CVV = '900';
        $TotalAmount = '';

        $request = new HotelReservation();
        $request->ProviderCode = $_SESSION['provider'];
        $request->setBookingTraveler($Age, $DOB, $Gender, $Nationality, $TravelerType);
        $request->setBookingTravelerName($Prefix, $First, $Last);
        $request->setPhoneNumber($Location, $CountryCode, $AreaCode, $PhoneNumber);
        $request->setEmail($EmailID);
        $request->setAddress($AddressName, $Street, $City, $State, $PostalCode, $Country);
        $request->setHotelRateDetail($RatePlanType, $TotalAmount);
        $request->setHotelProperty($_SESSION['hotelChain'], $_SESSION['hotelCode']);
        $request->setHotelStay($_SESSION['checkinDate'], $_SESSION['checkoutDate']);
        $request->setGuarantee($GuaranteeType, $CardType, $CardNumber, $ExpDate, $CVV);
        $request->setGuestInformation($_SESSION['rooms'], $_SESSION['adults']);
        $request->setHostToken($_SESSION['HostToken']);
        $bookingConfirmation = $this->HotelApiClient->callApi($request);
        print_r($bookingConfirmation);
		try {
            
        } catch(SoapFault $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Seperate request for gallery
     * Provider: 1G
     */
    public function mediaLinks()
    {
        $request = new HotelMediaLinks();
        $request->setHotelProperty('ES', '77511');
        $hotelMedia = $this->HotelApiClient->callApi($request, TRUE);
        // if(array_key_exists('MediaItem', $hotelMedia->HotelPropertyWithMediaItems)) {
        // 	$this->data['hotelMedia'] = $hotelMedia->HotelPropertyWithMediaItems->MediaItem;
        // } else {
        // 	$this->data['hotelMedia'] = NULL;
        // }
        print_r($hotelMedia);
    }
}