<?php


namespace MojaHedi\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|ProductCategory[] $product_categories
 * @property Collection|Supplier[] $suppliers
 * @property Collection|Variant[] $variants
 *
 * @package App\Models
 */
class Product extends Model
{
	use SoftDeletes;
	protected $table = 'products';

	protected $fillable = [
		'name',
		'code'
	];

	public function product_categories()
	{
		return $this->hasMany(ProductCategory::class);
	}

	public function suppliers()
	{
		return $this->belongsToMany(Supplier::class, 'product_suppliers')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function variants()
	{
		return $this->hasMany(Variant::class);
	}
}
