<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;



class RegistrationController extends BaseController
{
    use ResponseTrait;
    
    public function registration()
    {
        $userModel = new UserModel();
        $json = $this->request->getVar();
        //$data = json_decode($json); 
        //print_r($json);
        $data = [
            'name' => $json['fname'],
            'email' => $json['email'],
            'password' => $json['password'],
        ];

        $data['msg'] = "Success";
    
               
        // if($userModel->insert($data)){
        //     $data['msg'] = "Success";
        //     return $this->respond($data);
        // } else {
        //     $data['msg'] = "Failed";
        //     return $this->respond($data);
        // }
         $userModel->save($data);
     
       
        return $this->respond($data);

        
    }
}
