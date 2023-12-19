<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class SigninController extends BaseController
{
    protected $helpers = ['form'];
 
    public function index()
    {
        return view('signin');
    }

    public function login(){
        
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $formpass = $this->request->getVar('password');
                   
        $data = $userModel->where('email', $email)->first();
       
        if($data){
            $dbpass = $data['password'];
            $varified = password_verify($formpass, $dbpass);
                if($varified){
                    $userData = [
                        "name" => $data['name'],
                        "email" => $data['email'],
                        "user_role" =>  $data['role'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($userData);
                    if($data['role']=="Admin"){
                         return redirect()->to('/');
                    }
                    if($data['role']=="Editor"){
                        return redirect()->to('/editor');
                   }

                    
                   
                }   else {
                    $session->setFlashdata('msg', 'Your Password is incorrect');
                    return redirect()->to('/signin');
                }
    
        } else {
            $session->setFlashdata('msg', 'Your Email is incorrect');
            return redirect()->to('/signin');
        }

      

    }

    public function logout(){
        session()->destroy();
        return redirect()->to('signin');
    }
}


?>











