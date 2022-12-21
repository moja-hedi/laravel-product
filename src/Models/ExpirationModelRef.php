<?php



namespace MojaHedi\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ExpirationModelRef
 *
 * @property int $id
 * @property string $name
 * @property int $day_count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|ProductExpirationModel[] $product_expiration_models
 *
 * @package App\Models
 */
class ExpirationModelRef extends Model
{
	use SoftDeletes;
	protected $table = 'expiration_model_refs';

	protected $casts = [
		'day_count' => 'int'
	];

	protected $fillable = [
		'name',
		'day_count'
	];

	public function product_expiration_models()
	{
		return $this->hasMany(ProductExpirationModel::class);
	}
}
