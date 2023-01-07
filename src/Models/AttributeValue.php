<?php

/**
 * Created by Reliese Model.
 */

namespace MojaHedi\Product\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttributeValue
 *
 * @property int $id
 * @property int $attribute_id
 * @property string|null $name
 * @property int $sequence
 *
 * @property Attribute $attribute
 * @property Collection|TemplateAttributeLine[] $template_attribute_lines
 * @property Collection|TemplateAttributeValue[] $template_attribute_values
 *
 * @package MojaHedi\Product\Models
 */
class AttributeValue extends Model
{
	protected $table = 'attribute_values';
	public $timestamps = false;

	protected $casts = [
		'attribute_id' => 'int',
		'sequence' => 'int'
	];

	protected $fillable = [
		'attribute_id',
		'name',
		'sequence'
	];

	public function attribute()
	{
		return $this->belongsTo(Attribute::class);
	}

	public function template_attribute_lines()
	{
		return $this->belongsToMany(TemplateAttributeLine::class, 'attribute_value_template_attribute_lines');
	}

	public function template_attribute_values()
	{
		return $this->hasMany(TemplateAttributeValue::class);
	}
}
