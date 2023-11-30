<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\RestFul\ResourceController; 
use CodeIgniter\API\ResponseTrait; 
use App\Models\UserModel; 
class UserController extends ResourceController
{
  public function register()
  {
    try {
      $json = $this->request->getJSON();
      $email = $json->email;
  
      $userModel = new UserModel();
      $token = $this->verification(50); 
      $exUser = $userModel->where('email', $email)->first();
  
      if ($exUser) {
          return $this->respond(["error" => "Email already exists"], 400);
      } else {
          $password = $json->password;
  
          if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
              return $this->respond(["error" => "Password must contain at least one letter, one number and one character"], 400);
          }
  
          $data = [
              'name' => $json->name,
              'email' => $email,
              'password' => password_hash($password, PASSWORD_BCRYPT),
              'token' => $token, 
              'status' => 'active',        
              'role' => 'user', 
          ];
  
          $u = $userModel->save($data); 
          if ($u) { 
              return $this->respond(['msg' => 'Registered Successfully', 'token' => $token]);  
          } else { 
              return $this->respond(['msg' => 'Error occurred']); 
          }
      }
    } catch (\Throwable $th) {
      $th;
    }
      
  }

  public function login()
  {
      $json = $this->request->getJSON();

      if (isset($json->email) && isset($json->password)) {
          $email = $json->email;
          $password = $json->password;

      $userModel = new UserModel();
         $data = $user = $userModel->where('email', $email)->first();

          if($data)
          {
              $pass = $data['password'];
              $auth = password_verify($password, $pass);
              if($auth){
                  return $this->respond(['message' => 'Login successful', 'token' => $data['token'], 'id' => $data['id']], 200);                }
           else {
              return $this->respond(['message' => 'Invalid email or password'], 401);
          }
      } else {
          return $this->respond(['message' => 'Invalid JSON data'], 400);
      }
  }
  
}

public function verification($length){ 
  $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
   return substr(str_shuffle($str_result), 
   0, $length); 

} 
}
