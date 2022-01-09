<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\MCustomer;
use App\Models\MAdmin;
use App\Models\MProducts;

class CGeneral extends Controller
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
    
    public function Register()
    {
        $data = [];
        helper(['form']);
        $model = new MCustomer();
        if($this->request->getMethod() == 'post')
        {
           //Validation 
           //['customerNumber','customerName','contactFirstName','contactLastName','phone','addressLine1','addressLine2','city','postalCode','country','creditLimit','email','password'];
           $rules = [
               'customerName' => 'required|min_length[5]|max_length[50]',
               'contactFirstName' => 'required|min_length[2]|max_length[50]',
               'contactLastName' => 'required|min_length[2]|max_length[50]',
               'phone' => 'required|min_length[10]|max_length[15]|regex_match[/^([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/]|',
               'addressLine1' => 'required|min_length[2]|max_length[50]',
               'addressLine2' => 'max_length[50]',
               'city' => 'required|min_length[2]|max_length[50]',
               'postalCode' => 'min_length[3]|max_length[15]',
               'country' => 'required|min_length[2]|max_length[50]',
               'creditLimit' => 'numeric',
               'email' => 'required|min_length[3]|max_length[50]|valid_email|is_unique[customers.email]',
               'password' => 'required|min_length[4]|max_length[200]',
               'password_confirm' => 'matches[password]',
               
        ];
            
           
           if(! $this->validate($rules))
           {
               $data['validation'] = $this->validator;
           }
           else
           {
               
               $newData = [
                    'customerName' => $_POST['customerName'],
                    'contactFirstName' => $_POST['contactFirstName'],
                    'contactLastName' => $_POST['contactLastName'],
                    'phone' => $_POST['phone'],
                    'addressLine1' => $_POST['addressLine1'],
                    'addressLine2' => $_POST['addressLine2'],
                    'city' => $_POST['city'],
                    'postalCode' => $_POST['postalCode'],
                    'country' => $_POST['country'],
                    'creditLimit' => $_POST['creditLimit'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'password_confirm' => $_POST['password_confirm'],

               ];
               
               $model->save($newData);
               $session = session();
               $session->setFlashdata('success','Successful Registration');
               return redirect()->to('/Register');
           }
        }
        
        
        echo view('head.php',$data);
        echo view('GeneralHeader');
        echo view('registration');
        echo view('footer');
    }
    
    public function Login(){
        //$sess = ['email','userType'];
        //$sess = ['email','pass_word','userType'];
        $session = session();
        //$session->remove($sess);
        $data = [];
        helper(['form']);
        $db = \Config\Database::connect();

        if($this->request->getMethod() == 'post')
        {
       //Validation 
       $rules = [                   
           'email' => 'required|min_length[1]|max_length[90]|valid_email',
           'pass_word' => 'required|min_length[1]|max_length[255]',
            ];

            if(! $this->validate($rules))
            {
                $data['validation'] = $this->validator;
            }
            else
            {
                $newData = [
                'email' => $_POST['email'],
                'pass_word' =>  $_POST['pass_word'],
                
               ];
                $model = new MCustomer();
                $query = $model->Login($newData);
                if($query>0)
                {
                    $session->setFlashdata('success','Successful Login');
                    $session->set('email',$newData['email']);
                    $session->set('userType','Customer');
                }
                else
                {
                    $model = new MAdmin();
                    $query = $model->Login($newData);
                    if($query>0)
                    {
                        $session->setFlashdata('success','Successful Login as Admin');
                        $session->set('email',$newData['email']);
                        $session->set('userType','Admin');
                    }
                    else
                    {
                        $session->setFlashdata('fail','Login Failed');
                    }
                    
                }
                
                /*
                if($session->get('userType')=='Customer')
                {
                    return redirect()->to('/CCustomer');
                }
                else if($session->get('userType')=='Admin')
                {
                    return redirect()->to('/CAdmin');
                }
                */
                //return redirect()->to('/');
            }
        } 
        echo view('head.php',$data);
        echo view('GeneralHeader');
        echo view('login');
        echo view('Templates/footer');
    }

    public function BrowseProducts(){

        $request = service('request');
        $type = "";
        $search = "";
        $paginatePager = "";
        if($request->getMethod()=="post")
        {
            $search = $_POST['search'];
            $type = "search";
        }
        echo view('head');
        echo view('generalHeader');
        $model=new MProducts();
        $name = "";
        
        if(isset($searchdat) && isset($searchdat['search']))
            $search = $searchdat['search'];

            /*
        if($search == ""){
            $paginateData = $model->paginate(12);
            print_r($paginateData);
        }
            }else{
            $paginateData = $model->GetProducts()->getResultArray();
            }*/
        
        //$model->GetProducts($name);
        if($type == "search")
        {
            $data = [
                'results' => $model->GetProducts($search)->getResultArray(),
                'pager' => $paginatePager,
                'type' => $type,
            ];
        }
        else{
        $data = [
            'results' => $model->paginate(12),
            'pager' => $model->pager,
            'type' => $type,
        ];
        }
        /*$model->GetProducts($name);
        $data = [
            'results' => $model->paginate(12),
            'pager' => $model->pager,
        ];*/
        echo view('productList',$data);
        echo view('pagination');
        echo view('footer');

    }
    
    public function ProductDrillDown($id)
    {
        echo view('head');
        echo view('generalHeader');
        $model = new MProducts();
        $query = $model->GetProductByID($id);
        /*
        foreach($query as $row)
        {
            $data = [
                $row->descri
            ];
        }
        */
        $data = [
            'results' => $query->getResult(),
        ];
        echo view('productDrillDown',$data);
        echo view('footer');
    }

    







}