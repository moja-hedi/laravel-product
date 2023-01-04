<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Template
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $weight
 * @property string|null $height
 * @property string|null $width
 * @property string|null $length
 * @property bool $is_saleable
 * @property string $code
 * 
 * @property Collection|Attribute[] $attributes
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Template extends Model
{
	protected $table = 'templates';
	public $timestamps = false;

	protected $casts = [
		'is_saleable' => 'bool'
	];

	protected $fillable = [
		'name',
		'description',
		'weight',
		'height',
		'width',
		'length',
		'is_saleable',
		'code'
	];

	public function attributes()
	{
		return $this->belongsToMany(Attribute::class, 'template_attribute_lines')
					->withPivot('id', 'value_count');
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
