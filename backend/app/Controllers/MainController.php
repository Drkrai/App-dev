<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MainModel;
use App\Models\BookingModel;
use App\Models\PendingModel;
class MainController extends ResourceController
{
    public function save()
    {
        $json=$this->request->getJSON();
        $data=[
            'roomName'=>$json->roomName,
            'roomType'=>$json->roomType,
            'ac'=>$json->ac,
            'food'=>$json->food,
            'cancelCharge'=>$json->cancelCharge,
            'numGuest'=>$json->numGuest,
            'rent'=>$json->rent,
            'description'=>$json->description,
            'status' => 'available',
        ];
        $main=new MainModel();
        $r=$main->save($data);
        return $this->respond($r,200);
    }
    public function getData(){
        $main=new MainModel();
        $data=$main->findAll();
        return $this->respond($data);
    }

    public function getRoom(){
        $main=new MainModel();
        $data=$main->select('roomName')->findAll();
        return $this->respond($data);
    }

   
}
