<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new category';

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
        $this->info('---- Categories ----');
        foreach($categories as $category){
        $this->info('-> '.$category['name']);
        }
        $this->info('--------------------');
        
        //create new category
        $data = [];
        $data['name'] = $this->ask('Enter category name');
        Category::create($data);
        $this->info("Created !");
    }
}
