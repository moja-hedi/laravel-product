<?php


namespace MojaHedi\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VariableTypeRef
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|VariableRef[] $variable_refs
 *
 * @package App\Models
 */
class VariableTypeRef extends Model
{
	use SoftDeletes;
	protected $table = 'variable_type_refs';

	protected $fillable = [
		'name',
		'code'
	];

	public function variable_refs()
	{
		return $this->hasMany(VariableRef::class);
	}
}
