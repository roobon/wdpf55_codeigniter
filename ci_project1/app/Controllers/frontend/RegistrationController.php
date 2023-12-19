<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class RegistrationController extends BaseController
{
    use ResponseTrait;
    
    public function registration()
    {
        $data['msg'] = "Success";
        return $this->respond($data);
    }
}
