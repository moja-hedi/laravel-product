<?php

/**
 * Created by Reliese Model.
 */

namespace MojaHedi\Product\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AttributeTemplate
 *
 * @property int $template_id
 * @property int $attribute_id
 *
 * @property Template $template
 * @property Attribute $attribute
 *
 * @package MojaHedi\Product\Models
 */
class AttributeTemplate extends Model
{
	protected $table = 'attribute_templates';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'template_id' => 'int',
		'attribute_id' => 'int'
	];

	public function template()
	{
		return $this->belongsTo(Template::class);
	}

	public function attribute()
	{
		return $this->belongsTo(Attribute::class);
	}
}
