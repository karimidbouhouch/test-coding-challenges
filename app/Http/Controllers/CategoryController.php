<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    //private $CategoryService;

    public function __construct(CategoryService $CategoryService){
        $this->CategoryService = $CategoryService;
    }

    //get all categories
    public function getCategories(){
       return $this->CategoryService->getAllCategories();
    }

    
}
