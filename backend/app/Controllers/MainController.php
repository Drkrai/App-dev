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
            'status' => 'Active',
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
        $data=$main->select('roomName,rent')->where('status', 'Active')->findAll();
        return $this->respond($data);
    }

    
    public function getDataStatus(){
        $main = new MainModel();
        $data = $main->where('status', 'Active')->findAll();
        return $this->respond($data);
    }

    public function updateRoom($id){
        try {
            $main= new MainModel();
        $post=$this->request->getJson();
        $save = [
            'roomName' => $post->roomName,
            'roomType' => $post->roomType,
            'ac' => $post->ac,
            'food' => $post->food,
            'cancelCharge' => $post->cancelCharge,
            'numGuest' => $post->numGuest,
            'rent' => $post->rent,
            'description' => $post->description,
        ];

        $s = $main->update($id, $save);
        return $this->respond($s,200);
        } catch (\Throwable $th) {
            echo $th;
        }

        
    }
    public function getTotalBookings()
    {
        $bookingModel = new BookingModel(); 
        $totalBookings = $bookingModel->countAll();

        return $this->respond($totalBookings);
    }
    public function getAvailRoom(){
        $room = new MainModel();
        $availRoom= $room->where('status','Active')->countAllResults();
        return $this->respond($availRoom);
    }
    
}