<?php

namespace MojaHedi\Product\Repositories;

use MojaHedi\Product\Models\TemplateAttributeValue;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MojaHedi\Product\Models\Attribute;
use MojaHedi\Product\Models\Product;
use MojaHedi\Product\Models\Template;
use MojaHedi\Product\Models\TemplateAttributeLine;
use Ramsey\Uuid\Uuid;

class ProductRepository implements RepositoryInterface
{
    private $product = Product::class;
    private $template = Template::class;
    private $attribute = Attribute::class;
    private $template_attribute_value = TemplateAttributeValue::class;
    private $template_attribute_line = TemplateAttributeLine::class;



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

    public function addVariants( $template_id, $attribute_id, $attribute_values ){
        try {

            Log::info("at the begining");
            DB::beginTransaction();
            $template = $this->template::find($template_id);
            $attribute = $this->attribute::find($attribute_id);

            //TODO: check to prevent create duplicate relation based on template_id, attribute_id
            //add atribute line
            $template_attribute_line = $this->template_attribute_line::create(
                [
                    'template_id' => $template_id,
                    'attribute_id' => $attribute_id,
                    'value_count' => 0
                ]
            );

            Log::info("get attribute lines");

            //add attributes
            foreach($attribute_values as  $attribute_value_id){
                $this->template_attribute_value::create([
                    'attribute_value_id' => $attribute_value_id,
                    'attribute_line_id' => $template_attribute_line->id,
                    'extra_price' => 0,
                    'attribute_id' => $attribute_id,
                    'template_id' => $template_id,
                ]);
            }

            //call proc 1

            //ceate 2D array of all value ids

            Log::info("calculate 2d arrays");
            $template_attributes = $this->template_attribute_line::where('template_id', '=', $template_id)->get();
            $product_attribute_values_combination = [];
            foreach($template_attributes as $template_attribute){
                $template_attribute_values = $this->template_attribute_value::where('attribute_line_id','=',$template_attribute->id)->where('template_id', '=', $template_id)->get();

                $items = [];
                foreach($template_attribute_values as $template_attribute_value){
                    array_push( $items, $template_attribute_value->attribute_value_id );
                }

                $product_attribute_values_combination[] = $items;

            }
            //get all combination of items
            //dd($product_attribute_values_combination);

            $variant_combinations = getCombination($product_attribute_values_combination);

            Log::info("combination calculated");
            //store all combinations
            $template->products()->delete();

            Log::info("old variant deleted");
            foreach( $variant_combinations as $combuination){
                Log::info($combuination ."_". $template_id);
                $data = [
                    'template_id' => $template_id,
                    'code' => Uuid::uuid6(),
                    'barcode' => null,
                    'combination_indices' => $combuination
                ];
                Log::info(print_r($data, true));
                $p = $this->product::create($data);
                Log::info($p->id);
            }

            DB::commit();
            Log::info("all things commited");
        }
        catch(Exception $e)
        {
            Log::info("Error on create variant");
            DB::rollBack();
            Log::info($e->getMessage());
        }

    }





}
