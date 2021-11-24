<?php

namespace App\Contracts;


interface DiseasedetailContract
{
    
    public function listDiseasedetails(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    public function findDiseasedetailById(int $id);

    public function createDiseasedetail(array $params);

   
    public function updateDiseasedetail(array $params);

   
    public function deleteDiseasedetail($id);
}