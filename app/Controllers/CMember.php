<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\MCustomer;
use App\Models\MAdmin;
use App\Models\MProducts;
use App\Models\MWishlist;
use App\Models\MOrders;

class CMember extends Controller
{
   
    
    public function index()
    {
        $session = \Config\Services::session();
        $model = new MCustomer();
        $user = $model->GetUser($session->get('email'))->getResult();
        $userdata = array();
        helper('cookie');
        //print_r($this->response->getCookie('remember'));
        //print_r(get_cookie('remember'));
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
        //echo view('cart',$data);
        echo view('bscart', $data);
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

    public function RemoveFromCart($item)
    {
        $session = \Config\Services::session();
        $cart = $session->get('cart');
        unset($cart[$item]);
        $session->set('cart',$cart);
        return redirect()->to(base_url().'/Cart');
    }

    public function Logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to('/');
    }

    public function WishList()
    {
        $session = \Config\Services::session();
        $model = new MCustomer();
        $user = $model->GetID($session->get('email'))->getResult();
        foreach ($user as $row)
            $cid = $row->customerNumber;
        $model = new MWishlist();
        $wl = $model->GetItems($cid);
        /*$data = [
            'wishlist' => $wl->getResult(),
        ];*/
        $model = new MProducts();
        $wish = array();
        //print_r($wl->getResult());
        
        foreach ($wl->getResult() as $item){
            //print_r($item);
            //echo "<br>";
            $tmp = $model->GetProductByID($item->produceCode)->getResult();
            //print_r($tmp);
            array_push($wish,$tmp);
        }
        //echo "<br>";
        //print_r($wish);
        $data = [
            'wishlist' => $wish,
        ];
        echo view('head.php');
        echo view('/memberHeader');
        //echo view('cart',$data);
        echo view('wishlist', $data);
        echo view('footer');
    }

    public function AddToWishlist($item)
    {
        $session = \Config\Services::session();
        $model = new MCustomer();
        $user = $model->GetID($session->get('email'))->getResult();
        foreach ($user as $row)
            $cid = $row->customerNumber;
        $model = new MWishlist();
        $entry = [
            'customerNumber' => $cid,
            'produceCode' => $item
        ];
        $model->save($entry);
        return redirect()->to(base_url().'/BrowseProducts');
    }

    public function RemoveFromWishlist($item)
    {
        $session = \Config\Services::session();
        $model = new MCustomer();
        $user = $model->GetID($session->get('email'))->getResult();
        foreach ($user as $row)
            $cid = $row->customerNumber;
        $model = new MWishlist();
        $model->DeleteItem($cid,$item);
        return redirect()->to(base_url().'/Wishlist');
    }

    public function Orders()
    {
        $session = \Config\Services::session();
        $model = new MCustomer();
        $user = $model->GetID($session->get('email'))->getResult();
        foreach ($user as $row)
            $cid = $row->customerNumber;
        $model = new MOrders();
        $ord = $model->GetOrders($cid);
        $data =[
            'orders' => array(),
            'itemCounts' =>array(),
        ];
        foreach ($ord->getResult() as $item)
            array_push($data['orders'],$item);
        //$ord = $model->GetQuantityOnOrder();
        //print_r($data['orders']);
        foreach ($data['orders'] as $item)
            array_push($data['itemCounts'],$model->GetQuantityOnOrder($item->orderNumber));
        
        //print_r($data);
        echo view('head.php');
        echo view('/memberHeader');
        echo view('orderlist',$data);
        echo view('footer');

    }

}