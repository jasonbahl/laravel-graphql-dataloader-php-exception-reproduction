<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class Type3 extends GraphQLType {

    protected $attributes = [
        'name' => 'Type3',
        'description' => 'Type 3',
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the item'
            ],
            'items' => [
                'type' => Type::nonNull(Type::listOf(GraphQL::type('Type4'))),
                'description' => 'The child items'
            ]
        ];
    }

    public function resolveItemsField()
    {
        return [];
    }
}
