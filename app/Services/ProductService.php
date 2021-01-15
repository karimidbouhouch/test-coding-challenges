<?php

namespace App\Services;

use App\Repositories\Product\ProductRepository;

use Validator;

class ProductService
{
    private $ProductRepository;

    public function __construct(ProductRepository $ProductRepository){
        $this->ProductRepository = $ProductRepository;
    }

    //get all products
    public function getAllProducts(){
        return $this->ProductRepository->getAll();
    }

    //create new product
    public function createProduct(array $data){
        try{  
        // validation rules
        $validator = Validator::make($data,[
            'name' => 'required|string',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'required|string',
            'id_category' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);
        
        //if validation fails
        if($validator->fails()){
            return response()->json(['status'=>'error','errors'=>$validator->errors()]);
        }
        
        //image upload to the folder img
        if($data['image']){
            $image = $data['image'];        
            $file_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('img'),$file_name);
        }

        $products = [
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $file_name,
            'id_category' => $data['id_category'],
        ];

        return $this->ProductRepository->create($products);
        }
        catch(Exception $e){
            return response()->json(['status'=>'error','errors'=>$e]);
        }
    }

    //delete product by id
    public function deleteProduct($id){
        return $this->ProductRepository->delete($id);
    }


}