<?php

namespace MojaHedi\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //   use HasFactory;
    use SoftDeletes;
    public $timestamps = true;

    protected $fillable = ['id', 'name', 'code', 'price'];
}
