<?php

namespace App\Console\Commands;
use App\Models\Category;
use Illuminate\Console\Command;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete category';

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
        //get all categories
        $categories = Category::select('id','name')->get();

        //display categories
        $this->info('---- Delete Category ----');
        $this->info('---- Categories ----');
        foreach($categories as $category){
        $this->info('id -> '.$category['id'].' | category -> '.$category['name']);
        }
        $this->info('--------------------');
        $id = $this->ask('Enter category id');        

        //verify category if it was and then category creation 
        $id_category = Category::select('id')->find($id);
        if($id == $id_category['id']){
            Category::destroy($id);
            $this->info("Deleted !");
        }
        else{
            $this->info("category not found ");
        }
    }
}
