<?php
namespace App\DataLoader;

class Type1Loader extends Loader {

    public function batchLoad($keys)
    {
        $items = [];
        foreach ($keys as $key) {
            $items[] = [
                'id' => $key
            ];
        }

        return $this->promiseAdapter->createFulfilled($items);
    }
}