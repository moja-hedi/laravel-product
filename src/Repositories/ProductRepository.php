<?php

namespace MojaHedi\Product\Repositories;

use Illuminate\Database\Eloquent\Model;
use MojaHedi\Product\Models\Product;

class ProductRepository implements RepositoryInterface
{
    private $model = null;



    public function getAll()
    {
        return Product::all();
    }
    public function getById($model_id)
    {
        return Product::find($model_id);
    }
    public function delete(Model $model)
    {
        Product::destroy($model->id);
    }
    public function create(array $data)
    {
        Product::create($data);
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
}
