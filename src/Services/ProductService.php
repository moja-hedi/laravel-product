<?php

namespace MojaHedi\Product\Services;

class ProductService
{

    protected $productRepository;


    public function __construct($productRepository){
        $this->productRepository = $productRepository;

    }

    public function test(){
        echo "hi";
    }

    public function getProductsDetail()
    {
        return $this->productRepository->getAll();
    }


}
