<?php

namespace MojaHedi\Product\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use MojaHedi\Product\Models\Product;
use MojaHedi\Product\Models\ProductPrice;
use MojaHedi\Product\Models\Variable;
use MojaHedi\Product\Models\VariableRef;
use MojaHedi\Product\Models\VariableValueRef;
use MojaHedi\Product\Models\Variant;

class ProductRepository implements RepositoryInterface
{
    private $model = Product::class;



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



    //DONE
    public function getProductsVariants()
    {
        $products = Product::with('variants')->get();

        $data = [];

        foreach ($products as $products_detail) {

            $data[$products_detail->id] = $products_detail->getAttributes();
            $data[$products_detail->id]['price'] = $products_detail->current_price();

            $data[$products_detail->id]['variants'] = [];
            foreach ($products_detail->variants as $variant) {
                $data[$products_detail->id]['variants'][$variant->id] = $variant->getAttributes();
                $data[$products_detail->id]['variants'][$variant->id]['variant_code'] = $products_detail->code."-". $variant->code;


                $variable_groups = $variant->variables->groupBy('variable_ref_id');
                foreach ($variable_groups as $variable_group) {
                    $group = [];
                    $items = [];
                    foreach ($variable_group as $variable) {
                        $variable->variable_value_ref;
                        $variable_ref = VariableRef::find($variable->variable_ref_id);
                        $variable_value_ref = VariableValueRef::find($variable->variable_value_ref_id);

                        $group = [
                            'id' => $variable_ref->id,
                            'name' => $variable_ref->name,
                            'code' => $variable_ref->code
                        ];
                        $items[] = [
                            'id' => $variable_value_ref->id,
                            'value' => $variable_value_ref->value,
                            'extra_price' => $variable->extra_price,
                            'total_price' => $variable->extra_price + $variant->extra_price + $products_detail->current_price()->price
                        ];
                    }

                    $group['items'] = $items;


                    $data[$products_detail->id]['variants'][$variant->id]['variables'] = $group;
                }
            }
        }

        return $data;
    }

    //DONE
    public function getProductVariants( $product_id )
    {
        $products = Product::with('variants')->wehere('id', '=', $product_id)->get();

        $data = [];

        foreach ($products as $products_detail) {
            $data[$products_detail->id] = $products_detail->getAttributes();

            $data[$products_detail->id]['variants'] = [];
            foreach ($products_detail->variants as $variant) {
                $data[$products_detail->id]['variants'][$variant->id] = $variant->getAttributes();
                $data[$products_detail->id]['variants'][$variant->id]['variant_code'] = $products_detail->code."-". $variant->code;


                $variable_groups = $variant->variables->groupBy('variable_ref_id');
                foreach ($variable_groups as $variable_group) {
                    $group = [];
                    $items = [];
                    foreach ($variable_group as $variable) {
                        $variable->variable_value_ref;
                        $variable_ref = VariableRef::find($variable->variable_ref_id);
                        $variable_value_ref = VariableValueRef::find($variable->variable_value_ref_id);

                        $group = [
                            'id' => $variable_ref->id,
                            'name' => $variable_ref->name,
                            'code' => $variable_ref->code
                        ];
                        $items[] = [
                            'id' => $variable_value_ref->id,
                            'value' => $variable_value_ref->value,
                            'extra_price' => $variable->extra_price
                        ];
                    }

                    $group['items'] = $items;


                    $data[$products_detail->id]['variants'][$variant->id]['variables'] = $group;
                }
            }
        }

        return $data;
    }

}
