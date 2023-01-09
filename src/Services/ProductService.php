<?php

namespace MojaHedi\Product\Services;

use MojaHedi\Product\Models\Product;
use MojaHedi\Product\Models\Template;

class ProductService
{

    protected $productRepository;
    protected $attributeRepository;


    public function __construct($productRepository, $attributeRepository){
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
    }

    //create new product
    public function createProduct( $data )
    {
        return $this->productRepository->create( $data );
    }

    //create new variant
    public function createProductVariant( $template_id, $attribute_id, $attribute_values )
    {
        return $this->productRepository->addVariants( $template_id, $attribute_id, $attribute_values );
    }

    public function createAttribute( $data )
    {
        return $this->attributeRepository->create( $data );
    }

    public function getProducts()
    {
        return $this->productRepository->getAll();
    }
    
    public function getProduct($product_id)
    {
        return $this->productRepository->getProduct($product_id);
    }

    public function getAttributesValuesDetail( array $attribute_values_id)
    {
        return $this->attributeRepository->getAttributesByAttributeId( $attribute_values_id );
    }
}
