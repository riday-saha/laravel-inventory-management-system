<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Add_cart;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function add_carts(){
        return $this->hasMany(Add_cart::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
