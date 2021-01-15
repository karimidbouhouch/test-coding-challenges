<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\AppRepository;

class CategoryRepository extends AppRepository
{

    public function __construct(Category $Category)
    {
        parent::__construct($Category);
    }

}