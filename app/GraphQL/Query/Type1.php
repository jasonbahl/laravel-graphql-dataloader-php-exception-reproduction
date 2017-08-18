<?php
namespace App\GraphQL\Query;

use App\DataLoader\Type1Loader;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class Type1 extends Query {

    /**
     * @var Type1Loader
     */
    private $loader;

    public function __construct($attributes = [], Type1Loader $loader)
    {
        parent::__construct($attributes);
        $this->loader = $loader;
    }

    protected $attributes = [
        'name' => 'type1'
    ];

    public function type()
    {
        return GraphQL::type('Type1');
    }

    public function resolve()
    {
        return $this->loader->load(1);
    }
}