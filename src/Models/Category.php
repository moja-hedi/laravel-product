<?php


namespace MojaHedi\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 *
 * @property int $id
 * @property string $name
 * @property bool $is_root
 * @property string|null $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|ProductCategory[] $product_categories
 *
 * @package App\Models
 */
class Category extends Model
{
	use SoftDeletes;
	protected $table = 'categories';

	protected $casts = [
		'is_root' => 'bool'
	];

	protected $fillable = [
		'name',
		'is_root',
		'category_id'
	];

	public function product_categories()
	{
		return $this->hasMany(ProductCategory::class);
	}
}
