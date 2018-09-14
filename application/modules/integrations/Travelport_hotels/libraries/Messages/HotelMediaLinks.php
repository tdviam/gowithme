<?php 

class HotelMediaLinks extends BaseModel
{
    public function __construct()
    {
        $this->AuthorizedBy = 'user';
        $this->TraceId = 'trace';
        $this->BillingPointOfSaleInfo = new BillingPointOfSaleInfo('UAPI');
    }

    public function setHotelProperty($HotelChain , $HotelCode)
    {
        $this->HotelProperty = new HotelProperty($HotelChain , $HotelCode);
    }
}