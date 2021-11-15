<?php
namespace App\Contracts;

/**
 * Interface StageContract
 * @package App\Contracts
 */
interface StageContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listStages(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findStageById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createStage(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateStage(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteStage($id);
}