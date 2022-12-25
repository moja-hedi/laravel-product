<?php

namespace MojaHedi\Product\Services;

use MojaHedi\Product\Models\Product;

class ProductService
{

    protected $productRepository;


    public function __construct($productRepository){
        $this->productRepository = $productRepository;

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

    public function getProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getProduct($product_id){
        return $this->productRepository->getById($product_id);
    }

    public function delete(Product $product)
    {
        $this->productRepository->delete($product);
    }


    public function craete($data)
    {
        return $this->productRepository->create($data);
    }

    public function update( Product $product ,$data)
    {
        return $this->productRepository->update($product, $data);
    }

}
