<?php

namespace MojaHedi\Product\Facades;

use Illuminate\Support\Facades\Facade;

class ProductServiceFacade extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'ProductsService';
    }
}
