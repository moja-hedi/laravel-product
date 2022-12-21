<?php


namespace MojaHedi\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VariableRef
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $variable_type_ref_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property VariableTypeRef $variable_type_ref
 * @property Collection|VariableValueRef[] $variable_value_refs
 *
 * @package App\Models
 */
class VariableRef extends Model
{
	use SoftDeletes;
	protected $table = 'variable_refs';

	protected $casts = [
		'variable_type_ref_id' => 'int'
	];

	protected $fillable = [
		'name',
		'code',
		'variable_type_ref_id'
	];

	public function variable_type_ref()
	{
		return $this->belongsTo(VariableTypeRef::class);
	}

	public function variable_value_refs()
	{
		return $this->hasMany(VariableValueRef::class);
	}
}
