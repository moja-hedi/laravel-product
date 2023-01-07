<?php

/**
 * Created by Reliese Model.
 */

namespace MojaHedi\Product\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VariantCombination
 *
 * @property int $product_id
 * @property int $template_attribute_value_id
 *
 * @property Product $product
 * @property TemplateAttributeValue $template_attribute_value
 *
 * @package MojaHedi\Product\Models
 */
class VariantCombination extends Model
{
	protected $table = 'variant_combination';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'template_attribute_value_id' => 'int'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function template_attribute_value()
	{
		return $this->belongsTo(TemplateAttributeValue::class);
	}
}
