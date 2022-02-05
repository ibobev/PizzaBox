<?php

class Admins extends Controller
{
    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
    }

    
    public function login()
    {   
        $data = [
            'admin_name' => '',
            'pwd' => '',
            'admin_name_err' => '',
            'pwd_err' => ''
        ];
        

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
        
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'admin_name' => trim($_POST['admin_name']),
                'pwd' => trim($_POST['pwd']),
                'admin_name_err' => '',
                'pwd_err' => ''
            ];

            if(empty($data['admin_name'])){
                $data['admin_name_err'] = 'Please enter your admin name!';
            }
            
            if(empty($data['pwd'])){
                $data['pwd_err'] = 'Please enter your password!';
            }

            if(empty($data['admin_name_err']) && empty($data['pwd_err'])){
                $loggedInAdmin = $this->adminModel->loginAdmin($data['admin_name'],$data['pwd']);
                if($loggedInAdmin){
                    $this->createAdminSession($loggedInAdmin);
                    header('location: '. URLROOT . '/admins/dashboard');
                }else{
                    $data['pwd_err'] = "Incorrect admin name and/or password! ";
                    $this->view('admins/login', $data);
                }
            }

        }else{
            $data = [
                'admin_name' => '',
                'pwd' => '',
                'admin_name_err' => '',
                'pwd_err' => ''
            ];
        }

        $this->view('admins/login', $data);
    }

    public function createAdminSession($admin)
    {
        session_start();
        $_SESSION['loggedinAdmin'] = true;
        $_SESSION['admin_id'] = $admin->id;
        $_SESSION['admin_name'] = $admin->admin_name;
    }

    public function logoutAdmin()
    {
        unset($_SESSION['loggedinAdmin']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_name']);
        header('location: '. URLROOT . '/admins/login');
    }

    public function dashboard()
    {
        $data = [];
        $this->view('admins/dashboard', $data);
    }

    // CRUD Validation for Category, Product, Menu

    //Menu

    public function createMenuItem()
    {
        $data = [
            'success_msg_menu' => '',
            'category_name_menu_err' => '',
            'menu_item_name_err' => '',
            'price_err' => '',
            'no_products_selected' => '',
            'img_err' => ''
        ];

        $nameValidation = "/^[a-zA-Z ]*$/";
        $priceValidation = "/^\d{1,10}(?:\.\d{1,2})?$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(empty($_POST['category_name_menu'])){
                $data['category_name_menu_err'] = 'Please select a valid category!';
            }elseif(!$this->adminModel->isCategoryExisting($_POST['category_name_menu'])){
                $data['category_name_menu_err'] = 'Invalid category!';
            }
            if(empty($_POST['products'])){
                $data['no_products_selected']= "Please select at least one product!";
            }
            if(empty($_POST['menu_item_name'])){
                $data['menu_item_name_err'] = "Menu item has empty name!";
            }elseif(!preg_match($nameValidation, $_POST['menu_item_name'])){
                $data['menu_item_name_err'] = "Menu item name can only contain letters!";
            }
            if(empty($_POST['price']) || $_POST['price'] == 0){
                $data['price_err'] = "Menu item has no price!";
            }elseif(!preg_match($priceValidation, $_POST['price'])){
                $data['price_err'] = "Invalid price format!";
            }elseif(preg_match($nameValidation, $_POST['price'])){
                $data['price_err'] = "Price cannot contain letters!";
            }
            if(!isset($_FILES['img'])){
                $data['img_err'] = 'No image file has been chosen!';
            }

            if(empty($data['category_name_menu_err']) && empty($data['no_products_selected']) && empty($data['menu_item_name_err']) && empty($data['price_err']) && empty($data['img_err'])){
                
                $image = preparedFileUpload();
                    
                if($image != '-1'){
                    if($this->adminModel->createMenuItem($_POST['category_name_menu'],$_POST['products'],$_POST['menu_item_name'],$_POST['price'], $image))
                    {
                        $data['success_msg_menu'] = "Menu item successfully created!";
                        $this->view('admins/dashboard',$data);
                        echo '<script type="text/javascript"> displayMenuForm(); </script>';
                    }else{
                        $data['menu_item_name_err'] = "Menu item name is taken!";
                        $this->view('admins/dashboard',$data);
                        echo '<script type="text/javascript"> displayMenuForm(); </script>';
                    }
                }
                elseif($image == '-1')
                {
                    $data['img_err'] = 'File already exists!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayMenuForm(); </script>';
                }
                else{
                    $data['img_err'] = 'Unsupported file type! Supported file types are ".jpg", ".jpeg" and ".png"';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayMenuForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayMenuForm(); </script>';
            }
        }
        $this->view('admins/dashboard',$data);

    }

    public function updateMenuItem()
    {
        $data = [
            'success_msg_menu' => '',
            'menu_id_err' => '',
            'menu_item_name_err' => '',
            'price_err' => '',
            'img_err' => ''
        ];

        $nameValidation = "/^[a-zA-Z ]*$/";
        $priceValidation = "/^\d{1,10}(?:\.\d{1,2})?$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(empty($_POST['menu_item_id'])){
                $data['menu_id_err'] = 'Please select the ID of the menu item you wish to update!';
            }elseif(!$this->adminModel->isMenuIDExisting($_POST['menu_item_id'])){
                $data['menu_id_err'] = 'Invalid ID!';
            }
            if(empty($_POST['menu_item_name'])){
                $data['menu_item_name_err'] = 'Name can not be empty!';
            }elseif(!preg_match($nameValidation, $_POST['menu_item_name'])){
                $data['menu_item_name_err'] = "Menu item name can only contain letters!";
            }elseif($this->adminModel->isMenuItemExisting($_POST['menu_item_name'])){
                $data['menu_item_name_err'] = "Menu item name is already taken!";
            }
            if(empty($_POST['price']) || $_POST['price'] == 0){
                $data['price_err'] = "Menu item has no price!";
            }elseif(!preg_match($priceValidation, $_POST['price'])){
                $data['price_err'] = "Invalid price format!";
            }elseif(preg_match($nameValidation, $_POST['price'])){
                $data['price_err'] = "Price cannot contain letters!";
            }
            if(!isset($_FILES['img'])){
                $data['img_err'] = 'No image file has been chosen!';
            }

            if(empty($data['menu_item_name_err']) && empty($data['price_err']) && empty($data['img_err'])){
                
                $image = preparedFileUpload();
                    
                if($image != '-1'){
                    $img_name = $this->adminModel->getImageName($_POST['menu_item_id']);
                    if(deleteFile($img_name)){
                        if($this->adminModel->updateMenuItem($_POST['menu_item_id'],$_POST['menu_item_name'],$_POST['price'], $image))
                        {
                            $data['success_msg_menu'] = "Menu item successfully updated!";
                            $this->view('admins/dashboard',$data);
                            echo '<script type="text/javascript"> displayMenuForm(); </script>';
                        }else{
                            $data['menu_item_name_err'] = "Menu item name is taken!";
                            $this->view('admins/dashboard',$data);
                            echo '<script type="text/javascript"> displayMenuForm(); </script>';
                        }
                    }else{
                        $data['img_err']='Operation failed! Could not delete image file of previous menu item!';
                        $this->view('admins/dashboard',$data);
                        echo '<script type="text/javascript"> displayMenuForm(); </script>';
                    }
                }
                elseif($image == '-1')
                {
                    $data['img_err'] = 'File already exists!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayMenuForm(); </script>';
                }
                else{
                    $data['img_err'] = 'Unsupported file type! Supported file types are ".jpg", ".jpeg" and ".png"';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayMenuForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayMenuForm(); </script>';
            }

        }

        $this->view('admins/dashboard',$data);
    }

    public function deleteMenuItem()
    {
        $data = [
            'menu_id_err' => '',
            'success_msg_menu' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(empty($_POST['menu_item_id'])){
                $data['menu_id_err'] = 'Please select the ID of the menu item you wish to delete!';

            }elseif(!$this->adminModel->isMenuIDExisting($_POST['menu_item_id'])){
                $data['menu_id_err'] = 'Invalid ID!';
            }

            //if(!empty($_POST['menu_item_id'])){}
            $img_name = $this->adminModel->getImageName($_POST['menu_item_id']);
            //echo $img_name;

            if(empty($data['menu_id_err']) && deleteFile($img_name)){
                if($this->adminModel->deleteMenuItem($_POST['menu_item_id'])){
                    $data['success_msg_menu'] = "Menu item successfully deleted!";
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayMenuForm(); </script>';
                }else{
                    $data['menu_id_err'] = 'Something went wrong while trying to delete menu item!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayMenuForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayMenuForm(); </script>';
            }
        }

        $this->view('admins/dashboard',$data);
    }

    //Category

    public function createCategory()
    {
        $data = [
            'category_name' => '',
            'category_name_err' => '',
            'success_msg' => ''
        ];

        $nameValidation = "/^[a-zA-Z ]*$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'category_name' => trim($_POST['category_name'])
            ];
            
            if(empty($data['category_name'])){
                $data['category_name_err'] = 'Please enter a category name!';
            }elseif(!preg_match($nameValidation, $data['category_name'])){
                $data['category_name_err'] = "Category name can only contain letters!";
            }

            if(empty($data['category_name_err'])){
                if($this->adminModel->createCategory($data['category_name'])){
                    $data['success_msg'] = "Category successfully created!";
                }else{
                    $data['category_name_err'] = 'Category name exists!';
                }
            }else{
                $this->view('admins/dashboard',$data);
            }

        }
        
        $this->view('admins/dashboard',$data);
    }

    public function updateCategory()
    {
        $data = [
            'category_new_name' => '',
            'category_new_name_err' => '',
            'success_msg' => ''
        ];

        $nameValidation = "/^[a-zA-Z ]*$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'category_new_name' => trim($_POST['category_new_name'])
            ];
            
            if(empty($data['category_new_name'])){
                $data['category_new_name_err'] = 'Please enter your new category name!';
            }elseif(!preg_match($nameValidation, $data['category_new_name'])){
                $data['category_new_name_err'] = "Category name can only contain letters!";
            }

            if(empty($_POST['selected_category_name'])){
                $data['category_new_name_err'] = 'Please select a category!';
            }

            if(empty($data['category_new_name_err'])){
                if($this->adminModel->updateCategory($_POST['selected_category_name'],$data['category_new_name'])){
                    $data['success_msg'] = "Category successfully updated!";
                }else{
                    $data['category_new_name_err'] = 'Category does not exists!';
                }
            }else{
                $this->view('admins/dashboard',$data);
            }

        }
        
        $this->view('admins/dashboard',$data);
    }

    public function deleteCategory()
    {
        $data = ['category_name_err' => ''];
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(empty($_POST['selected_category_name'])){
                $data['category_name_err'] = 'Please select a category you wish to delete!';
            }

            if(empty($data['category_name_err'])){
                if($this->adminModel->deleteCategory($_POST['selected_category_name'])){
                    $data['success_msg'] = "Category deleted!";
                }else{
                    $data['category_name_err'] = 'Invalid category or category name is still relevant to a menu item!';
                }
            }else{
                $this->view('admins/dashboard',$data);
            }

        }

        $this->view('admins/dashboard',$data);
    }

    // Product

    public function createType()
    {
        $data = [
            'product_type_name' => '',
            'product_type_name_err' => '',
            'success_msg_product' => ''
        ];

        $nameValidation = "/^[a-zA-Z]*$/";

        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'product_type_name' => trim($_POST['product_type_name'])
        
            ];

            if(empty($data['product_type_name'])){
                $data['product_type_name_err'] = 'Please enter product type name!';
            }elseif(!preg_match($nameValidation, $data['product_type_name'])){
                $data['product_type_name_err'] = "Product type name can only contain letters!";
            }

            if(empty($data['product_type_name_err'])){
                if($this->adminModel->createType($data['product_type_name'])){
                    $data['success_msg_product'] = "Product type successfully created!";
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }else{
                    $data['product_type_name_err'] = 'Product type name exists!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayProductForm(); </script>';
            }

        }

        $this->view('admins/dashboard',$data);
    }

    public function createProduct()
    {
        $data = [
            'product_item_name' => '',
            'product_item_name_err' => '',
            'product_type_name' => '',
            'product_type_name_err' => '',
            'success_msg_product' => ''
        ];

        $nameValidation = "/^[a-zA-Z ]*$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'product_item_name' => trim($_POST['product_item_name']),
                'product_type_name' => trim($_POST['product_type'])
        
            ];

            if(empty($data['product_type_name'])){
                $data['product_type_name_err'] = 'Please select a product type!';
            }
            if(empty($data['product_item_name'])){
                $data['product_item_name_err']= 'Please enter product item name!';
            }elseif(!preg_match($nameValidation, $data['product_item_name'])){
                $data['product_item_name_err'] = "Product item name can only contain letters!";
            }

            if(empty($data['product_type_name_err']) && empty($data['product_item_name_err']))
            {
                if($this->adminModel->isTypeExisting($data['product_type_name']))
                {
                    if($this->adminModel->createProductItem($data['product_type_name'],$data['product_item_name'])){
                        $data['success_msg_product'] = "Product item successfully created!";
                        $this->view('admins/dashboard',$data);
                        echo '<script type="text/javascript"> displayProductForm(); </script>';
                    }else{
                        $data['product_item_name_err'] = 'Product item name exists!';
                        $this->view('admins/dashboard',$data);
                        echo '<script type="text/javascript"> displayProductForm(); </script>';
                    }
                }else{
                    $data['product_type_name_err'] = 'Product type name does not exists!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }
                
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayProductForm(); </script>';
            }

        }

        $this->view('admins/dashboard',$data);

    }

    public function updateProduct()
    {
        $data = [
            'product_new_name' => '',
            'product_new_name_err' => '',
            'selected_item' => '',
            'selected_item_err' => '',
            'success_msg_product' => ''
        ];

        $nameValidation = "/^[a-zA-Z ]*$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'selected_item' => trim($_POST['product_name']),
                'product_new_name' => trim($_POST['product_new_name'])
        
            ];

            if(empty($data['selected_item'])){
                $data['selected_item_err'] = 'Please select a product you wish to rename!';
            }

            if(empty($data['product_new_name'])){
                $data['product_new_name_err'] = 'Please enter product item name!';

            }elseif(!preg_match($nameValidation, $data['product_new_name'])){
                $data['product_new_name_err'] = 'Product item name can only contain letters!';
            }

            if(empty($data['selected_item_err']) && empty($data['product_new_name_err']))
            {
                if($this->adminModel->updateProduct($data['product_new_name'], $data['selected_item'])){
                    $data['success_msg_product'] = 'Product name successfully changed!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }else{
                    $data['product_new_name_err'] = 'Product item name does not exist!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayProductForm(); </script>';
            }

        }

        $this->view('admins/dashboard',$data);
    }

    public function deleteProductItem()
    {
        $data = [
            'product_item_name_err' => ''
        ];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            if(empty($_POST['product_item_name'])){
                $data['product_item_name_err'] = 'Please select an item you wish to delete!';
            }

            if(empty($data['product_item_name_err'])){
                if($this->adminModel->deleteProductItem($_POST['product_item_name'])){
                    $data['success_msg_product'] = "Item deleted!";
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }else{
                    $data['product_item_name_err'] = 'Invalid Item!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayProductForm(); </script>';
            }
        }

        $this->view('admins/dashboard',$data);
    }

    
    public function deleteProductType()
    {
        $data = [
            'product_type_name_err' => ''
        ];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            if(empty($_POST['product_type'])){
                $data['product_type_name_err'] = 'Please select a type you wish to delete!';
            }

            if(empty($data['product_type_name_err'])){
                if($this->adminModel->deleteProductType($_POST['product_type'])){
                    $data['success_msg_product'] = "Type deleted!";
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }else{
                    $data['product_type_name_err'] = 'Invalid type or type is still relevant to an item/s!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayProductForm(); </script>';
            }
        }

        $this->view('admins/dashboard',$data);
    }

    //Supplement

    public function createSupplement()
    {
        $data = [
            'supplement_name' => '',
            'supplement_name_err' => '',
            'success_msg' => ''
        ];

        $nameValidation = "/^[a-zA-Z ]*$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'supplement_name' => trim($_POST['supplement_name'])
            ];
            
            if(empty($data['supplement_name'])){
                $data['supplement_name_err'] = 'Please enter a supplement name!';
            }elseif(!preg_match($nameValidation, $data['supplement_name'])){
                $data['supplement_name_err'] = "Supplement name can only contain letters!";
            }

            if(empty($data['supplement_name_err'])){
                if($this->adminModel->createSupplement($data['supplement_name'])){
                    $data['success_msg'] = "Supplement successfully created!";
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displaySupplementForm(); </script>';
                }else{
                    $data['supplement_name_err'] = 'Supplement name exists!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displaySupplementForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displaySupplementForm(); </script>';
            }

        }
        
        $this->view('admins/dashboard',$data);
    }

    public function updateSupplement()
    {
        $data = [
            'supplement_new_name' => '',
            'supplement_new_name_err' => '',
            'success_msg' => ''
        ];

        $nameValidation = "/^[a-zA-Z ]*$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'supplement_new_name' => trim($_POST['supplement_new_name'])
            ];
            
            if(empty($data['supplement_new_name'])){
                $data['supplement_new_name_err'] = 'Please enter your new supplement name!';
            }elseif(!preg_match($nameValidation, $data['supplement_new_name'])){
                $data['supplement_new_name_err'] = "Supplement name can only contain letters!";
            }

            if(empty($_POST['selected_supplement_name'])){
                $data['supplement_new_name_err'] = 'Please select a supplement!';
            }

            if(empty($data['supplement_new_name_err'])){
                if($this->adminModel->updateSupplement($_POST['selected_supplement_name'],$data['supplement_new_name'])){
                    $data['success_msg'] = "Supplement successfully updated!";
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displaySupplementForm(); </script>';
                }else{
                    $data['supplement_new_name_err'] = 'Supplement does not exists!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displaySupplementForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displaySupplementForm(); </script>';
            }

        }
        
        $this->view('admins/dashboard',$data);
    }

    public function deleteSupplement()
    {
        $data = ['supplement_name_err' => ''];
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(empty($_POST['selected_supplement_name'])){
                $data['supplement_name_err'] = 'Please select a supplement you wish to delete!';
            }

            if(empty($data['supplement_name_err'])){
                if($this->adminModel->deleteSupplement($_POST['selected_supplement_name'])){
                    $data['success_msg'] = "Supplement deleted!";
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displaySupplementForm(); </script>';
                }else{

                    $data['supplement_name_err'] = 'Invalid supplement name!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displaySupplementForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displaySupplementForm(); </script>';
            }

        }

        $this->view('admins/dashboard',$data);
    }

    public function deliveryman() {

         

        $data = [
        'deliveryman_list' => $this->adminModel->getAllDeliveryman(),
        'email' => '',
        'firstname' => '',
        'lastname' => '',
        'pwd' => '',
        'pwdr' => '',
        'email_err' => '',
        'firstname_err' => '',
        'lastname_err' => '',
        'pwd_err' => '',
        'pwdr_err' => '',
        'success_msg' => ''
        ];

        // Form validation
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            if($_POST["remove_btn"] != "x"){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'deliveryman_list' => $this->adminModel->getAllDeliveryman(),
                    'email' => trim($_POST['email']),
                    'firstname' => trim($_POST['firstname']),
                    'lastname' => trim($_POST['lastname']),
                    'pwd' => trim($_POST['pwd']),
                    'pwdr' => trim($_POST['pwdr']),
                    'email_err' => '',
                    'firstname_err' => '',
                    'lastname_err' => '',
                    'pwd_err' => '',
                    'pwdr_err' => '',
                    'success_msg' => ''
                ];
    
    
                //Validation RegEx
                $nameValidation = "/^[a-zA-Z]*$/";
                $pwdValidation = "/^(.{0,3}|[^a-z]*|[^\d]*)$/i";
    
                //Name Validation
                if(empty($data['firstname'])){
                    $data['firstname_err'] = "Please enter your first name!";
                }elseif(!preg_match($nameValidation, $data['firstname'])){
                    $data['firstname_err'] = "First name can only contain letters!";
                }
    
                if(empty($data['lastname'])){
                    $data['lastname_err'] = "Please enter your last name!";
                }elseif(!preg_match($nameValidation, $data['lastname'])){
                    $data['lastname_err'] = "Last name can only contain letters!";
                }
    
                //Email Validation
                if(empty($data['email'])){
                    $data['email_err'] = "Please enter your email!";
                }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['email_err'] = "Incorrect email format!";
                }else{
                    if($this->adminModel->takenDeliverymanEmailValidation($data['email'])){
                        $data['email_err'] = "Email is taken!";
                    }
                }
    
                //Password Validation
                if(empty($data['pwd'])){
                    $data['pwd_err'] = "Please enter a password!";
                }elseif(strlen($data['pwd'] < 4 )){
                    $data['pwd_err'] = "Password must be at least 4 characters!";
                }elseif(!preg_match($pwdValidation, $data['pwd'])){
                    $data['pwd_err'] = "Password must contain at least one numeric value!";
                }
    
                //Password Confirm Validation
                if(empty($data['pwdr'])){
                    $data['pwdr_err'] = "Empty confirm password field";
                }else{
                    if($data['pwd'] != $data['pwdr']){
                        $data['pwdr_err'] = "Passwords do not match!";
                    }
                }
    
                //Empty Error Messages check
                if(empty($data['email_err']) && empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['pwd_err']) && empty($data['pwdr_err'])){
                    if($this->adminModel->AddDeliveryMan($data)){
                        header('location: '. URLROOT . '/admins/deliveryman');
                    }else{
                        die('Something went wrong!');
                    }
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET'){

            if(isset($_GET['deliveryman_id'])){
                $this->adminModel->deleteDeliveryman($_GET["deliveryman_id"]);
                header('location: '. URLROOT . '/admins/deliveryman');
            }
        }

        //Load view
        $this->view('admins/deliveryman', $data);
    }

    public function delete() {

    }

}