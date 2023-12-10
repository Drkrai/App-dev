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
        $data=[
            'roomName' => $json->roomName,
            'departureDate' => $json->departureDate,
            'arrivalDate' => $json->arrivalDate,
            'guest' => $json->guest,
            'rent'=>$json->rent,
            'user_id' => $json->user_id,
        ];
        $model= new PendingModel();
        $save=$model->save($data);
        return $this->respond($save,200);
    }

    public function getPending(){
        $main= new PendingModel();
        $data=$main->findAll();
        return $this->respond($data,200);
    }

    public function deletePending($id){
        $pending= new PendingModel();
        if (!$id) {
            return $this->failNotFound();
        }
        $pending->delete($id);
    }
}