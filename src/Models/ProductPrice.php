<?php



namespace MojaHedi\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductPrice
 *
 * @property int $id
 * @property float $price
 * @property int $product_id
 * @property Carbon $from
 * @property Carbon|null $till
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Product $product
 *
 * @package App\Models
 */
class ProductPrice extends Model
{
	use SoftDeletes;
	protected $table = 'product_prices';

	protected $casts = [
		'price' => 'float',
		'product_id' => 'int'
	];

	protected $dates = [
		'from',
		'till'
	];

	protected $fillable = [
		'price',
		'product_id',
		'from',
		'till'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
