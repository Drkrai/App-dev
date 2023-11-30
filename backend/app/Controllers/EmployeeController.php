<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EmployeeModel;
class EmployeeController extends ResourceController
{
    public function save()
    {
        try {
            $model= new EmployeeModel();
            $json=$this->request->getJSON();
            $email = $json->email;
            if ($model->where('email', $email)->countAllResults() > 0) {
                return $this->respond(['exists' => true]);
            }else{
                $data=[
                    'name' => $json->name,
                    'username' => $json->username,
                    'email' => $json->email,
                    'password' => $json->password,
                    'date_joined' => $json->date,
                    'phone_num' => $json->phone,
                    'role' => $json->role,
                ];
                $s=$model->save($data);
                return $this->respond($s,200);
            }
        
        } catch (\Throwable $e) {
            error_log('Error confirming booking: ' . $e->getMessage());
    
            return $this->failServerError('Error confirming booking: ' . $e->getMessage());
        }
        
    }

    public function getEmployee() {
        $model= new EmployeeModel();
        $data=$model->findAll();
        return $this->respond($data,200);
    }
}
