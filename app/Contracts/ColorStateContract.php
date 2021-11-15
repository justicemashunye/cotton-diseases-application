<?php

namespace App\Contracts;

/**
 * Interface ColorStateContract
 * @package App\Contracts
 */
interface ColorStateContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listColorStates(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findColorStateById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createColorState(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateColorState(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteColorState($id);
}