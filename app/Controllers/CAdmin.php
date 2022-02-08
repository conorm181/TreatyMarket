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
use DateTime;
use File;

class CAdmin extends Controller
{
   
    public function index()
    {
        $session = \Config\Services::session();
        $model = new MAdmin();
        $user = $model->GetUser($session->get('email'))->getResult();
        $userdata = array();
        helper('cookie');
        //print_r($this->response->getCookie('remember'));
        //print_r(get_cookie('remember'));
        foreach ($user as $row){
        $userdata = [
            'id' => $row->adminNumber,
            'fname' => $row->adminFirstName,
            'lname' => $row->adminLastName,
        ];
        break;
        }
        $session->set('userdata',$userdata);
        echo view('head.php');
        echo view('/adminHeader');
        echo "<h2 style=\"text-align: center\">Welcome Back ".$userdata['fname']." ".$userdata['lname']."</h2>";
        echo view('footer');
            
	}

    public function DeleteProduct($id)
    {
        $session = \Config\Services::session();
        $model = new MProducts();
        if($model->DeleteProduct($id)){
        $session->setFlashdata('Deletion', 'Successful delete product');
        }else
        {
            $session->setFlashdata('Deletion', 'Failed to delete product');
        }

        return redirect()->to(base_url().'/BrowseProducts');


    }
    
    public function AddProduct()
    {
        helper(['form', 'url']);
        $request =\Config\Services::request();
        $session = \Config\Services::session();
        if($this->request->getMethod() == 'post')
        {
            //FormSubmit
            $model = new MProducts();
            if(true){
                if (false) {
                    print_r('Choose a valid file');
                } else {
                    if(!empty($_FILES))
                    {
                        $x_file = $request->getFile('file');
                        $image = \Config\Services::image()
                        ->withFile($x_file)
                        ->resize(345, 186, false, 'height')
                        ->save("Assets/Images/products/thumbs/".$x_file->getClientName());

                        $fullSizeImage = \Config\Services::image()
                        ->withFile($x_file)
                        ->save("Assets/Images/products/full/".$x_file->getClientName());
                    }
                    
                    $data = [
                        'produceCode' => $_POST['code'],
                        'description' => $_POST['description'],
                        'category' => $_POST['category'],
                        'supplier' => $_POST['supplier'],
                        'quantityInStock' => 0,
                        'bulkBuyPrice' => $_POST['buy'],
                        'bulkSalePrice' => $_POST['sale'],
                        'photo' =>  $x_file->getClientName(),
                    ];
                    print_r($data);
                    $add = $model->AddProduct($data);
                    if($add = false)
                        $session->setFlashdata('Insertion', 'Fail');
                    else
                        $session->setFlashdata('Insertion', 'Success');
                        return redirect()->to(base_url().'/BrowseProducts');

                //} 
                /*
                $input = $this->validate([
                    'file' => [
                        'uploaded[file]',
                        'mime_in[file,image/jpg,image/jpeg,image/png]',
                        'max_size[file,1024]',
                    ]
                ]);
            
                if (!$input) {
                    print_r('Choose a valid file');
                } else {
                    $img = $this->request->getFile('file');
                    $img->move(WRITEPATH . 'uploads');
            
                    $data = [
                       'name' =>  $img->getName(),
                       'type'  => $img->getClientMimeType()
                    ];
                }
            $session->setFlashdata('Insertion', 'Successful add product');
            */
            }  
            }else
            {
                $session->setFlashdata('Insertion', 'Failed to add product');
                return redirect()->to(base_url().'/BrowseProducts');
            }
            
        }
            echo view('head.php');
            echo view('/adminHeader');
            echo view('productForm');
            echo view('footer');

        

    }

    public function ManageOrders(){
        $session = \Config\Services::session();
        
        $model = new MOrders();
        $ord = $model->GetAllOrders();
        $ord['user'] = "Admin";
        print_r($ord);
        /*
        $data =[
            'orders' => array(),
        ];*/
        
        //foreach ($ord->getResult() as $item)
        //    array_push($data['orders'],$item);
        
        echo view('head.php');
        echo view('/adminHeader');
        echo view('orderlistpag',$ord);
        echo view('paginationnew');
        echo view('footer');
    }
    
    
} 
