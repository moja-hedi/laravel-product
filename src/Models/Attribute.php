<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Attribute
 * 
 * @property int $id
 * @property string $name
 * @property int $sequence
 * @property bool $create_variant
 * @property int $display_type
 * 
 * @property Collection|Template[] $templates
 * @property Collection|AttributeValue[] $attribute_values
 *
 * @package App\Models
 */
class Attribute extends Model
{
	protected $table = 'attributes';
	public $timestamps = false;

	protected $casts = [
		'sequence' => 'int',
		'create_variant' => 'bool',
		'display_type' => 'int'
	];

	protected $fillable = [
		'name',
		'sequence',
		'create_variant',
		'display_type'
	];

	public function templates()
	{
		return $this->belongsToMany(Template::class, 'template_attribute_lines')
					->withPivot('id', 'value_count');
	}

	public function attribute_values()
	{
		return $this->hasMany(AttributeValue::class);
	}
}
