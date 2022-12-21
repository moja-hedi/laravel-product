<?php

namespace MojaHedi\Product\Repositories;

use Illuminate\Database\Eloquent\Model;
use MojaHedi\Product\Models\Product;

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

    public function getProductVariants( Model $model ){
        return $model->variants();
    }
}
