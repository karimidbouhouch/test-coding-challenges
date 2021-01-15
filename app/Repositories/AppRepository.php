<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class AppRepository  
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(){
        try{
            $data = $this->model->all();
            return \response()->json(['status'=>'success','data'=>$data]);
        }
        catch (Exception $e){
            return \response()->json(['status'=>'error','errors'=>$e]);
        }
    }

    public function create(array $data){
        try{
            $this->model->create($data);
            return \response()->json(['status'=>'success','message' => 'Added Successfully']);    
        }
        catch(Exception $e){
            return \response()->json(['status'=>'error','message' => $e]);    
        }
    }

    public function delete($id){
        try{
        $product = $this->model->find($id);
        $product->delete();
            return \response()->json(['status'=>'success','message'=>'deleted successfully']);
        }
        catch(Exception $e){
            return response()->json(['status'=>'error','message'=>$e]);
        }

    }


}