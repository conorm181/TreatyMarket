<?php

namespace App\Models;
use CodeIgniter\Model;


class MAdmin extends Model
{
    protected $table = 'administrators';

    protected $allowedFields = ['adminNumber','firstName','lastName','email','password'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    
   
    
    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }
    
    protected function beforeUpdate(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }
    
    protected function passwordHash(array $data){
        if(isset($data['data']['password']))
        {
            $data['data']['password'] = hash('md5',$data['data']['password']);
            echo hash('md5',$data['data']['password']);
        }
        return $data;
    }
    
    public function Login($newData)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('administrators');
        $builder->select('email');
        $builder->where('email',$newData['email']);
        $builder->where('password',hash('md5',$newData['password']));
        $query = $builder->countAllResults();
        return $query;
    }
        
    
    
    
    
    
    
    
    
    
    
    
    
} 
