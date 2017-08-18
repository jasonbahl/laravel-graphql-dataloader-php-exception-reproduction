<?php

namespace App\Providers;

use GraphQL\GraphQL;
use Illuminate\Support\ServiceProvider;
use Overblog\DataLoader\Promise\Adapter\Webonyx\GraphQL\SyncPromiseAdapter;
use Overblog\PromiseAdapter\Adapter\WebonyxGraphQLSyncPromiseAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var SyncPromiseAdapter
     */
    private $graphQLPromiseAdapter;
    /**
     * @var WebonyxGraphQLSyncPromiseAdapter
     */
    private $dataLoaderPromiseAdapter;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        GraphQL::setPromiseAdapter($this->graphQLPromiseAdapter);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Overblog\PromiseAdapter\PromiseAdapterInterface', function () {
            return $this->dataLoaderPromiseAdapter;
        });
        $this->app->singleton('PromiseAdapter', function () {
            return $this->graphQLPromiseAdapter;
        });
    }
}
