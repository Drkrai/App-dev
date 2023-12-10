<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\MainModel;
use App\Models\PendingModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
class BookingController extends ResourceController
{
    public function confirmBooking($id) {
        try {
            $roomModel = new MainModel();
            $pendingModel = new PendingModel();
            $bookingModel = new BookingModel();
            $pendingBooking = $pendingModel->find($id);
            if (!$pendingBooking) {
                return $this->failNotFound();
            } 
            
            $bookingModel->insert([
                'name' => $pendingBooking['roomName'],
                'time' => $pendingBooking['time'],
                'arrivalDate' => $pendingBooking['arrivalDate'],
                'departureDate' => $pendingBooking['departureDate'],
                'guest' => $pendingBooking['guest'],
                'rent' => $pendingBooking['rent'],
                'user_id' => $pendingBooking['user_id'],
                'status' =>'Active',
            ]);
            $roomModel->set('status', 'Booked')->where('roomName', $pendingBooking['roomName'])->update();   
            $pendingModel->delete($id);
    
        } catch (\Exception $e) {
            // Log the error
            error_log('Error confirming booking: ' . $e->getMessage());
    
            return $this->failServerError('Error confirming booking: ' . $e->getMessage());
        }
    }
        
    
    public function payment($id){
        $model = new BookingModel();
        $data = $model
        ->join('users', 'users.user_id = booking.user_id')
        ->select('booking.*, users.user_id as user_id, users.username as user_name')
        ->find($id);

    return $this->respond($data);
    }
    
    public function getBooking() {
    
            $main= new BookingModel();
            $data = $main
            ->join('users', 'users.user_id = booking.user_id')
            ->select('booking.*,users.user_id as user_id, users.username as user_name')
            ->findAll();
            return $this->respond($data);
    }

    public function getUserBookings($userId) {
    $bookingModel=new BookingModel();
    $bookings = $bookingModel->where('user_id', $userId)->findAll();
    return $this->respond($bookings,200);
    }
}