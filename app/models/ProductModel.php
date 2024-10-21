<?php
class ProductModel
{
    public function getProductLists()
    {
        return [
            'item1',
            'item2',
            'item3',
        ];
    }

    public function getProductDetails($id)
    {
        $data = ['item1', 'item2', 'item3'];
        return $data[$id];
    }
}