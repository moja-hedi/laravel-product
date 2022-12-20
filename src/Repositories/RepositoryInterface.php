<?php
namespace MojaHedi\Product\Repositories;

use Illuminate\Database\Eloquent\Model;

interface  RepositoryInterface
{
    public function getAll();
    public function getById($model_id);
    public function delete( Model $model);
    public function create(array $data);
    public function update( Model $model, array $data);
    public function getFulfilled();
}
