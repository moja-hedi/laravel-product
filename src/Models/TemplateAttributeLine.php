<?php

/**
 * Created by Reliese Model.
 */

namespace MojaHedi\Product\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplateAttributeLine
 *
 * @property int $id
 * @property int $template_id
 * @property int $attribute_id
 * @property int|null $value_count
 *
 * @property Template $template
 * @property Attribute $attribute
 * @property Collection|AttributeValue[] $attribute_values
 * @property Collection|TemplateAttributeValue[] $template_attribute_values
 *
 * @package MojaHedi\Product\Models
 */
class TemplateAttributeLine extends Model
{
	protected $table = 'template_attribute_lines';
	public $timestamps = false;

	protected $casts = [
		'template_id' => 'int',
		'attribute_id' => 'int',
		'value_count' => 'int'
	];

	protected $fillable = [
		'template_id',
		'attribute_id',
		'value_count'
	];

	public function template()
	{
		return $this->belongsTo(Template::class);
	}

	public function attribute()
	{
		return $this->belongsTo(Attribute::class);
	}

	public function attribute_values()
	{
		return $this->belongsToMany(AttributeValue::class, 'attribute_value_template_attribute_lines');
	}

	public function template_attribute_values()
	{
		return $this->hasMany(TemplateAttributeValue::class, 'attribute_line_id');
	}
}
