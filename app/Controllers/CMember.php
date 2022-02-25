<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\MCustomer;
use App\Models\MAdmin;
use App\Models\MProducts;
use App\Models\MWishlist;
use App\Models\MOrders;
use App\Models\MOrderDetails;
use App\Models\MPayments;
use App\Models\MCoupon;
use DateTime;

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
        $discount = 0;
        if($session->getFlashdata('Coupon')!=NULL)
        {
            $discount = $session->getFlashdata('Coupon');
        }
        //print_r($products);
        $model = new MProducts();
        foreach ($products as $entry){
            array_push($cart,$model->GetProductByID($entry)->getResult());
        }

        $data = [
            'cart' => $session->get('cart'),
            'productarr' => $cart,
            'discount' =>$discount,
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
        $model = new MProducts();
        if($_POST['quantity']==""){
            if($model->CheckStock($item,1))
                $cart+=array($item=>1);
        }
        else{
            if($model->CheckStock($item,$_POST['quantity']))
                 $cart+=array($item=>$_POST['quantity']);
        }
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
        /*
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to('/');*/
        $this->session = \Config\Services::session();
        $unsetarr =
        [
            'email',
            'userType',
        ];
        $this->session->remove($unsetarr);
        //unset($_COOKIE['username']);
        setcookie("username","",-1,"/");
        return redirect()->to("/");
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
        ];
        foreach ($ord->getResult() as $item)
            array_push($data['orders'],$item);
        
        //print_r($data);
        echo view('head.php');
        echo view('/memberHeader');
        echo view('orderlist',$data);
        echo view('footer');

    }

    public function OrderDrilldown($id)
    {
        $session = \Config\Services::session();
        $model = new MCustomer();
        $user = $model->GetID($session->get('email'))->getResult();
        foreach ($user as $row)
            $cid = $row->customerNumber;
        $model = new MOrderDetails();
        $wl = $model->OrderDetails($id);
        $model = new MProducts();
        $wish = array();
        $quan = array();
        //print_r($wl->getResult());
        
        foreach ($wl->getResult() as $item){
            //print_r($item);
            //echo "<br>";
            $tmp = $model->GetProductByID($item->productCode)->getResult();
            //print_r($tmp);
            $quan[$item->productCode] = $item->quantityOrdered;
            array_push($wish,$tmp);
        }
        $model = new MOrders();
        $com = $model->GetComment($id)->getResult();
        //echo "<br>";
        //print_r($wish);
        $data = [
            'order' => $wish,
            'quantity' => $quan,
            'comment' => $com,
            'id' => $id,
            'type' => $session->get('userType'),
        ];
        echo view('head.php');
        if(session()->get('userType')=='Customer')
            echo view('memberHeader');
        else if(session()->get('userType')=='Admin')
            echo view('adminHeader');
        else
            echo view('generalHeader');
        //echo view('cart',$data);
        echo view('orderView', $data);
        echo view('footer');
    }

    public function Payment()//Make Order + give user payement screen
    {
        $session = \Config\Services::session();
        $discount = 0;
        if($session->getFlashdata('discount')!=NULL)
            $discount = $session->getFlashdata('discount');
        $shopping = $session->get('cart');
        $cart = array();
        $products = array_keys($session->get('cart'));
        //Get ID
        $model = new MCustomer();
        $user = $model->GetID($session->get('email'))->getResult();
        foreach ($user as $row)
            $cid = $row->customerNumber;
        //Make Order
        $model = new MOrders();
        $oid = $model->MakeOrder($cid);
        //Add items to Order
        $model2 = new MOrderDetails();
        foreach ($products as $entry){
            $model2->AddItemToOrder($entry,$oid,$session->get('cart')[$entry]);   
        }
        //Price
        $subtot = 0;
        foreach ($cart as $cartItem)
        {
            $subtot+=($cartItem[0]->bulkSalePrice*$shopping[$cartItem[0]->produceCode]);
        }
        $data = [
            'total' => ($subtot-$discount)+10,
            'oid' => $oid
        ];
        $session->setFlashdata('order');
        /*
        $model = new MProducts();
        foreach ($products as $entry){
            array_push($cart,$model->GetProductByID($entry)->getResult());
        }
        */
        echo view('head.php');
        echo view('/memberHeader');
        echo view('pay',$data);
        echo view('footer');


    }

    public function LatePayment($oid)
    {
        $data = [
            'oid' => $oid,
        ];

        echo view('head.php');
        echo view('/memberHeader');
        echo view('pay',$data);
        echo view('footer');
    }

    public function Checkout($oid)//Do Payement + Decrement Quantity + Set Status on Order
    {
        $session = \Config\Services::session();
        //Find Amount Due
        $pay = 0;
        $model = new MOrderDetails();
        $items = $model->OrderDetails($oid)->getResult();
        foreach($items as $product)
        {
            $pay+=($product->priceEach*$product->quantityOrdered);
        }
        $model = new MOrders();
        $pay-=$model->GetDiscount($oid);
        //Get ID
        $model = new MCustomer();
        $user = $model->GetID($session->get('email'))->getResult();
        foreach ($user as $row)
            $cid = $row->customerNumber;
        //Make Payment
        $model = new MPayments();
        $model->MakePayment($cid,$oid,$_POST['username'],$_POST['cardNumber'],$_POST['cvv'],$_POST['month'],$_POST['year'],$pay);
        //Decrement Quantity


        //Set Order Status
        $model = new MOrders();
        $model->SetStatus('In Process',$oid);
        return redirect()->to(base_url().'\/Order\/'.$oid);
    }

    public function EditOrder($id)
    {
        $session = \Config\Services::session();
        $data = [];
        $model = new MOrderDetails();
        $wl = $model->OrderDetails($id);
        $model = new MProducts();
        $wish = array();
        $quan = array();
        //print_r($wl->getResult());
        
        foreach ($wl->getResult() as $item){
            //print_r($item);
            //echo "<br>";
            $tmp = $model->GetProductByID($item->productCode)->getResult();
            //print_r($tmp);
            $quan[$item->productCode] = $item->quantityOrdered;
            array_push($wish,$tmp);
        }
        $model = new MOrders();
        $com = $model->GetComment($id)->getResult();
        //echo "<br>";
        //print_r($id);
        $data = [
            'order' => $wish,
            'quantity' => $quan,
            'comment' => $com,
            'id' => $id,
            'type' => $session->get('userType'),
        ];
        echo view('head.php');
        if(session()->get('userType')=='Customer')
            echo view('memberHeader');
        else if(session()->get('userType')=='Admin')
            echo view('adminHeader');
        else
            echo view('generalHeader');
        //echo view('cart',$data);
        echo view('editOrder', $data);
        echo view('footer');

    }

    public function RemoveFromOrder($id,$oid)
    {
        $session = \Config\Services::session();
        //$model = new MCustomer();
        //$user = $model->GetID($session->get('email'))->getResult();
        //foreach ($user as $row)
            //$cid = $row->customerNumber;
        $model = new MOrderDetails();
        $bool = $model->DeleteItem($id,$oid);
        
        if($bool = false)
            $session->setFlashdata('Delete', $bool);
        else
            $session->setFlashdata('Delete', $bool);
        return redirect()->to(base_url().'\/Order\/'.$oid);
    }

    public function ApplyCoupon()
    {
        $session = \Config\Services::session();
        $model = new MCoupon();
        if(isset($_POST['coupon']))
        {
            
            $return = $model->getDiscount($_POST['coupon'])->getResult()[0]->discount;
            $session->setFlashdata('Coupon',$return);
        }
        return redirect()->to(base_url().'/Cart');
    }

    public function Profile()
    {
        $session = \Config\Services::session();

        if($this->request->getMethod() == 'post')
        {
            $model = new MCustomer();
            $old = (array)$model->Profile($session->get('email'))->getResult()[0];
            
            if($_POST['password'] ==""){
                $data = [
                    'customerNumber' => $old['customerNumber'],
                    'customerName' => $_POST['customerName'],
                    'contactFirstName' => $_POST['contactFirstName'],
                    'contactLastName' => $_POST['contactLastName'],
                    'phone' => $_POST['phone'],
                    'addressLine1' => $_POST['addressLine1'],
                    'addressLine2' => $_POST['addressLine2'],
                    'city' =>  $_POST['city'],
                    'postalCode' => $_POST['postalCode'],
                    'country' => $_POST['country'],
                    'creditLimit' => $_POST['creditLimit'],
                    'email' => $old['email'],
                ];
            }
            else
            {
                $data = [
                    'customerNumber' => $old['customerNumber'],
                    'customerName' => $_POST['customerName'],
                    'contactFirstName' => $_POST['contactFirstName'],
                    'contactLastName' => $_POST['contactLastName'],
                    'phone' => $_POST['phone'],
                    'addressLine1' => $_POST['addressLine1'],
                    'addressLine2' => $_POST['addressLine2'],
                    'city' =>  $_POST['city'],
                    'postalCode' => $_POST['postalCode'],
                    'country' => $_POST['country'],
                    'creditLimit' => $_POST['creditLimit'],
                    'email' => $old['email'],
                    'password' => $_POST['password'],
                ];
            }
            $model = new MCustomer();
            $edit = $model->EditUser($data);
            if($edit)
             $session->setFlashdata("Edit","Profile Edit Successful");
             else
             $session->setFlashdata("Edit","Failed to Edit Profile");

        }

        $model = new MCustomer();
        $data = [
            'user' => $model->Profile($session->get('email'))->getResult(),
        ];
        echo view('head.php');
        echo view('/memberHeader');
        echo view('profile',$data);
        echo view('footer');
    }
    
}