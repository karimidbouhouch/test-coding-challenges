<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'id_category',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function Category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
