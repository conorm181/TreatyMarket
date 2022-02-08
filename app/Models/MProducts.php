<?php

namespace App\Models;
use CodeIgniter\Model;


class MProducts extends Model
{
    protected $table = 'products';

    protected $allowedFields = ['produceCode','description','category','supplier','quantityInStock', 'bulkBuyPrice', 'bulkSalePrice', 'photo'];
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
    
    public function GetProducts($name ="")
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('products');
        $builder->select();
        if($name!="")
            $builder->like('description',$name);
        $query = $builder->get();
        return $query;
    }
    
    public function GetProductByID($id)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('products');
        $builder->select();
        $builder->where('produceCode',$id);
        $builder->limit(1);
        $query = $builder->get();
        return $query;
    }

    public function DeleteProduct($id)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('products');
        $builder->where('produceCode',$id);
        $builder->limit(1);
        return $builder->delete();
    }

    public function AddProduct($data)
    {
        $db = \Config\Database::connect();
        $model = new MProducts();
        return $model->save($data);
    }
    
    
    
    
    
    
    
    
    
    
    
} 
