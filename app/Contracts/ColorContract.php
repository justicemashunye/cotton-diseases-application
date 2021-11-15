<?php

namespace App\Contracts;

/**
 * Interface ColorContract
 * @package App\Contracts
 */
interface ColorContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listColors(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findColorById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createColor(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateColor(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteColor($id);
}