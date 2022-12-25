<?php

namespace MojaHedi\Product\Repositories;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MojaHedi\Product\Models\Product;
use MojaHedi\Product\Models\ProductPrice;
use MojaHedi\Product\Models\Variable;
use MojaHedi\Product\Models\VariableRef;
use MojaHedi\Product\Models\VariableValueRef;
use MojaHedi\Product\Models\Variant;

class VariantRepository implements RepositoryInterface
{
    private $model = Variant::class;



    public function getAll()
    {
        return $this->model::all();
    }
    public function getById($model_id)
    {
        return $this->model::find($model_id);
    }
    public function delete(Model $model)
    {
        $this->model::destroy($model->id);
    }
    public function create(array $data)
    {
        return $this->model::create($data);
    }
    public function update(Model $model, array $data)
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

    public function setVariable( $model, $variable_value_ref_id, $extra_price = 0)
    {
        try {
            $variable_value_ref = VariableValueRef::find($variable_value_ref_id);

            $variable = new Variable(
                [
                    'extra_price' => $extra_price,
                    'variable_ref_id' => $variable_value_ref->variable_ref_id,
                    'variable_value_ref_id' => $variable_value_ref->variable_value_ref_id,
                    'product_id' => $model->id
                ]
            );


            $variable->save();

            return $variable;
        } catch(Exception $e) {
            Log::info($e->getMessage());
            Log::debug($e->getTraceAsString());
        }
        return null;
    }


    public function deleteVariable($model, $variable_value_ref_id)
    {
        try {

            $model->variables->filter( function($variable) use ($variable_value_ref_id){
                return $variable->variable_value_ref_id == $variable_value_ref_id;
            })->each(function($variable){
                $variable->delete();
            });

        } catch(Exception $e) {
            Log::info($e->getMessage());
            Log::debug($e->getTraceAsString());
        }
        return null;
    }


}
