<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Safi extends Model
{
    use HasFactory;

    protected $table = "safis";

    protected $fillable = [
        'load_id', 'load_owner_name', 'load_driver', 'date', 'do_price', 'hire', 'discharge', 'weighbridge', 'handy'
    ];
}
