<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Console\Command;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\Validator;


class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $data = [];
        $data['name'] = $this->ask('Enter product name');
        $data['description'] = $this->ask('Enter Description');
        $data['price'] = $this->ask('Enter price');
        $data['image'] = $this->ask('Enter image');
        
        $categories = Category::select('id','name')->get();
        $this->info('---- Create new category ----');
        $this->info('---- Categories ----');

        foreach($categories as $cat)
        $this->info('id : '.$cat['id'].' - Category name : '.$cat['name']);
        $data['id_category'] = $this->ask('Enter category id');

        //create new product
        Product::create($data);
        $this->info("Created !");
    }
}
