<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','category_id', 'name','price','stock'];

    public function getRecords($start, $length, $searchValue = '')
    {
        $builder = $this->builder();
        $builder->select('*');

        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('category_id', $searchValue)
                ->orLike('name', $searchValue)
                ->groupEnd();
        }

        // Count filtered without resetting builder
        $filteredBuilder = clone $builder;
        $filteredRecords = $filteredBuilder->countAllResults(false);

        $builder->limit($length, $start);
        $data = $builder->get()->getResultArray();

        return ['data' => $data, 'filtered' => $filteredRecords];
    }

    public function getTotalProduct()
    {
        $builder = $this->builder();
        return $builder->countAllResults();
    }
}