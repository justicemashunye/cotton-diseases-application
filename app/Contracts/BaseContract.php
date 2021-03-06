<?php
namespace App\Contracts;

/**
 * Interface BaseContract
 * @package App\Contracts
 */
interface BaseContract
{
    /**
     * Create a model instance
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update a model instance
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id);

    
    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');

    public function find(int $id);

   
    public function findOneOrFail(int $id);

   
    public function findBy(array $data);

   
    public function findOneBy(array $data);


    public function findOneByOrFail(array $data);

  
    public function delete(int $id);
}