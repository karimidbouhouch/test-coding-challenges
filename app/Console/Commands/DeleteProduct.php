<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Command;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete product';

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

        //get all products
        $products = Product::select('id','name')->get();

        //display product
        $this->info('---- Products ----');
        foreach($products as $product){
        $this->info('id : '.$product['id'].' - Product name : '.$product['name']);
        }
        $id = $this->ask('Enter product id');

        //verify product if it was and then product creation 
        $id_product = Product::select('id')->find($id);
        if($id == $id_product['id']){
            Product::destroy($id);
            $this->info("Deleted !");
        }
        else{
            $this->info("product not found ");
        }
        
    }
}
