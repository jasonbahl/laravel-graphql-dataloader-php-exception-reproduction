<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class Type1 extends GraphQLType {

    protected $attributes = [
        'name' => 'Type1',
        'description' => 'Type 1',
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the item'
            ],
            'items' => [
                'type' => Type::nonNull(Type::listOf(GraphQL::type('Type2'))),
                'description' => 'The child items'
            ]
        ];
    }

    public function resolveItemsField()
    {
        return [];
    }
}
