<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use HasFactory;

    protected $table="factors";

    protected $fillable =[
        'date','customer_id','customer_name','load_id','load_description','last_debt','paid' ,'worker_paid'
    ];
}
