<?php
namespace App\DataLoader;

use Overblog\DataLoader\DataLoader;
use Overblog\PromiseAdapter\PromiseAdapterInterface;

abstract class Loader {

    /**
     * @var PromiseAdapterInterface
     */
    protected $promiseAdapter = null;

    public function __construct(
        PromiseAdapterInterface $promiseAdapter
    ) {
        $this->promiseAdapter = $promiseAdapter;
        $this->dataLoader = new DataLoader(function ($keys) {
            return call_user_func([$this, 'batchLoad'], $keys);
        }, $promiseAdapter);
    }

    public function load($key) {
        return $this->dataLoader->load($key);
    }

    public function loadMany($keys) {
        return $this->dataLoader->loadMany($keys);
    }

    abstract function batchLoad($keys);
}
