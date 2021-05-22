<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_name_en',
        'subcategory_name_ind',
        'subcategory_slug_en',
        'subcategory_slug_ind',
    ];

    public function category(){

        return $this->belongsTo(Category::class,'category_id','id');
    }
}
