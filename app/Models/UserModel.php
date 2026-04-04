<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'username', 'password', 'role', 'status', 'name', 'phone', 'created_at', 'updated_at', 'deleted_at'
    ];

    // Fetch paginated & searchable records (for datatable)
    public function getRecords($start, $length, $searchValue = '')
    {
        $builder = $this->builder();
        $builder->select('*');

        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('username', $searchValue)
                ->orLike('name', $searchValue)
                ->groupEnd();
        }

        $filteredBuilder = clone $builder;
        $filteredRecords = $filteredBuilder->countAllResults();

        $builder->limit($length, $start);
        $data = $builder->get()->getResultArray();

        return ['data' => $data, 'filtered' => $filteredRecords];
    }
    public function getTotalStaff()
    {
        $builder = $this->builder();
        return $builder->countAllResults(false);
    }
}