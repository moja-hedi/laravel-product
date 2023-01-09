<?php

namespace MojaHedi\Product\Repositories;

use MojaHedi\Product\Models\AttributeValue;
use MojaHedi\Product\Models\Attribute;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttributeRepository implements RepositoryInterface
{
    private $attribute = Attribute::class;
    private $attribute_values = AttributeValue::class;



    public function getAll()
    {
        return $this->attribute::all();
    }

    public function getById($attribute)
    {
        return $this->attribute::find($model_id);
    }

    public function delete($model)
    {
        $this->attribute::destroy($model->id);
    }

    public function create(array $data)
    {
        try{
            DB::beginTransaction();


            $attribute = $this->attribute::create([
                'name' => $data['name'],
                'display_type' => $data['display_type'],
                'sequence' => $data['sequense'] ?? 1
            ]);

            foreach ($data['values'] as $value) {

                $value['attribute_id'] = $attribute->id;
                $this->attribute_values::create($value);
            }


            DB::commit();

            return $attribute;
        }
        catch(\Exception $e)
        {
            Log::info("Error on create new attribute");
            DB::rollBack();
            Log::info($e->getMessage());
        }


    }

    public function update($model, array $data)
    {
        $model->update(
            $data
        );
        return $model;
    }

    public function getFulfilled()
    {
        //TODO
    }


    public function getAttributesByAttributeId( $attribute_value_ids )
    {
        $attributes = [];
        foreach($attribute_value_ids as $attribute_value_id )
        {
            $attribute_value = AttributeValue::find($attribute_value_id);

            $attributes[] = Attribute::with('attribute_values')->find($attribute_value->attribute_id);

        }
        return $attributes;
    }
}
