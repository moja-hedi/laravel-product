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

    //DONE
    public function getProductVariants( $product_id )
    {
        return $this->productRepository->getProductVariants( $product_id);
    }

    //DONE
    public function getProductsVariants( )
    {
        return $this->productRepository->getProductsVariants( );
    }




}
