<?php


namespace App\Providers;


use App\Repositories\Contracts\{
    BasketRepositoryInterface,
    ItemRepositoryInterface
};
use App\Repositories\EloquentMySql\{
    BasketRepository,
    ItemRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BasketRepositoryInterface::class, BasketRepository::class);
        $this->app->bind(ItemRepositoryInterface::class, ItemRepository::class);

    }
}
