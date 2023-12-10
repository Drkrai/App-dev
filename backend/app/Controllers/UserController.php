<?php
namespace App\Controllers;
use CodeIgniter\RestFul\ResourceController; 
use CodeIgniter\API\ResponseTrait; 
use App\Controllers\password_errormsg;
use App\Models\UserModel; 
class UserController extends ResourceController
{
  public function register()
  {
      $json = $this->request;
      $email = $json->getVar('email');

      $userModel = new UserModel();
      $token = $this->verification(50);
      $exUser = $userModel->where('email', $email)->first();

      if ($exUser) {
          return $this->fail(["error" => "Email already exists"], 400);
      } else {
          $password = $json->getVar('password');

          if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
              return $this->fail(["error" => "Password must contain at least one letter, one number, and one character"], 400);
          }

          $data = [
              'username' => $json->getVar('username'),
              'email' => $email,
              'password' => password_hash($password, PASSWORD_BCRYPT),
              'token' => $token,
              'role' => 'user',
          ];

          $u = $userModel->save($data);

          if ($u) {
              return $this->respond(['msg' => 'Registered Successfully', 'token' => $token]);
          } else {
              return $this->fail(['msg' => 'Error occurred']);
          }
      }
  }
    public function verification($length){ 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
         return substr(str_shuffle($str_result), 
         0, $length); 
      } 

      public function login()
      {
          $json = $this->request->getJSON();
  
          if (isset($json->email) && isset($json->password)) {
              $email = $json->email;
              $password = $json->password;
  
              $userModel = new UserModel();
              $data = $userModel->where('email', $email)->first();
  
              if ($data) {
                  $hashedPassword = $data['password'];
                  $auth = password_verify($password, $hashedPassword);
  
                  if ($auth) {
                      return $this->respond(['message' => 'Login successful', 'name' => $data['username'], 'token' => $data['token'],'userid' => $data['user_id']] ,200);
                  } else {
                      return $this->failUnauthorized('Incorrect email or password');
                  }
              } else {
                  return $this->failNotFound('Email not registered. Please sign up.');
              }
          } else {
              return $this->fail('Invalid JSON data', 400);
          }
      }


      public function getUsernames()
      {
          $userIds = $this->request->getGet('userIds');
  
          if (empty($userIds)) {
              return $this->fail('User IDs not provided', 400);
          }
          $userIds = is_array($userIds) ? implode(',', $userIds) : $userIds;
          $userModel = new UserModel();
          $usernames = $userModel->whereIn('user_id', explode(',', $userIds))->findAll();
  
          $result = [];
          foreach ($usernames as $user) {
              $result[] = [
                  'userId'   => $user['user_id'],
                  'username' => $user['username'],
              ];
          }
  
          return $this->respond($result, 200);
      }
      
}      