<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'product_qty',
    ];

    /**
     * Relation with
     * 
     * products Table (Product class Model)
     * 
     * where
     * 
     * product_id is foreign key wich is in cart table
     * 
     * and 
     * id is primary key whcih is in product table
     */
    protected $with = ['products']; //for use in frontend section
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
