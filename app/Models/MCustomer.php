<?php

namespace App\Models;
use CodeIgniter\Model;


class MCustomer extends Model
{
    protected $table = 'customers';

    protected $allowedFields = ['customerNumber','customerName','contactFirstName','contactLastName','phone','addressLine1','addressLine2','city','postalCode','country','creditLimit','email','password'];
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
        $builder = $db->table('customers');
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
        $builder = $db->table('customers');
        $builder = $builder->select('customerName,contactFirstName,contactLastName','email');
        $builder = $builder->where('email',$em);
        $builder = $builder->limit(1);
        $query = $builder->get();
        return $query;
    }

    public function Profile($id)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('customers');
        $builder = $builder->select();
        $builder = $builder->where('email',$id);
        $builder = $builder->limit(1);
        $query = $builder->get();
        return $query;
    }
    
    
    public function GetID($em)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('customers');
        $builder = $builder->select('customerNumber');
        $builder = $builder->where('email',$em);
        $builder = $builder->limit(1);
        $query = $builder->get();
        return $query;
    }

    public function EditUser($data){
        $db = \Config\Database::connect();
        if(isset($data['password']))
            $data['password'] = hash('md5',$data['password']);
        $model = new MProducts();
        $builder = $this->builder();
        $builder = $db->table('customers');
        $builder = $builder->where('customerNumber',$data['customerNumber']);
        return $builder->update($data);
    }
    
    public function IsCustomer($email)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('customers');
        $builder->select('email');
        $builder->where('email',$email);
        $query = $builder->countAllResults();
        if($query==0)
        return false;
        else
        return true;
    }
    
    
    
    
    
    
} 

