<?php

namespace MojaHedi\Product\Services;

use MojaHedi\Product\Models\Product;
use MojaHedi\Product\Models\Template;

class ProductService
{

    protected $productRepository;
    // protected $variantRepository;


    public function __construct($productRepository){
        $this->productRepository = $productRepository;
    }



    //create new product
    public function createProduct( $data )
    {
        return $this->productRepository->create( $data );
    }

    // //DONE
    public function getProductVariants( $product_id )
    {
        echo "hi";
        // return $this->productRepository->getProductVariants( $product_id);
    }

    // //DONE
    // public function getProductsVariants( )
    // {
    //     return $this->productRepository->getProductsVariants( );
    // }

    // public function getProducts()
    // {
    //     return $this->productRepository->getAll();
    // }

    // public function getProduct($product_id){
    //     return $this->productRepository->getById($product_id);
    // }

    // public function deleteProduct(Product $product)
    // {
    //     $this->productRepository->delete($product);
    // }

    // public function craeteProduct($data)
    // {
    //     return $this->productRepository->create($data);
    // }

    // public function updateProduct( Product $product ,$data)
    // {
    //     return $this->productRepository->update($product, $data);
    // }

    // public function setProductPrice( Product $product, $price = 0){
    //     return $this->productRepository->setPrice($product, $price);
    // }

    // // variants service


    // public function deleteVariantVariable( Variant $variant , $variable_value_ref_id )
    // {
    //     return $this->variantRepository->deleteVariable($variant, $variable_value_ref_id);
    // }
}
