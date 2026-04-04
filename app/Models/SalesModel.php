<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'total', 'date'];

   
    public function getAllSales()
    {
        return $this->orderBy('date', 'DESC')->findAll();
    }

    public function getTotalSales()
    {
        return $this->selectSum('total')->first()['total'] ?? 0;
    }
}