<?php
declare(strict_types=1);

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\AppRepository;

class ProductRepository extends AppRepository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }
}



