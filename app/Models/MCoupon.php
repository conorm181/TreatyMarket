<?php

namespace App\Models;
use CodeIgniter\Model;


class MCoupon extends Model
{
    protected $table = 'coupon';

    protected $allowedFields = ['idcoupon', 'code', 'discount'];
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

    public function getDiscount($code)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('coupon');
        $builder->select('discount');
        $builder->like('code',$code);
        $query = $builder->get();
        if($builder->countAllResults() > 0)
            return $query;
        else
            return false;
    }





}