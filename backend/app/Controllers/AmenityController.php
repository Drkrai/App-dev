<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\AmenityModel;
class AmenityController extends ResourceController
{
    public function get()
    {
        $main=new AmenityModel();
        $data=$main->findAll();
        return $this->respond($data);
    }

    public function save(){
        $json=$this->request->getJson();
        $data=[
            'name'=>$json->name,
            'price'=>$json->price,
        ];
        $model=new AmenityModel();
        $r=$model->save($data);
        return $this->respond($r,200);
    }
}
