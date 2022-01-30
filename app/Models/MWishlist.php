<?php

namespace App\Models;
use CodeIgniter\Model;


class MWishlist extends Model
{
    protected $table = 'wishlist';

    protected $allowedFields = ['customerNumber','produceCode'];
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
    
    public function GetItems($id)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('wishlist');
        $builder->select();
        $builder->like('customerNumber',$id);
        $query = $builder->get();
        return $query;
    }
    
    public function DeleteItem($cid,$id)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('wishlist');
        $builder->where('customerNumber',$cid);
        $builder->where('produceCode',$id);
        $builder->limit(1);
        $builder->delete();
    }

    
    
    
    
    
    
    
    
    
    
    
} 