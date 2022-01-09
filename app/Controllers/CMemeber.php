<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\MCustomer;
use App\Models\MAdmin;
use App\Models\MProducts;

class CMemeber extends Controller
{
   
    
    public function index()
    {
        
        $sess = ['email','userType'];
        //$sess = ['email','pass_word','userType'];
        $session = session();
        $session->remove($sess);
        $data = [];
        
        echo view('head.php',$data);
        echo view('/GeneralHeader');
        echo "<h2 style=\"text-align: center\">Welcome To Treaty Market!</h2>";
        echo view('footer');
            
	}




}