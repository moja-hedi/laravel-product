<?php


namespace MojaHedi\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Variable
 *
 * @property int $id
 * @property int $variant_id
 * @property int $variable_value_ref_id
 * @property string $variable_ref_id
 * @property float $extra_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Variant $variant
 * @property VariableValueRef $variable_value_ref
 *
 * @package App\Models
 */
class Variable extends Model
{
	use SoftDeletes;
	protected $table = 'variables';

	protected $casts = [
		'variant_id' => 'int',
		'variable_value_ref_id' => 'int',
		'extra_price' => 'float'
	];

	protected $fillable = [
		'variant_id',
		'variable_value_ref_id',
		'variable_ref_id',
		'extra_price'
	];

	public function variant()
	{
		return $this->belongsTo(Variant::class);
	}

	public function variable_value_ref()
	{
		return $this->belongsTo(VariableValueRef::class);
	}
}
