<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    protected $guarded = []; 
    public function produk(){
        return $this->belongsTo(Product::class, 'produk_id', 'id');
    }
}
