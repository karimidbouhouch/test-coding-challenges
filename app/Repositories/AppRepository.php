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

    public function sortfilter($data){
        $value = $data['value'];
        $category = $data['category'];
        
        if($value == 'name'){
            if ($category!=0){
                $products = $this->model->orderBy('name','asc')->where('id_category','like','%'.$category)->get();
                return \response()->json(['data'=>$products]);
            }
            else {
                $products = $this->model->orderBy('name','asc')->get();
                return \response()->json(['data'=>$products]);
            }
        }
        else if($value == 'price'){
            if($category!=0){
                $products = $this->model->orderBy('price','asc')->where('id_category','like','%'.$category)->get();
                return \response()->json(['data'=>$products]);
            }
            else{
                $products = $this->model->orderBy('price','asc')->get();
                return \response()->json(['data'=>$products]);
            }
        }
        else {
            if($category!=0){
                $products = $this->model->where('id_category','like','%'.$category)->get();
                return \response()->json(['data'=>$products]);
            }
            else{
                $products = $this->model->all();
                return \response()->json(['data'=>$products]);
            }
        } 
    }

}