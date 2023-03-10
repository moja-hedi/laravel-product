<?php

namespace MojaHedi\Product\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\AliasLoader;
use MojaHedi\Product\Facades\ProductServiceFacade;
use MojaHedi\Product\Repositories\AttributeRepository;
use MojaHedi\Product\Repositories\ProductRepository;
use MojaHedi\Product\Repositories\VariantRepository;
use MojaHedi\Product\Services\ProductService;
use MojaHedi\Product\Services\VariantService;

class ProductServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->offerPublishing();
    }

    public function register()
    {

        $this->app->singleton('productRepository', ProductRepository::class);
        $this->app->singleton('attributeRepository', AttributeRepository::class);


        $this->app->singleton('MojahediProducts', function ($app) {
            $productService = new ProductService($app['productRepository'],$app['attributeRepository']);

            // $productService->setProductRepository($app['productRepository']);

            return $productService;
        });

        $loader = AliasLoader::getInstance();
        $loader->alias('MojahediProducts', ProductServiceFacade::class);

    }

    protected function offerPublishing()
    {
        if (! function_exists('config_path')) {
            // function not available and 'publish' not relevant in Lumen
            return;
        }

        $this->publishes([
            __DIR__.'/../../config/product.php' => config_path('product.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../../database/migrations/create_product_tables.php.stub' => $this->getMigrationFileName('create_product_tables.php'),
        ], 'migrations');
    }

    protected function registerCommands()
    {
        $this->commands([]);
    }

        /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @return string
     */
    protected function getMigrationFileName($migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path.'*_'.$migrationFileName);
            })
            ->push($this->app->databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
