<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = [
        'user_id', 'date', 'price','fee','fee_name', 'description' , 'for_what','for_what_sub','importance','title','family_id'
    ];
}
