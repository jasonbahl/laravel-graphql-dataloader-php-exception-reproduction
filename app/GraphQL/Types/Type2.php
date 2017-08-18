<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\DataLoader\Type3Loader;

class Type2 extends GraphQLType {

    private $loader;

    protected $attributes = [
        'name' => 'Type2',
        'description' => 'Type 2',
    ];

    public function __construct($attributes = [], Type3Loader $loader)
    {
        parent::__construct($attributes);
        $this->loader = $loader;
    }

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the item'
            ],
            'items' => [
                'type' => GraphQL::type('Type3'),
                'description' => 'The child items'
            ]
        ];
    }

    public function resolveItemsField()
    {
        return $this->loader->load(8);
    }
}
