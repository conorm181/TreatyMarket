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
    
    public function EditProduct($data)
    {
        $db = \Config\Database::connect();
        $model = new MProducts();
        $builder = $this->builder();
        $builder = $db->table('products');
        $builder = $builder->where('produceCode',$data['produceCode']);
        return $builder->update($data);
    }
    
    public function GetImage($id){
        $db = \Config\Database::connect();
        $model = new MProducts();
        $builder = $this->builder();
        $builder = $builder->select('photo');
        $builder = $builder->where('produceCode',$id);
        $builder = $builder->limit(1);
        return $builder->get();

    }
    
    public function CheckStock($id,$q)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('products');
        $builder->select('quantityInStock');
        $builder->where('produceCode',$id);
        $builder->limit(1);
        $query = $builder->get();
        if($query->getResult()[0]->quantityInStock>=$q)
        return true;
        else
        return false;
    }
    
    
    
    
    
    
} 
