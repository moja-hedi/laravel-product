<?php


namespace MojaHedi\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Supplier
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Supplier extends Model
{
	use SoftDeletes;
	protected $table = 'suppliers';

	protected $fillable = [
		'name',
		'code'
	];

	public function products()
	{
		return $this->belongsToMany(Product::class, 'product_suppliers')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
