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


    /**
     * Create product with price
     */
    public function createProduct(array $product_data, $price = 0)
    {
        $product = $this->create($product_data);
        ProductPrice::create([
            'price' => $price,
            'product_id' => $product->id,
            'from' => Carbon::now(),
            'till' => null
        ]);
        return $product;
    }

    //DONE
    public function getProductsVariants()
    {
        
    }


}
