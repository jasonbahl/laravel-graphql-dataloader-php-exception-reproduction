<?php

namespace App\Providers;

use GraphQL\GraphQL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Overblog\DataLoader\Promise\Adapter\Webonyx\GraphQL\SyncPromiseAdapter;
use Overblog\PromiseAdapter\Adapter\WebonyxGraphQLSyncPromiseAdapter;
use App\DataLoader\Type1Loader;
use App\DataLoader\Type2Loader;
use App\DataLoader\Type3Loader;
use App\DataLoader\Type4Loader;

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

    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->graphQLPromiseAdapter = new SyncPromiseAdapter();
        $this->dataLoaderPromiseAdapter = new WebonyxGraphQLSyncPromiseAdapter($this->graphQLPromiseAdapter);
    }

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

        $this->app->singleton(Type1Loader::class);
        $this->app->singleton(Type2Loader::class);
        $this->app->singleton(Type3Loader::class);
        $this->app->singleton(Type4Loader::class);
    }
}
