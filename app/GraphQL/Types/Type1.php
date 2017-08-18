<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\DataLoader\Type2Loader;

class Type1 extends GraphQLType {

    private $loader;

    protected $attributes = [
        'name' => 'Type1',
        'description' => 'Type 1',
    ];

    public function __construct($attributes = [], Type2Loader $loader)
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
                'type' => GraphQL::type('Type2'),
                'description' => 'The child items'
            ]
        ];
    }

    public function resolveItemsField()
    {
        return $this->loader->load(2);
    }
}
