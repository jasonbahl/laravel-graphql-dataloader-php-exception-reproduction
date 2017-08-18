<?php
namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class Type1 extends Query {

    protected $attributes = [
        'name' => 'type1'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Type1'));
    }

    public function resolve()
    {
        return [];
    }
}