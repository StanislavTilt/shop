<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\QueryBuilder\QueryBuilderRequest;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CartProduct;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        QueryBuilderRequest::setArrayValueDelimiter('|');
        JsonResource::withoutWrapping();

        Relation::morphMap([
            'products' => Product::class,
            'cartProducts' => CartProduct::class,
            'brands' => Brand::class,
            'categories' => Category::class,
        ]);
    }
}
