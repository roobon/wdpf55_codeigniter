<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;



class ProductController extends BaseController
{
    private $products;
    protected $helpers = ['form', 'url', 'file'];
    //protected $library = ['form_validation'];
    
    public function __construct(){
       $this->products =  new ProductModel();
    }
    
    
    public function index()
    {
         $data['items'] = $this->products->findAll();
         $data['title'] = "Display all products"; 
         return view("products/index", $data);
       
    }

    public function create(){
        return view("products/create");
    }

    public function store(){
        $data = [ 
            'category' => $this->request->getVar('cat'),
            'price' => $this->request->getVar('price'),
            'sku' => $this->request->getVar('sku'),
            'model' => $this->request->getVar('model'),
            'product' => $this->request->getVar('name'),
            'photo' => $this->request->getFile('photo')->getName('photo'),
        ]; 
        $rules = [
            'name' => 'required|max_length[30]|min_length[3]',
            'price' => 'required|numeric',
            'sku' => 'required|min_length[3]',
            'photo' => 'uploaded[photo]|max_size[photo,1024]|ext_in[photo,jpg,jpeg]'
        ]; 
        if (! $this->validate($rules)) {
            return view('products/create');
        } else {
            //echo WRITEPATH;
            $img = $this->request->getFile('photo');
            $img->move(WRITEPATH. 'uploads');
            $this->products->insert($data);
            $session = session();
            $session->setFlashdata('msg', 'Inserted and uploaded Successfully');
            $this->response->redirect('/products/');
        }    
    }

    public function edit($id){
        $data = $this->products->find($id);
        return view("products/edit", $data);
    }

    public function update($id){
       
       $data = [ 
        'category' => $this->request->getVar('cat'),
        'price' => $this->request->getVar('price'),
        'sku' => $this->request->getVar('sku'),
        'model' => $this->request->getVar('model'),
        'product' => $this->request->getVar('name'),
    ]; 

    $this->products->update($id, $data);
    $session = session();
    $session->setFlashdata('msg', 'Updated Successfully');
    $this->response->redirect('/products/');

    }


    public function delete($id){
       $this->products->where('product_id', $id);
       $this->products->delete();
       $session = session();
       $session->setFlashdata('msg', 'Deleted Successfully');
       $this->response->redirect('/products/');
    }

}
