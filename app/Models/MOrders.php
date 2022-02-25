<?php

namespace App\Models;
use CodeIgniter\Model;
use DateTime;


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
    
    public function GetAllOrders()
    {
        $db = \Config\Database::connect();
        $model = new MOrders();
        $data = [
            'pages' => $model->join('orderDetails', 'orderDetails.orderNumber = orders.orderNumber','inner')->select('orders.orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber, SUM(quantityOrdered) as orderCount, SUM(quantityOrdered*priceEach) as priceTot')->groupby('orderNumber')->paginate(10),
            'pager' => $model->pager,
        ];
        /*
        $builder = $this->builder();
        $builder = $db->table('orders');
        $builder->join('orderDetails', 'orderDetails.orderNumber = orders.orderNumber','inner');
        $builder->select('orders.orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber, SUM(quantityOrdered) as orderCount, SUM(quantityOrdered*priceEach) as priceTot');
        $builder->groupby('orderNumber');
        */
        return $data;
    }

    public function GetOrders($cid)
    {
        $db = \Config\Database::connect();
        $builder = $this->builder();
        $builder = $db->table('orders');
        $builder->join('orderDetails', 'orderDetails.orderNumber = orders.orderNumber','inner');
        $builder->select('orders.orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber, SUM(quantityOrdered) as orderCount, SUM(quantityOrdered*priceEach) as priceTot');
        $builder->groupby('orderNumber');
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

    public function MakeNewOrder($cid,$reqDate)
    {
        $db = \Config\Database::connect();
        $newEntry = [
            'orderDate' => date("Y-m-d"),
            'requiredDate' => $reqDate,
            'customerNumber' => $cid
        ];
        $model = new MOrders();
        $model->save($newEntry);
        $builder = $this->builder();
        $builder = $db->table('orders');
        $builder->select('orderNumber');
        $builder->where('customerNumber',$cid);
        $builder->orderBy('orderDate', 'DESC');
        $builder->limit(1);
        return $builder->get();
        
    }

    public function GetOrderPrice($oid)
    {
        $db = \Config\Database::connect();
        $model = new MOrders();
        $builder = $this->builder();
        $builder = $db->table('orderDetails');
        $builder->select('SUM(quantityOrdered*priceEach) as priceTot');
        $builder->where('orderNumber',$oid);
        $builder->groupby('orderNumber');
        $builder->limit(1);
        return $builder->get();
        
    }

    public function GetComment($id)
    {
        $db = \Config\Database::connect();
        $model = new MOrders();
        $builder = $this->builder();
        $builder = $db->table('orders');
        $builder = $builder->select('comments');
        $builder = $builder->where('orderNumber',$id);
        $builder->limit(1);
        return $builder->get();
        
    }
    
    public function SetComment($id,$c)
    {
        $db = \Config\Database::connect();
        $model = new MOrders();
        $builder = $this->builder();
        $builder = $db->table('orders');
        $builder = $builder->set('comments',$c);
        $builder = $builder->where('orderNumber',$id);
        return $builder->update();
        
    }
    
    public function MakeOrder($id)
    {
        $db = \Config\Database::connect();
        $temp = new MOrders();
        $oid = $temp->GetNextOID();
        $tdy = date('Y-m-d');
        $newEntry = [
            'orderNumber' => $oid,
            'orderDate' => $tdy,
            'requiredDate' => date('Y-m-d', strtotime($tdy. ' + 7 days')),
            'status' => "Awaiting Payement",
            'customerNumber' => $id
        ];
        $model = new MOrders();
        $model->save($newEntry);
        return $oid;
    }
    
    public function GetNextOID()
    {
        $db = \Config\Database::connect();
        $model = new MOrders();
        $builder = $this->builder();
        $builder = $db->table('orders');
        $builder = $builder->select('orderNumber');
        $builder = $builder->orderBy('orderNumber',"DESC");
        $builder->limit(1);
        $row = $builder->get();
        return $row->getResult()[0]->orderNumber+1;
    }
    
    public function GetDiscount($oid)
    {
        $db = \Config\Database::connect();
        $model = new MOrders();
        $builder = $this->builder();
        $builder = $db->table('orders');
        $builder = $builder->select('discount');
        $builder = $builder->where('orderNumber',$oid);
        $builder->limit(1);
        $row = $builder->get();
        return $row->getResult()[0]->discount;
    }
    
    public function SetStatus($status,$oid)
    {
        $db = \Config\Database::connect();
        $model = new MOrders();
        $builder = $this->builder();
        $builder = $db->table('orders');
        $builder = $builder->set('status',$status);
        $builder = $builder->where('orderNumber',$oid);
        return $builder->update();
    }
    
    
} 
