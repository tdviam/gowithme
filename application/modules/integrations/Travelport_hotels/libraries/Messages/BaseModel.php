<?php 

class BaseModel
{
    public $TargetBranch = 'P7004139';

    public function __construct()
    {
        $this->load->model('TravelportHotelModel_Conf', 'Configuration');
        $Configuration->load();
        $this->TargetBranch = $Configuration->get_branch_code();
    }
}