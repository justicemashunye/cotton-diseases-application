<?php

namespace App\Contracts;

/**
 * Interface ShapeContract
 * @package App\Contracts
 */
interface ShapeContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listShapes(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findShapeById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createShape(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateShape(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteShape($id);
}