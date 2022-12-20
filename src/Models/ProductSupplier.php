<?php

namespace MojaHedi\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSupplier extends Model
{
    //   use HasFactory;
    use SoftDeletes;
    protected $timestamps = true;

    protected $fillable = ['id', 'product_id', 'supplier_id'];
}