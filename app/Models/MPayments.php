<?php

namespace App\Models;
use CodeIgniter\Model;
use DateTime;


class MPayments extends Model
{
    protected $table = 'payments';

    protected $allowedFields = ['customerNumber', 'cardType', 'cardNumber', 'cardName', 'expiryDate', 'CVV', 'checkNumber', 'paymentDate', 'amount', 'orderNumber'];
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

    public function MakePayment($cid,$oid,$name,$cardn,$cvv,$m,$y,$amount)
    {
        $db = \Config\Database::connect();
        $newEntry = [
            'customerNumber' => $cid,
            'cardType' => 'Visa',
            'cardNumber' => $cardn,
            'cardName' => $name,
            'expiryDate' => $m.'/'.$y,
            'CVV' => $cvv,
            'paymentDate' => date("Y-m-d"),
            'amount' => $amount,
            'orderNumber' => $oid,
            
        ];
        $model = new MPayments();
        $model->save($newEntry);
    }
}