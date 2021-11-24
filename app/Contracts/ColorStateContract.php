<?php

namespace App\Contracts;


interface ColorStateContract
{
    
    public function listColorStates(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    public function findColorStateById(int $id);

    public function createColorState(array $params);

   
    public function updateColorState(array $params);

   
    public function deleteColorState($id);
}