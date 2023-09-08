<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id'];  

    protected $with = ['category'];

    protected $appends = ['image_url'];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getImageUrlAttribute($size=null)
    {
        return asset('images/' . $this->cover);
    }
    
}
