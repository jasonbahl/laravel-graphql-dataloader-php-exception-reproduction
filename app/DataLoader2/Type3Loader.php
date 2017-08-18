<?php
namespace App\DataLoader2;

class Type3Loader extends AbstractDataLoader
{
    /**
     * Given array of keys, loads and returns a map consisting of keys from `keys` array and loaded values
     *
     * Note that order of returned values must match exactly the order of keys.
     * If some entry is not available for given key - it must include null for the missing key.
     *
     * For example:
     * loadKeys(['a', 'b', 'c']) -> ['a' => 'value1, 'b' => null, 'c' => 'value3']
     *
     * @param array $keys
     * @return array
     */
    protected function loadKeys(array $keys)
    {
        $items = [];
        foreach ($keys as $key) {
            $items[$key] = [
                'id' => $key
            ];
        }
        return $items;
    }
}
