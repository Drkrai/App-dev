<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\PendingModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
class BookingController extends ResourceController
{
    public function confirmBooking($id){
        try {
            $pendingModel= new PendingModel();
        $bookingModel= new BookingModel();
        $pendingBooking= $pendingModel->find($id);

        if (!$pendingBooking) {
            return $this->failNotFound();
        }

       $bookingModel->insert([
            'name'=>$pendingBooking['roomName'],
            'time'=>$pendingBooking['time'],
            'arrivalDate'=>$pendingBooking['arrivalDate'],
            'departureDate'=>$pendingBooking['departureDate'],
        ]);
        $pendingModel->delete($id);
        } catch (\Exception $e) {
            return $this->failServerError('Error confirming booking: ' . $e->getMessage());
        }

        

    }
    public function getBooking() {
            $main= new BookingModel();
            $data= $main->findAll();
            return $this->respond($data);
    }
}
