<?php

    namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'slug',
        'name',
        'brand',
        'selling_price',
        'original_price',
        'qty',
        'image',
        'featured',
        'popular',
        'status',
    ];

    /**
     * Relation with
     * 
     * categories Table (Category class Model)
     * 
     * where
     * 
     * category_id is foreign key wich is in product table
     * 
     * and 
     * id is primary key whcih is in categories table
     */
    protected $with = ['categories']; //for use in frontend section
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
