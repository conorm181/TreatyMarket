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
    
    public function AddItemToOrder($pid,$oid,$quan)
    {
        $db = \Config\Database::connect();
        $model = new MProducts();
        $price = ($model->GetProductByID($pid)->getResult())[0]->bulkSalePrice;
        
        $newEntry = [
            'orderNumber' => $oid,
            'productCode' => $pid,
            'quantityOrdered' => $quan,
            'priceEach' => $price
        ];
        $model = new MOrderDetails();
        $model->save($newEntry);
    }

    public function DeleteItem($id,$oid)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('orderDetails');
        $builder->where('productCode',$id);
        $builder->where('orderNumber',$oid);
        $builder->limit(1);
        return $builder->delete();
    }

    
    
    
} 