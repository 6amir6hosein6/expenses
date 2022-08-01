<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactorProduct extends Model
{
    use HasFactory;

    protected $table = "factor_products";

    protected $fillable = [
        'factor_id', 'safi_id', 'product_id', 'product_name', 'weight', 'count', 'fee'
    ];

}
