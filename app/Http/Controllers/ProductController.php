<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $ProductService;

    public function __construct(ProductService $ProductService){
        $this->ProductService = $ProductService;
    }

    //get all products
    public function getProducts(){
        return $this->ProductService->getAllProducts();
    }

    //add new product
    public function AddProduct(Request $request){
        return $this->ProductService->createProduct($request->all());
    }

    //delete product
    public function deleteProduct($id){
        return $this->ProductService->deleteProduct($id);
    }



}
