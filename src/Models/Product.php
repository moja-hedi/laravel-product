<?php

/**
 * Created by Reliese Model.
 */

namespace MojaHedi\Product\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @property int $id
 * @property int $template_id
 * @property string $code
 * @property string|null $barcode
 * @property string|null $combination_indices
 * @property string|null $volume
 * @property string|null $weight
 * @property string|null $width
 * @property string|null $height
 * @property string|null $length
 *
 * @property Template $template
 * @property Collection|VariantCombination[] $variant_combinations
 *
 * @package MojaHedi\Product\Models
 */
class Product extends Model
{
	protected $table = 'products';
	public $timestamps = false;

	protected $casts = [
		'template_id' => 'int'
	];

	protected $fillable = [
		'template_id',
		'code',
		'barcode',
		'combination_indices',
		'volume',
		'weight',
		'width',
		'height',
		'length'
	];

	public function template()
	{
		return $this->belongsTo(Template::class);
	}

	public function variant_combinations()
	{
		return $this->hasMany(VariantCombination::class);
	}
}
