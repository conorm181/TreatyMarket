<?php

namespace App\Models;
use CodeIgniter\Model;


class MOrders extends Model
{
    protected $table = 'orders';

    protected $allowedFields = ['orderNumber', 'orderDate', 'requiredDate', 'shippedDate', 'status', 'comments', 'customerNumber'];
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
    
    
    public function GetOrders($cid)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('orders');
        $builder->select();
        $builder->where('customerNumber',$cid);
        return $builder->get();
    }
        
    public function GetQuantityOnOrder($oid)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('orders');
        $builder->join('orderDetails', 'orderDetails.orderNumber = orders.orderNumber','inner');
        $builder->selectSum('quantity');
        $builder->where('orderNumber',$oid);
        return $builder->get();

    }
    
    
    
    
    
    
    
    
    
    
    
} 
