<?php

namespace App\Contracts;

/**
 * Interface DiseaseContract
 * @package App\Contracts
 */
interface DiseaseContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listDiseases(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findDiseaseById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createDisease(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateDisease(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteDisease($id);
}