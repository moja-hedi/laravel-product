<?php


namespace MojaHedi\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VariableValueRef
 *
 * @property int $id
 * @property int $variable_ref_id
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property VariableRef $variable_ref
 * @property Collection|Variable[] $variables
 *
 * @package App\Models
 */
class VariableValueRef extends Model
{
	use SoftDeletes;
	protected $table = 'variable_value_refs';

	protected $casts = [
		'variable_ref_id' => 'int'
	];

	protected $fillable = [
		'variable_ref_id',
		'value'
	];

	public function variable_ref()
	{
		return $this->belongsTo(VariableRef::class);
	}

	public function variables()
	{
		return $this->hasMany(Variable::class);
	}
}
