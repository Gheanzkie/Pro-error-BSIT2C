<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesItemModel extends Model
{
    protected $table = 'sales_item';
    protected $primaryKey = 'id';

    protected $allowedFields = ['sale_id', 'product_id', 'quantity', 'subtotal'];

    public function getItemsBySale($sale_id)
    {
        return $this->where('sale_id', $sale_id)->findAll();
    }

    public function getTotalQty($sale_id)
    {
        return $this->where('sale_id', $sale_id)
                    ->selectSum('quantity')
                    ->first()['quantity'] ?? 0;
    }
}