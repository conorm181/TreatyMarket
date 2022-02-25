<?php

namespace App\Models;
use CodeIgniter\Model;


class MAdmin extends Model
{
    protected $table = 'administrators';

    protected $allowedFields = ['adminNumber','adminFirstName','adminLastName','email','password'];
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
        if(isset($data['data']['pass_word']))
        {
            $data['data']['pass_word'] = hash('md5',$data['data']['pass_word']);
            echo hash('md5',$data['data']['pass_word']);
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
    
    public function GetUser($em)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('administrators');
        $builder = $builder->select('adminNumber,adminFirstName,adminLastName','email');
        $builder = $builder->where('email',$em);
        $builder = $builder->limit(1);
        $query = $builder->get();
        return $query;
    }
    
    public function IsAdmin($email)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('administrators');
        $builder->select('email');
        $builder->where('email',$email);
        $query = $builder->countAllResults();
        if($query==0)
        return false;
        else
        return true;
    }
    
    
    
    
    
    
    
    
    
    
} 
