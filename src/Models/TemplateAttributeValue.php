<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplateAttributeValue
 * 
 * @property int $id
 * @property int $attribute_value_id
 * @property int $attribute_line_id
 * @property float|null $extra_price
 * @property int $attribute_id
 * @property int $template_id
 * 
 * @property AttributeValue $attribute_value
 * @property TemplateAttributeLine $template_attribute_line
 * @property Collection|VariantCombination[] $variant_combinations
 *
 * @package App\Models
 */
class TemplateAttributeValue extends Model
{
	protected $table = 'template_attribute_values';
	public $timestamps = false;

	protected $casts = [
		'attribute_value_id' => 'int',
		'attribute_line_id' => 'int',
		'extra_price' => 'float',
		'attribute_id' => 'int',
		'template_id' => 'int'
	];

	protected $fillable = [
		'attribute_value_id',
		'attribute_line_id',
		'extra_price',
		'attribute_id',
		'template_id'
	];

	public function attribute_value()
	{
		return $this->belongsTo(AttributeValue::class);
	}

	public function template_attribute_line()
	{
		return $this->belongsTo(TemplateAttributeLine::class, 'attribute_line_id');
	}

	public function variant_combinations()
	{
		return $this->hasMany(VariantCombination::class);
	}
}
