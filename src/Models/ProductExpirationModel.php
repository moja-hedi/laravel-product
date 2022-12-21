<?php



namespace MojaHedi\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductExpirationModel
 *
 * @property int $id
 * @property int $product_id
 * @property int $expiration_model_ref_id
 * @property Carbon $from
 * @property Carbon|null $till
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Product $product
 * @property ExpirationModelRef $expiration_model_ref
 *
 * @package App\Models
 */
class ProductExpirationModel extends Model
{
	use SoftDeletes;
	protected $table = 'product_expiration_models';

	protected $casts = [
		'product_id' => 'int',
		'expiration_model_ref_id' => 'int'
	];

	protected $dates = [
		'from',
		'till'
	];

	protected $fillable = [
		'product_id',
		'expiration_model_ref_id',
		'from',
		'till'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function expiration_model_ref()
	{
		return $this->belongsTo(ExpirationModelRef::class);
	}
}
