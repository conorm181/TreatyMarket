<?php

namespace App\Models;
use CodeIgniter\Model;


class MOrderDetails extends Model
{
    protected $table = 'orderDetails';

    protected $allowedFields = ['orderNumber', 'productCode', 'quantityOrdered', 'priceEach'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    
   
    
    protected function beforeInsert(array $data)
    {
        return $data;
    }
    
    protected function beforeUpdate(array $data)
    {
        return $data;
    }
    
    public function OrderDetails($oid)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('orderDetails');
        $builder->select();
        $builder->like('orderNumber',$oid);
        $query = $builder->get();
        return $query;
    }
    
    public function AddItemToOrder($pid,$oid,$quan,$p)
    {
        $db = \Config\Database::connect();
        $newEntry = [
            'orderNumber' => $oid,
            'productCode' => $pid,
            'quantityOrdered' => $quan,
            'priceEach' => $p
        ];
        $model = new MOrderDetails();
        $model->save($newEntry);
    }
    
    
} 