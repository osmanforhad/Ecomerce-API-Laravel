<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'address',
        'city',
        'state',
        'zipcode',
        'payment_id',
        'payment_mode',
        'traking_no',
        'status',
        'remark',
    ];
 /**
     * Relation with
     * 
     * orderitems Table (Orderitems class Model)
     * 
     * where
     * 
     * order_id is foreign key wich is in orderitems table
     * 
     * and 
     * id is primary key whcih is in orders table
     */
    public function orderitems()
    {
        return $this->hasMany(Orderitems::class, 'order_id', 'id');
    }
}
