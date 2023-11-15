<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    private $product;
    function __construct(){
        $this->product = new ProductModel;
    }
    public function index()
    {
        $data=$this->product->findAll();
        if(!$data) return $this->product->failNotFound('No Data Found');
        return $this->product->respond($data);
    }
    public function show($id=null){
        $data=$this->product->find(['id',$id]);
        if(!$data) return $this->product->failNotFound('No Data Found');
        return $this->product->respond($data[0]);
    }
    public function create(){
        $json=$this->product->request->getJson();
        $data=[
            'title' => $json->title,
            'price' => $json->price
        ];
        $product=$this->product->insert($data);
        if(!$product) return $this->product->fail('Failed saved',400);
        return $this->product->respondCreated($product);
    }
    public function update($id = null)
        {
        $json = $this->request->getJSON();
        $data = [
        'title' => $json->title,
        'price' => $json->price
        ];
        $model = new ProductModel();
        $findById = $model->find(['id' => $id]);
        if(!$findById) return $this->product->fail('No Data Found', 404);
        $product = $model->update($id, $data);
        if(!$product) return $this->product->fail('Update failed', 400);
        return $this->product->respond($product);
        }
        public function delete($id = null)
{
        $model = new ProductModel();
        $findById = $model->find(['id' => $id]);
        if(!$findById) return $this->product->fail('No Data Found', 404);
        $product = $model->delete($id);
        if(!$product) return $this->product->fail('Failed Deleted', 400);
        return $this->product->respondDeleted('Deleted Successful');
        }


}
