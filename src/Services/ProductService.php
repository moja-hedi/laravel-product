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

    public function getProductVariants( $filter = [] )
    {
        return $this->productRepository->getProductVariants( null, $filter);
    }

    public function getProductVariantsDetails( $product_id )
    {
        return $this->productRepository->getProductVariantsDetails( $product_id );
    }

    //DONE
    public function getProductsVariants( )
    {
        return $this->productRepository->getProductsVariants( );
    }




}
