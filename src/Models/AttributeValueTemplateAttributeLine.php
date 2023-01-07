<?php

/**
 * Created by Reliese Model.
 */

namespace MojaHedi\Product\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AttributeValueTemplateAttributeLine
 *
 * @property int $attribute_value_id
 * @property int $template_attribute_line_id
 *
 * @property AttributeValue $attribute_value
 * @property TemplateAttributeLine $template_attribute_line
 *
 * @package MojaHedi\Product\Models
 */
class AttributeValueTemplateAttributeLine extends Model
{
	protected $table = 'attribute_value_template_attribute_lines';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'attribute_value_id' => 'int',
		'template_attribute_line_id' => 'int'
	];

	public function attribute_value()
	{
		return $this->belongsTo(AttributeValue::class);
	}

	public function template_attribute_line()
	{
		return $this->belongsTo(TemplateAttributeLine::class);
	}
}
