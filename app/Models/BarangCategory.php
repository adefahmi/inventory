<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangCategory extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name'
    ];
}
