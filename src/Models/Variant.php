<?php


namespace MojaHedi\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Variant
 *
 * @property int $id
 * @property int $product_id
 * @property string $code
 * @property bool $is_visible
 * @property float $extra_price
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Product $product
 * @property Collection|Variable[] $variables
 *
 * @package App\Models
 */
class Variant extends Model
{
	use SoftDeletes;
	protected $table = 'variants';

	protected $casts = [
		'product_id' => 'int',
		'extra_price' => 'float',
		'is_visible' => 'bool',
	];

	protected $fillable = [
		'product_id',
		'code',
		'extra_price',
		'is_visible',
		'description'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function variables()
	{
		return $this->hasMany(Variable::class);
	}
}
