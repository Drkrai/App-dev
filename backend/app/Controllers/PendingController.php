<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\PendingModel;
class PendingController extends ResourceController
{
    public function saveBooking()
    {
        
        $json=$this->request->getJson();
        $amenities = $json->amenities ?? [];
        $data=[
            'roomName' => $json->roomName,
            'departureDate' => $json->departureDate,
            'arrivalDate' => $json->arrivalDate,
            'guest' => $json->guest,
            'rent'=>$json->rent,
            'amenities'=>json_encode($amenities),
        ];
        $model= new PendingModel();
        $save=$model->save($data);
        return $this->respond($save,200);
    }

    public function getPending(){
        $main= new PendingModel();
        $data=$main->findAll();
        foreach ($data as &$row) {
            $row['amenities'] = json_decode($row['amenities'], true) ?? [];
        }
        return $this->respond($data,200);
    }
}
