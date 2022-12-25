<?php

namespace MojaHedi\Product\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use MojaHedi\Product\Models\Product;
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
        $this->model::create($data);
    }
    public function update(Model $model, array $data)
    {
        $model->update(
            $data
        );
    }
    public function getFulfilled()
    {
        //TODO
    }



    public function getProductVariants($select = null, $filter = [])
    {
        if ($select == null) {
            $select = [
                'products.id as product_id',
                'products.name as product_name',
                'products.code as product_code',
                'product_prices.id as product_price_id',
                'product_prices.price as product_price',
                'product_prices.from as product_price_from',
                'product_prices.till as product_price_till',
                'variants.id as product_variant_id',
                'variants.code as product_variant_code',
                'variants.extra_price as product_variant_extra_price',
                'variants.description as product_variant_description',
                'variants.description as product_variant_description'
            ];
        }
        $result = $this->model::LEFTjoin('product_prices', 'products.id', '=', 'product_prices.product_id')
        ->leftjoin('variants', 'products.id', '=', 'variants.product_id')
        ->select($select);

        if ($filter) {
            $result->where($filter);
        }

        return $result->get();
    }

    /**
     *
     */
    public function getProductVariantsDetails2($prouct_id)
    {
        $select = [
            'products.id as product_id',
            'products.name as product_name',
            'products.code as product_code',
            'product_prices.id as product_price_id',
            'product_prices.price as product_price',
            'product_prices.from as product_price_from',
            'product_prices.till as product_price_till',
            'variants.id as product_variant_id',
            'variants.code as product_variant_code',
            'variants.extra_price as product_variant_extra_price',
            'variants.description as product_variant_description',
            'variants.description as product_variant_description',
            'variable_value_refs.id as variable_value_ref_id',
            'variable_value_refs.value as variable_value_ref_value',
            'variable_type_refs.id as variable_type_ref_id',
            'variable_type_refs.name as variable_type_ref_name',
            'variable_refs.id as variable_ref_id',
            'variable_refs.name as variable_ref_name',
            'variable_refs.code as variable_ref_code'
        ];
        $result = $this->model::LEFTjoin('product_prices', 'products.id', '=', 'product_prices.product_id')
        ->leftjoin('variants', 'products.id', '=', 'variants.product_id')
        ->leftjoin('variables', 'variants.id', '=', 'variables.variant_id')
        ->leftjoin('variable_value_refs', 'variable_value_refs.id', '=', 'variables.variable_value_ref_id')
        ->leftjoin('variable_refs', 'variable_refs.id', '=', 'variable_value_refs.variable_ref_id')
        ->leftjoin('variable_type_refs', 'variable_type_refs.id', '=', 'variable_refs.variable_type_ref_id')
        ->select($select)
        ->selectRaw('(product_prices.price + variants.extra_price) as total_price')
        ->where('products.id', '=', $prouct_id);

        // echo $result->toSql();exit;
        return $result->get();
    }

    //DONE
    public function getProductsVariants()
    {
        $products = Product::with('variants')->get();

        $data = [];

        foreach ($products as $products_detail) {
            $data[] = $products_detail->id;
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

    public function getProductVariantsDetailbc($select = null, $filter = [])
    {
        if ($select == null) {
            $select = [
                'products.id as product_id',
                'products.name as product_name',
                'products.code as product_code',
                'product_prices.id as product_price_id',
                'product_prices.price as product_price',
                'product_prices.from as product_price_from',
                'product_prices.till as product_price_till',
                'variants.id as product_variant_id',
                'variants.code as product_variant_code',
                'variants.extra_price as product_variant_extra_price',
                'variants.description as product_variant_description',
                'variants.description as product_variant_description',
                'variable_value_refs.id as variable_value_ref_id',
                'variable_value_refs.value as variable_value_ref_value',
                'variable_type_refs.id as variable_type_ref_id',
                'variable_type_refs.name as variable_type_ref_name',
                'variable_refs.id as variable_ref_id',
                'variable_refs.name as variable_ref_name',
                'variable_refs.code as variable_ref_code'
            ];
        }
        $result = $this->model::LEFTjoin('product_prices', 'products.id', '=', 'product_prices.product_id')
        ->leftjoin('variants', 'products.id', '=', 'variants.product_id')
        ->leftjoin('variables', 'variants.id', '=', 'variables.variant_id')
        ->leftjoin('variable_value_refs', 'variable_value_refs.id', '=', 'variables.variable_value_ref_id')
        ->leftjoin('variable_refs', 'variable_refs.id', '=', 'variable_value_refs.variable_ref_id')
        ->leftjoin('variable_type_refs', 'variable_type_refs.id', '=', 'variable_refs.variable_type_ref_id')
        ->select($select);

        if ($filter) {
            $result->where($filter);
        }

        echo $result->toSql();
        exit;
        return $result->get();
    }
}
