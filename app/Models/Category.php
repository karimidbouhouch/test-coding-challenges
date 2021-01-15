<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'id_parent_category'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    //category product relationship
    public function Product()
    {
        return $this->hasMany('App\Models\Product');
    }

    //parent child relationship
    public function children()
    {
        return $this->hasMany('App\Models\Category', 'id_parent_category', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'id_parent_category');
    }
}
