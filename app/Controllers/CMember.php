<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\MCustomer;
use App\Models\MAdmin;
use App\Models\MProducts;

class CMember extends Controller
{
   
    
    public function index()
    {
        $session = \Config\Services::session();
        $model = new MCustomer();
        $user = $model->GetUser($session->get('email'))->getResult();
        //print_r($user);
        foreach ($user as $row){
        $userdata = [
            'name' => $row->customerName,
            'fname' => $row->contactFirstName,
            'lname' => $row->contactLastName,
        ];
        break;
        }
        $session->set('userdata',$userdata);
        echo view('head.php');
        echo view('/memberHeader');
        echo "<h2 style=\"text-align: center\">Welcome Back ".$userdata['fname']." ".$userdata['lname']."</h2>";
        echo view('footer');
            
	}

    public function Cart()
    {
        $session = \Config\Services::session();
        $cart = array();
        $products = array_keys($session->get('cart'));
        //print_r($products);
        $model = new MProducts();
        foreach ($products as $entry){
            array_push($cart,$model->GetProductByID($entry)->getResult());
        }

        $data = [
            'cart' => $session->get('cart'),
            'productarr' => $cart,
        ];
        

        //print_r($cart);
        echo view('head.php');
        echo view('/memberHeader');
        echo view('cart',$data);
        echo view('footer');
    }

    public function AddToCart($item)
    {
        $session = \Config\Services::session();
        $cart = $session->get('cart');
        $cart+=array($item=>$_POST['quantity']);
        $session->set('cart',$cart);
        return redirect()->to(base_url().'/BrowseProducts');
    }

    public function Logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to('/');
    }

}