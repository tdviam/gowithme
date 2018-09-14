<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sms_api_loader'))
{
    function sms_api_loader($api_name)
    {
        $path = APPPATH . "json/" . $api_name . ".json";
        $f    = fopen($path, 'r');
        $data = fread($f, filesize($path));
        $data = json_decode($data);
        fclose($f);

        return $data;
    }
}

if ( ! function_exists('update_sms_api'))
{
    function update_sms_api($api_name, $data)
    {
        $path = APPPATH . "json/" . $api_name . ".json";
        $f    = fopen($path, 'w');
        fwrite($f, json_encode($data, JSON_PRETTY_PRINT));
        fclose($f);
    }
}

if ( ! function_exists('send_sms'))
{
    function send_sms($recepient, $message)
    {
        $CI =& get_instance();
        $CI->load->library('Sms_notification');
        $smsNotification = new Sms_notification();
        $smsNotification->recepient = $recepient;
        $smsNotification->message   = $message;
        return $smsNotification->send();
    }
}

if ( ! function_exists('get_sms_template')) 
{
	function get_sms_template($template_name_id) 
	{
        $CI =& get_instance();
        $CI->load->library('SmsTemplateManager');
        $smsTemplate = new SmsTemplateManager();
        return $smsTemplate->get($template_name_id);
	}
}

// Moduels Helper Functions

if ( ! function_exists('dir_modules_list')) 
{
	function dir_modules_list() 
	{
        $dataset = array();
        $directory = APPPATH.'modules';
        $scanned_modules = array_diff(scandir($directory), array('..', '.'));
        foreach($scanned_modules as $module) {
            $configurations_file = $directory.'/'.$module.'/config.json';
            $config = NULL;
            if(file_exists($configurations_file)) {
                $f = fopen($configurations_file, 'r');
                $config = json_decode(fread($f, filesize($configurations_file)));
                fclose($f);
                array_push($dataset, $config);
            }
        }
        
        return $dataset;
    }
}

if ( ! function_exists('pt_module_has_enable')) 
{
	function pt_module_has_enable($module) 
	{
        $CI =& get_instance();
        $CI->db->select('module_status');
        $CI->db->where('module_name', $module);
        $CI->db->where('module_status', 1);
        $dataAdapter = $CI->db->get('pt_modules');
        return $dataAdapter->row()->module_status;
    }
}

if ( ! function_exists('pt_modules_list')) 
{
	function pt_modules_list() 
	{
        // $CI =& get_instance();
        // $CI->db->select('module_id, module_name, module_display_name');
        // $CI->db->where('module_status', 1);
        // $CI->db->where('module_front', 1);
        // $dataAdapter = $CI->db->get('pt_modules');
        // $pt_modules = $dataAdapter->result();
        // $dir_modules = dir_modules_list();
        // foreach($pt_modules as &$pt_module) {
        //     foreach($dir_modules as $dir_module) {
        //         if($pt_module->module_name == $dir_module->name) {
        //             $pt_module_array = (array) $pt_module;
        //             $pt_module_array['module_uri']  = $pt_module->module_name;
        //             $pt_module_array['module_icon'] = $dir_module->icon;
        //             $pt_module = (object) $pt_module_array;
        //         }
        //     }
        // }
        
        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'hotels';
        $module->module_uri = 'hotels';
        $module->module_display_name = 'Hotels';
        $module->module_icon = 'hotel.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'hotelscombined';
        $module->module_uri = 'hotelsc';
        $module->module_display_name = 'Hotelscombined';
        $module->module_icon = 'hotel.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'travelpayoutshotels';
        $module->module_uri = 'tphotels';
        $module->module_display_name = 'Hotels';
        $module->module_icon = 'hotel.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'ean';
        $module->module_uri = 'properties';
        $module->module_display_name = 'Ean';
        $module->module_icon = 'hotel.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'wegoflights';
        $module->module_uri = 'flightsw';
        $module->module_display_name = 'Wegoflights';
        $module->module_icon = 'flight.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'Travelstart';
        $module->module_uri = 'flightst';
        $module->module_display_name = 'Travelstart';
        $module->module_icon = 'flight.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'Travelpayouts';
        $module->module_uri = 'air';
        $module->module_display_name = 'Travelpayouts';
        $module->module_icon = 'flight.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'travelport_flight';
        $module->module_uri = 'flight';
        $module->module_display_name = 'Travelport Flight';
        $module->module_icon = 'flight.png';
        $pt_modules[] = $module;
        
        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'tours';
        $module->module_uri = 'tours';
        $module->module_display_name = 'Tours';
        $module->module_icon = 'tour.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'cartrawler';
        $module->module_uri = 'car';
        $module->module_display_name = 'Cars';
        $module->module_icon = 'car.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'cars';
        $module->module_uri = 'cars';
        $module->module_display_name = 'Cars';
        $module->module_icon = 'car.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'offers';
        $module->module_uri = 'offers';
        $module->module_display_name = 'Offers';
        $module->module_icon = 'offers.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'hotelbeds';
        $module->module_uri = 'hotelbeds';
        $module->module_display_name = 'Hotel Beds';
        $module->module_icon = 'hotel.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'ivisa';
        $module->module_uri = 'visa';
        $module->module_display_name = 'Ivisa';
        $module->module_icon = 'visa.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'blog';
        $module->module_uri = 'blog';
        $module->module_display_name = 'Blog';
        $module->module_icon = 'blog.png';
        $pt_modules[] = $module;

        $module = new StdClass();
        $module->module_id = 0;
        $module->module_name = 'travelport_hotel';
        $module->module_uri = 'travelport_hotel';
        $module->module_display_name = 'Travelport Hotel';
        $module->module_icon = 'hotel.png';
        $pt_modules[] = $module;

        return $pt_modules;
	}
}
