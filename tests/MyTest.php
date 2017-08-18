<?php
namespace Tests;

use GraphQL;
use GraphQL\Schema;

class MyTest extends TestCase
{
    public function testRight()
    {
        $schema = GraphQL::schema();

        $q = '
query type1 {
  type1 {
    __typename
    id
    items {
      __typename
      id
    }
  }
}
        ';

        $result = GraphQL\GraphQL::executeAndReturnResult($schema, $q);
        $expected = [
            'data' => [
                'type1' => [
                    'items' => [
                        'id' => 2,
                        '__typename' => 'Type2',
                    ],
                    '__typename' => 'Type1',
                    'id' => 1,
                ]
            ]
        ];

        $this->assertEquals($expected, $result->toArray());
    }

    public function testFailed()
    {
        $schema = GraphQL::schema();

        $q = '
query type1 {
  type1 {
    __typename
    id
    items {
      __typename
      id
      items {
        __typename
        id
        items {
          __typename
          id
        }
      }
    }
  }
}
        ';

        $result = GraphQL\GraphQL::executeAndReturnResult($schema, $q);
        $expected = [
            'data' => [
                'type1' => [
                    'items' => [
                        'id' => 2,
                        '__typename' => 'Type2',
                        'items' => [
                            'id' => 8,
                            '__typename' => 'Type3',
                            'items' => [
                                '__typename' => 'Type4',
                                'id' => 9
                            ]
                        ]
                    ],
                    '__typename' => 'Type1',
                    'id' => 1,
                ]
            ]
        ];

        $this->assertEquals($expected, $result->toArray());
    }
}
