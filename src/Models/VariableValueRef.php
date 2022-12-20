<?php

namespace MojaHedi\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariableValueRef extends Model
{
    //   use HasFactory;
    use SoftDeletes;
    protected $timestamps = true;

    protected $fillable = ['id', 'variable_ref_id', 'value'];
}
