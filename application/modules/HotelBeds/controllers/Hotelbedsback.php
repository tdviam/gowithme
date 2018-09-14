<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hotelbedsback extends MX_Controller {
    
    const TB_HOTELS = 'hotels';
    const TB_FACILITIES = 'facilities';
    const TB_ACCOMMODATIONS = 'accommodations';
    const TB_FACILITYGROUPS = 'facility_groups';
    const TB_FACILITYTYPOLOGIES = 'facilitytypologies';
    const TB_DESTINATIONS = 'destinations';
    const TB_BOARDS = 'boards';
    const TB_COUNTIRES = 'countries';
    const TB_CATEGORIES = 'categories';
    const TB_CHAINS = 'chains';
    const TB_CURRENCIES = 'currencies';


    public function __construct() 
    {
        // $seturl = $this->uri->segment(3);
        // if ($seturl != "settings") {
        //     $module = $this->getModuleStatus();
        //     if ( ! $module ) { Module_404(); }
        // }

        // $checkingadmin = $this->session->userdata('pt_logged_admin');
        // if (!empty($checkingadmin)) {
        //     $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        // }
        // else {
        //     $this->data['userloggedin'] = $this->session->userdata('pt_logged_agent');
        // }
        // if (empty($this->data['userloggedin'])) {
        //     redirect("admin");
        // }
        // if (!empty($checkingadmin)) {
        //     $this->data['adminsegment'] = "admin";
        // }
        // else {
        //     $this->data['adminsegment'] = "agent";
        // }
        // if ($this->data['adminsegment'] == "admin") {
        //     $chkadmin = modules::run('Admin/validadmin');
        //     if (!$chkadmin) {
        //     redirect('admin');
        //     }
        // }
        // else {
        //     $chkagent = modules::run('agent/validagent');
        //     if (!$chkagent) {
        //     redirect('agent');
        //     }
        // }
        // if (!pt_permissions('Travelpayouts', $this->data['userloggedin'])) {
        //     redirect('admin');
        // }
        // $this->load->helper('settings');
        // // $this->load->model('Travelpayoutshotels/Travelpayoutshotels_model');
        // $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
        // $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
        $this->load->library('HotelbedsStaticContent');
        $this->dbhb = $this->load->database('hotelbeds', TRUE);
    }

    public function getHotels() 
    {
        $hotel = new HotelbedsStaticContent();
        $hotel->hotels();
    }

    public function getDestinations()
    {
        $hotel = new HotelbedsStaticContent();
        $hotel->Destinations();
    }

    public function getBoards()
    {
        $hotel = new HotelbedsStaticContent();
        $hotel->Boards();
    }

    public function getChains()
    {
        $hotel = new HotelbedsStaticContent();
        $hotel->Chains();
    }

    public function getCurrencies()
    {
        $hotel = new HotelbedsStaticContent();
        $hotel->Currencies();
    }

    public function getFacilities()
    {
        $hotel = new HotelbedsStaticContent();
        $hotel->Facilities();
    }

    public function getFacilitytypologies()
    {
        $hotel = new HotelbedsStaticContent();
        $hotel->Facilitytypologies();
    }


    /**
     * Syncing
     */
    public function sync()
    {
        // $this->syncHotels();
        // $this->syncFacilities();
    }

    public function syncHotels()
    {
        $f = fopen(__DIR__ . '/../libraries/ReferenceData/sync-log.txt', 'w');
        fwrite($f, 'syncing start: '. date('H:i:s') . PHP_EOL);

        $batchLimit = 100000;
        $from = 1;
        $to = 1000;
        $step = 1000;
        $running = TRUE;
        $lock = FALSE;
        $data = [];
        while ($running) 
        {
            $file = __DIR__ . sprintf('/../libraries/ReferenceData/hotels-%s-%s.json', $from, $to);
            if ( ! file_exists($file) ) {
                $running = FALSE;
            }
            
            $fr = fopen($file, 'r');
            $dataset = fread($fr, filesize($file));
            fclose($fr);

            if( ! empty($dataset) )
            {
                if( ! $lock ) 
                {
                    // Refresh table
                    $this->dbhb->empty_table($this::TB_HOTELS);
                    $lock = TRUE;
                }

                foreach(json_decode($dataset)->hotels as $hotel) {
                    array_push($data, array(
                        'code' => $hotel->code,
                        'name' => $hotel->name->content,
                        'destinationCode' => $hotel->destinationCode,
                        'description' => $hotel->description->content,
                        'images' => (isset($hotel->images))?json_encode($hotel->images):NULL,
                    ));

                    if(count($data) >= $batchLimit) {
                        fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                        $this->dbhb->insert_batch($this::TB_HOTELS, $data);
                        $data = [];
                    }
                }
            }

            $from = $to + 1;
            $to = $to + $step;
        }

        if(count($data) > 0) {
            fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
            $this->dbhb->insert_batch($this::TB_HOTELS, $data);
        }

        fwrite($f, 'syncing end: '. date('H:i:s') . PHP_EOL);
        fclose($f);
    }

    public function syncAccommodations()
    {
        $batchLimit = 1000;

        $log = fopen(__DIR__ . '/../libraries/ReferenceData/sync-log.txt', 'a');
        fwrite($log, 'syncing start: '. date('H:i:s') . PHP_EOL);

        // Read file
        $file = __DIR__ . '/../libraries/ReferenceData/Accommodations.json';
        if ( ! file_exists($file) ) {
            die('Accommodations file not found');
        }
        
        $fr = fopen($file, 'r');
        $dataset = fread($fr, filesize($file));
        fclose($fr);

        if( ! empty($dataset) )
        {
            // Refresh table
            $this->dbhb->empty_table($this::TB_ACCOMMODATIONS);

            $data = [];
            foreach(json_decode($dataset)->accommodations as $accommodation) {
                array_push($data, array(
                    'code' => $accommodation->code,
                    'description' => $accommodation->typeMultiDescription->content
                ));

                if(count($data) >= $batchLimit) {
                    fwrite($log, 'batch insert: ' . count($data) . PHP_EOL);
                    $this->dbhb->insert_batch($this::TB_ACCOMMODATIONS, $data);
                    $data = [];
                }
            }
            if(count($data) > 0) {
                fwrite($log, 'batch insert: ' . count($data) . PHP_EOL);
                $this->dbhb->insert_batch($this::TB_ACCOMMODATIONS, $data);
            }
        }

        fwrite($log, 'syncing end: '. date('H:i:s') . PHP_EOL);
        fclose($log);
    }

    public function syncFacilityGroups()
    {
        echo 'syncing...';
        $batchLimit = 1000;

        $log = fopen(__DIR__ . '/../libraries/ReferenceData/sync-log.txt', 'a');
        fwrite($log, 'syncing start: '. date('H:i:s') . PHP_EOL);

        // Read file
        $file = __DIR__ . '/../libraries/ReferenceData/FacilityGroups.json';
        if ( ! file_exists($file) ) {
            die('Accommodations file not found');
        }

        $fr = fopen($file, 'r');
        $dataset = fread($fr, filesize($file));
        fclose($fr);

        if( ! empty($dataset) )
        {
            // Refresh table
            $this->dbhb->empty_table($this::TB_FACILITYGROUPS);

            $data = [];
            foreach(json_decode($dataset)->facilityGroups as $facilityGroup) {
                array_push($data, array(
                    'code' => $facilityGroup->code,
                    'description' => $facilityGroup->description->content
                ));

                if(count($data) >= $batchLimit) {
                    fwrite($log, 'batch insert: ' . count($data) . PHP_EOL);
                    $this->dbhb->insert_batch($this::TB_FACILITYGROUPS, $data);
                    $data = [];
                }
            }
            if(count($data) > 0) {
                fwrite($log, 'batch insert: ' . count($data) . PHP_EOL);
                $this->dbhb->insert_batch($this::TB_FACILITYGROUPS, $data);
            }
        }

        fwrite($log, 'syncing end: '. date('H:i:s') . PHP_EOL);
        fclose($log);
    }

    public function syncDestinations()
    {
        $f = fopen(__DIR__ . '/../libraries/ReferenceData/sync-log.txt', 'w');
        fwrite($f, 'syncing start: '. date('H:i:s') . PHP_EOL);

        $batchLimit = 1000;
        $from = 1;
        $to = 1000;
        $step = 1000;
        $running = TRUE;
        $lock = FALSE;
        while ($running)
        {
            $file = __DIR__ . sprintf('/../libraries/ReferenceData/Destinations/%s-%s.json', $from, $to);
            if ( ! file_exists($file) ) {
                $running = FALSE;
            }

            $fr = fopen($file, 'r');
            $dataset = fread($fr, filesize($file));
            fclose($fr);

            if( ! empty($dataset) )
            {
                if( ! $lock )
                {
                    // Refresh table
                    $this->dbhb->empty_table($this::TB_DESTINATIONS);
                    $lock = TRUE;
                }

                $data = [];
                foreach(json_decode($dataset)->destinations as $destination) {
                    array_push($data, array(
                        'code' => $destination->code,
                        'name' => $destination->name->content,
                        'countryCode' => $destination->countryCode
                    ));

                    if(count($data) >= $batchLimit) {
                        fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                        $this->dbhb->insert_batch($this::TB_DESTINATIONS, $data);
                        $data = [];
                    }
                }
                if(count($data) > 0) {
                    fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                    $this->dbhb->insert_batch($this::TB_DESTINATIONS, $data);
                }
            }

            $from = $to + 1;
            $to = $to + $step;
        }

        fwrite($f, 'syncing end: '. date('H:i:s') . PHP_EOL);
        fclose($f);
    }

    public function syncBoards()
    {
        $f = fopen(__DIR__ . '/../libraries/ReferenceData/sync-log.txt', 'w');
        fwrite($f, 'syncing start: '. date('H:i:s') . PHP_EOL);

        $batchLimit = 1000;
        $from = 1;
        $to = 1000;
        $step = 1000;
        $running = TRUE;
        $lock = FALSE;
        while ($running)
        {
            $file = __DIR__ . sprintf('/../libraries/ReferenceData/Boards/%s-%s.json', $from, $to);
            if ( ! file_exists($file) ) {
                $running = FALSE;
            }

            $fr = fopen($file, 'r');
            $dataset = fread($fr, filesize($file));
            fclose($fr);

            if( ! empty($dataset) )
            {
                if( ! $lock )
                {
                    // Refresh table
                    $this->dbhb->empty_table($this::TB_BOARDS);
                    $lock = TRUE;
                }

                $data = [];
                foreach(json_decode($dataset)->boards as $board) {
                    array_push($data, array(
                        'code' => $board->code,
                        'description' => $board->description->content
                    ));

                    if(count($data) >= $batchLimit) {
                        fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                        $this->dbhb->insert_batch($this::TB_BOARDS, $data);
                        $data = [];
                    }
                }
                if(count($data) > 0) {
                    fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                    $this->dbhb->insert_batch($this::TB_BOARDS, $data);
                }
            }

            $from = $to + 1;
            $to = $to + $step;
        }

        fwrite($f, 'syncing end: '. date('H:i:s') . PHP_EOL);
        fclose($f);
    }

    public function syncCountries()
    {
        $f = fopen(__DIR__ . '/../libraries/ReferenceData/sync-log.txt', 'w');
        fwrite($f, 'syncing start: '. date('H:i:s') . PHP_EOL);

        $batchLimit = 1000;
        $from = 1;
        $to = 1000;
        $step = 1000;
        $running = TRUE;
        $lock = FALSE;
        while ($running)
        {
            $file = __DIR__ . sprintf('/../libraries/ReferenceData/Countries/%s-%s.json', $from, $to);
            if ( ! file_exists($file) ) {
                $running = FALSE;
            }

            $fr = fopen($file, 'r');
            $dataset = fread($fr, filesize($file));
            fclose($fr);

            if( ! empty($dataset) )
            {
                if( ! $lock )
                {
                    // Refresh table
                    $this->dbhb->empty_table($this::TB_COUNTIRES);
                    $lock = TRUE;
                }

                $data = [];
                foreach(json_decode($dataset)->countries as $country) {
                    array_push($data, array(
                        'code' => $country->code,
                        'isoCode' => $country->isoCode,
                        'description' => $country->description->content
                    ));

                    if(count($data) >= $batchLimit) {
                        fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                        $this->dbhb->insert_batch($this::TB_COUNTIRES, $data);
                        $data = [];
                    }
                }
                if(count($data) > 0) {
                    fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                    $this->dbhb->insert_batch($this::TB_COUNTIRES, $data);
                }
            }

            $from = $to + 1;
            $to = $to + $step;
        }

        fwrite($f, 'syncing end: '. date('H:i:s') . PHP_EOL);
        fclose($f);
    }

    public function syncCategories()
    {
        $f = fopen(__DIR__ . '/../libraries/ReferenceData/sync-log.txt', 'w');
        fwrite($f, 'syncing start: '. date('H:i:s') . PHP_EOL);

        $batchLimit = 1000;
        $from = 1;
        $to = 1000;
        $step = 1000;
        $running = TRUE;
        $lock = FALSE;
        while ($running)
        {
            $file = __DIR__ . sprintf('/../libraries/ReferenceData/Categories/%s-%s.json', $from, $to);
            if ( ! file_exists($file) ) {
                $running = FALSE;
            }

            $fr = fopen($file, 'r');
            $dataset = fread($fr, filesize($file));
            fclose($fr);

            if( ! empty($dataset) )
            {
                if( ! $lock )
                {
                    // Refresh table
                    $this->dbhb->empty_table($this::TB_CATEGORIES);
                    $lock = TRUE;
                }

                $data = [];
                foreach(json_decode($dataset)->categories as $category) {
                    array_push($data, array(
                        'code' => $category->code,
                        'accommodationType' => $category->accommodationType,
                        'group' => $category->group,
                        'description' => $category->description->content
                    ));

                    if(count($data) >= $batchLimit) {
                        fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                        $this->dbhb->insert_batch($this::TB_CATEGORIES, $data);
                        $data = [];
                    }
                }
                if(count($data) > 0) {
                    fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                    $this->dbhb->insert_batch($this::TB_CATEGORIES, $data);
                }
            }

            $from = $to + 1;
            $to = $to + $step;
        }

        fwrite($f, 'syncing end: '. date('H:i:s') . PHP_EOL);
        fclose($f);
    }

    public function syncChains()
    {
        $f = fopen(__DIR__ . '/../libraries/ReferenceData/sync-log.txt', 'w');
        fwrite($f, 'syncing start: '. date('H:i:s') . PHP_EOL);

        $batchLimit = 1000;
        $from = 1;
        $to = 1000;
        $step = 1000;
        $running = TRUE;
        $lock = FALSE;
        while ($running)
        {
            $file = __DIR__ . sprintf('/../libraries/ReferenceData/Chains/%s-%s.json', $from, $to);
            if ( ! file_exists($file) ) {
                $running = FALSE;
            }

            $fr = fopen($file, 'r');
            $dataset = fread($fr, filesize($file));
            fclose($fr);

            if( ! empty($dataset) )
            {
                if( ! $lock )
                {
                    // Refresh table
                    $this->dbhb->empty_table($this::TB_CHAINS);
                    $lock = TRUE;
                }

                $data = [];
                foreach(json_decode($dataset)->chains as $chain) {
                    array_push($data, array(
                        'code' => $chain->code,
                        'description' => $chain->description->content
                    ));

                    if(count($data) >= $batchLimit) {
                        fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                        $this->dbhb->insert_batch($this::TB_CHAINS, $data);
                        $data = [];
                    }
                }
                if(count($data) > 0) {
                    fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                    $this->dbhb->insert_batch($this::TB_CHAINS, $data);
                }
            }

            $from = $to + 1;
            $to = $to + $step;
        }

        fwrite($f, 'syncing end: '. date('H:i:s') . PHP_EOL);
        fclose($f);
    }

    public function syncCurrencies()
    {
        $f = fopen(__DIR__ . '/../libraries/ReferenceData/sync-log.txt', 'w');
        fwrite($f, 'syncing start: '. date('H:i:s') . PHP_EOL);

        $batchLimit = 1000;
        $from = 1;
        $to = 1000;
        $step = 1000;
        $running = TRUE;
        $lock = FALSE;
        while ($running)
        {
            $file = __DIR__ . sprintf('/../libraries/ReferenceData/Currencies/%s-%s.json', $from, $to);
            if ( ! file_exists($file) ) {
                $running = FALSE;
            }

            $fr = fopen($file, 'r');
            $dataset = fread($fr, filesize($file));
            fclose($fr);

            if( ! empty($dataset) )
            {
                if( ! $lock )
                {
                    // Refresh table
                    $this->dbhb->empty_table($this::TB_CURRENCIES);
                    $lock = TRUE;
                }

                $data = [];
                foreach(json_decode($dataset)->currencies as $currency) {
                    array_push($data, array(
                        'code' => $currency->code,
                        'currencyType' => $currency->currencyType,
                        'description' => $currency->description->content
                    ));

                    if(count($data) >= $batchLimit) {
                        fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                        $this->dbhb->insert_batch($this::TB_CURRENCIES, $data);
                        $data = [];
                    }
                }
                if(count($data) > 0) {
                    fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                    $this->dbhb->insert_batch($this::TB_CURRENCIES, $data);
                }
            }

            $from = $to + 1;
            $to = $to + $step;
        }

        fwrite($f, 'syncing end: '. date('H:i:s') . PHP_EOL);
        fclose($f);
    }

    public function syncFacilities()
    {
        $f = fopen(__DIR__ . '/../libraries/ReferenceData/sync-log.txt', 'w');
        fwrite($f, 'syncing start: '. date('H:i:s') . PHP_EOL);

        $batchLimit = 1000;
        $from = 1;
        $to = 1000;
        $step = 1000;
        $running = TRUE;
        $lock = FALSE;
        while ($running)
        {
            $file = __DIR__ . sprintf('/../libraries/ReferenceData/Facilities/%s-%s.json', $from, $to);
            if ( ! file_exists($file) ) {
                $running = FALSE;
            }

            $fr = fopen($file, 'r');
            $dataset = fread($fr, filesize($file));
            fclose($fr);

            if( ! empty($dataset) )
            {
                if( ! $lock )
                {
                    // Refresh table
                    $this->dbhb->empty_table($this::TB_FACILITIES);
                    $lock = TRUE;
                }

                $data = [];
                foreach(json_decode($dataset)->facilities as $facility) {
                    array_push($data, array(
                        'code' => $facility->code,
                        'facilityGroupCode' => $facility->facilityGroupCode,
                        'facilityTypologyCode' => $facility->facilityTypologyCode,
                        'description' => $facility->description->content
                    ));

                    if(count($data) >= $batchLimit) {
                        fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                        $this->dbhb->insert_batch($this::TB_FACILITIES, $data);
                        $data = [];
                    }
                }
                if(count($data) > 0) {
                    fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                    $this->dbhb->insert_batch($this::TB_FACILITIES, $data);
                }
            }

            $from = $to + 1;
            $to = $to + $step;
        }

        fwrite($f, 'syncing end: '. date('H:i:s') . PHP_EOL);
        fclose($f);
    }

    public function syncFacilitytypologies()
    {
        $f = fopen(__DIR__ . '/../libraries/ReferenceData/sync-log.txt', 'w');
        fwrite($f, 'syncing start: '. date('H:i:s') . PHP_EOL);

        $batchLimit = 1000;
        $from = 1;
        $to = 1000;
        $step = 1000;
        $running = TRUE;
        $lock = FALSE;
        while ($running)
        {
            $file = __DIR__ . sprintf('/../libraries/ReferenceData/Facilitytypologies/%s-%s.json', $from, $to);
            if ( ! file_exists($file) ) {
                $running = FALSE;
            }

            $fr = fopen($file, 'r');
            $dataset = fread($fr, filesize($file));
            fclose($fr);

            if( ! empty($dataset) )
            {
                if( ! $lock )
                {
                    // Refresh table
                    $this->dbhb->empty_table($this::TB_FACILITYTYPOLOGIES);
                    $lock = TRUE;
                }

                $data = [];
                foreach(json_decode($dataset)->facilityTypologies as $facilityTypology) {
                    array_push($data, array(
                        'code' => $facilityTypology->code,
                        'full_response' => json_encode($facilityTypology)
                    ));

                    if(count($data) >= $batchLimit) {
                        fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                        $this->dbhb->insert_batch($this::TB_FACILITYTYPOLOGIES, $data);
                        $data = [];
                    }
                }
                if(count($data) > 0) {
                    fwrite($f, 'batch insert: ' . count($data) . PHP_EOL);
                    $this->dbhb->insert_batch($this::TB_FACILITYTYPOLOGIES, $data);
                }
            }

            $from = $to + 1;
            $to = $to + $step;
        }

        fwrite($f, 'syncing end: '. date('H:i:s') . PHP_EOL);
        fclose($f);
    }
}