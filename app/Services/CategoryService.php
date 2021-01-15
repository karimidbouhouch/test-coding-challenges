<?php

namespace App\Services;

use App\Repositories\Category\CategoryRepository;

use Validator;

class CategoryService
{
    private $CategoryRepository;

    public function __construct(CategoryRepository $CategoryRepository){
        $this->CategoryRepository = $CategoryRepository;
    }

    //get all categories 
    public function getAllCategories(){
        return $this->CategoryRepository->getAll();
    }

}