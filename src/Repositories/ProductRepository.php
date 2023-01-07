<?php

namespace MojaHedi\Product\Repositories;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MojaHedi\Product\Models\Product;
use MojaHedi\Product\Models\Template;
use MojaHedi\Product\Models\ProductPrice;
use MojaHedi\Product\Models\Variable;
use MojaHedi\Product\Models\VariableRef;
use MojaHedi\Product\Models\VariableValueRef;
use MojaHedi\Product\Models\Variant;

class ProductRepository implements RepositoryInterface
{
    private $product = Product::class;
    private $template = Template::class;



    public function getAll()
    {
        return $this->template::with('products')->get();
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
        try{
            DB::beginTransaction();


            $template_data = [
                'name' => $data['name'],
                'description' => $data['description'],
                'weight' => $data['wight'] ?? 0,
                'height' => $data['height'] ?? 0,
                'length' => $data['length'] ?? 0,
                'is_saleable' => $data['is_saleable'] ?? true,
                'code' => $data['code'],
            ];

            $template = $this->template::create($template_data);

            $product_data = [
                'template_id' => $template->id,
                'code' => $data['code'],
                'barcode' => $data['barcode'],
                'combination_indices' => '',
                'valume' =>  $data['valume'] ?? 0,
                'width' =>  $data['width'] ?? 0,
                'weight' => $data['wight'] ?? 0,
                'height' => $data['height'] ?? 0,
                'length' => $data['length'] ?? 0,
            ];
            $this->product::create($product_data);

            Log::info("new product created");


            DB::commit();

            return $template;
        }
        catch(\Exception $e)
        {
            Log::info("Error on create new product");
            DB::rollBack();
            Log::info($e->getMessage());
        }


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
