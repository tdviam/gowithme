<?php

class AvailabilityResp {
    
    public $resp;
    public $imagePath = 'http://photos.hotelbeds.com/giata/';

    public function __construct($resp)
    {
        $this->resp = $resp;
    }

    public function get_auditData()
    {
        return $this->resp->auditData;
    }

    public function parse()
    {
        // $response->hotels[] = (object) array(
        //     'id' => $rs['hotelId'], 
        //     'title' => $rs['name'],
        //     'thumbnail' => "https://images.travelnow.com".$thumbnail,
        //     'slug' => $slug,
        //     'currCode' => $rs['rateCurrencyCode'],
        //     'price' =>$rs['lowRate'],
        //     'location' => $rs['city'],
        //     'longitude' => $rs['longitude'],
        //     'latitude' => $rs['latitude'],
        //     'desc' => strip_tags($shortDesc), 
        //     'stars' => pt_create_stars($stars),
        //     'tripAdvisorRatingImg' => $tripAdvisorRating,
        //     'tripAdvisorRating' => $stars
        // );
    }

    public function get_hotels()
    {
        $CI = get_instance();
        $CI->db->where_in('code', array_column($this->resp->hotels->hotels, 'code'));
        $dataAdapter = $CI->db->get('pt_hotelbeds_staticdata_hotels');
        $dataset = $dataAdapter->result();
        foreach($this->resp->hotels->hotels as &$hotel) {
            foreach($dataset as $dataObj) {
                if($dataObj->code == $hotel->code) {
                    $hotelArray = (array) $hotel;
                    $hotelArray['description'] = $dataObj->description;
                    $hotelArray['image'] = $this->imagePath . current(json_decode($dataObj->images))->path;
                    $hotel = (object) $hotelArray;
                }
                unset($hotel->rooms);
            }
        }
        return $this->resp->hotels->hotels;
    }

    public function count()
    {
        return $this->resp->hotels->total;
    }
}