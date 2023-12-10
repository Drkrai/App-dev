<?php

namespace App\Controllers;
use App\Models\BookingModel;
use App\Models\MainModel;
use App\Models\CancelModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\PaymentModel;
class PaymentController extends ResourceController
{
    public function savePayment() {
        $json = $this->request->getJson();
        $data = [
            'booking_id' => $json->booking_id,
            'user_id' => $json->user_id,
            'transaction_id' => $json->transaction_id,
            'arrivalDate' => $json->arrival,
            'departureDate' => $json->departure,
            'total' => $json->total
        ];
    
        $roomName = $json->name;
        $bookId = $json->booking_id;
        $room = new MainModel();
        $booking = new BookingModel();
        $pay = new PaymentModel();
    
        try {
            // Start a transaction to ensure consistency
            $this->db->transStart();
    
            // Update room status
            $updateStatus = $room->set('status', 'Active')->where('roomName', $roomName)->update();
    
            // Save payment
            $save = $pay->save($data);
    
            // Delete booking and associated cancellations
            $this->deleteBooking($bookId);
    
            // Commit the transaction
            $this->db->transCommit();
    
            return $this->respond(['status_updated' => $updateStatus, 'payment_saved' => $save], 200);
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            $this->db->transRollback();
            return $this->respond($e->getMessage(), 500);
        }
    }
    
    // Add the deleteBooking method here
    public function deleteBooking($bookId) {
        $booking = new BookingModel();
        $cancellation = new CancelModel();
    
        // Fetch the booking record
        $bookingRecord = $booking->find($bookId);
    
        if ($bookingRecord) {
            // Delete associated cancellations
            $cancellation->where('booking_id', $bookId)->delete();
    
            // Delete the booking
            $booking->delete($bookId);
        }
    }
    
    
}
