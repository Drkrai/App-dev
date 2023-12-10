<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\CancelModel;

class CancelController extends ResourceController
{
    public function saveCancel()
    {
        $json=$this->request->getJson();
        $data=[
            'user_id' => $json->user_id,
            'reason' => $json->reason,
            'booking_id' => $json->booking_id
        ];
        $model=new CancelModel();
        $save=$model->save($data);
        return $this->respond($save,200);
    }

    public function getcancel(){
        $model=new CancelModel();
        $data=$model->join('users', 'users.user_id = cancellation.user_id')
        ->select('cancellation.*,users.user_id as user_id, users.username as user_name')
        ->findAll();
        return $this->respond($data,200);
    }
    public function cancelBooking($id){
        $bookingModel=new BookingModel();
        $bookingModel->set('status','Cancelled')->where('id',$id)->update();
    }  

}
