<?php

class Deliverymans extends Controller
{
    public function __construct()
    {
        $this->deliverymanModel = $this->model('Deliveryman');
    }

    public function login()
    {   
        $data = [
            'email' => '',
            'pwd' => '',
            'email_err' => '',
            'pwd_err' => ''
        ];
        

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
        
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'pwd' => trim($_POST['pwd']),
                'email_err' => '',
                'pwd_err' => ''
            ];
            //Email Validation
            if(empty($data['email'])){
                $data['email_err'] = "Please enter your email!";
            }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['email_err'] = "Incorrect email format!";
            }
            
            if(empty($data['pwd'])){
                $data['pwd_err'] = 'Please enter your password!';
            }

            if(empty($data['email_err']) && empty($data['pwd_err'])){
                $loggedInDeliveryman = $this->deliverymanModel->loginDeliveryman($data['email'], $data['pwd']);
                if($loggedInDeliveryman){
                    $this->createDeliverymanSession($loggedInDeliveryman);
                    header('location: '. URLROOT . '/deliverymans/orders_list');
                }else{
                    $data['pwd_err'] = "Incorrect email and/or password! ";
                    $this->view('deliverymans/login', $data);
                }
            }

        }

        $this->view('deliverymans/login', $data);
    }

    public function createDeliverymanSession($deliveryman)
    {
        session_start();
        $_SESSION['loggedinDeliveryman'] = true;
        $_SESSION['deliveryman_id'] = $deliveryman->id;
        $_SESSION['deliveryman_email'] = $deliveryman->email;
    }

    public function logoutDeliveryman()
    {
        unset($_SESSION['loggedinDeliveryman']);
        unset($_SESSION['deliveryman_id']);
        unset($_SESSION['deliveryman_email']);
        header('location: '. URLROOT . '/deliverymans/login');
    }

    public function orders_list()
    {
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            if(isset($_GET['delivery_id'])) {

                $this->deliverymanModel->takeDelivery($_GET['delivery_id'], $_SESSION['deliveryman_id']);
                header('location: '. URLROOT . '/deliverymans/orders_list');
            }
        }

        $this->view('deliverymans/orders_list', $data);
    }

    public function my_orders()
    {
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            if(isset($_GET['delivery_id'])){

                if(isset($_GET['delivery_finish'])) {
                    $this->deliverymanModel->finishDelivery($_GET['delivery_id'], $_GET['delivery_finish']);
                    header('location: '. URLROOT . '/deliverymans/my_orders');
                } 
            }
        }

        $this->view('deliverymans/my_orders', $data);
    }
}