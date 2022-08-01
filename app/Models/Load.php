<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    use HasFactory;

    protected $table = "loads";
    protected $fillable = [
        'owner_id', 'owner_name', 'date', 'machine_kind', 'driver', 'description' , 'is_new'
    ];
}

