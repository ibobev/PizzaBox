<?php

class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function loginAdmin($admin_name,$pwd)
    {
        $this->db->query('SELECT * FROM admin WHERE admin_name = :admin_name');
        $this->db->bind(':admin_name', $admin_name);
        $row = $this->db->resultRow();
        
        if(!empty($row)){
            $adminPassword = $row->password; //password as in the table admins
        }else{
            return false;
        }

        if($pwd == $adminPassword){
            return $row;
        }else{
            return false;
        }
    }
    
    //Category

    public function isCategoryExisting($categoryName)
    {
        $this->db->query('SELECT ctg_name FROM category WHERE ctg_name= :name');
        $this->db->bind(':name', $categoryName);
        
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function createCategory($categoryName)
    {
       if(!$this->isCategoryExisting($categoryName)){
            $this->db->query('INSERT INTO category (ctg_name) VALUES(:name)');
            $this->db->bind(':name', $categoryName);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
       }else{
           return false;
       }
        
    }

    
    public function updateCategory($categoryOldName, $categoryNewName)
    {

        if($this->isCategoryExisting($categoryOldName)){

            $this->db->query('UPDATE category SET ctg_name = :newName WHERE ctg_name = :oldName');
            $this->db->bind(':newName', $categoryNewName);
            $this->db->bind(':oldName', $categoryOldName);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }

    }

    public function deleteCategory($categoryName)
    {
        if($this->isCategoryExistingInMenu($categoryName)){
            return false;
        }
        if(!$this->isCategoryExisting($categoryName)){
            return false;
        }else{
            $this->db->query('DELETE FROM category WHERE ctg_name = :name');
            $this->db->bind(':name', $categoryName);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

    // Product

    public function isTypeExisting($typeName)
    {
        $this->db->query('SELECT name FROM product_type WHERE name= :name');
        $this->db->bind(':name', $typeName);
        
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function isProductItemExisting($productName)
    {
        $this->db->query('SELECT name FROM product_item WHERE name= :name');
        $this->db->bind(':name', $productName);
        
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function isTypeExistingInItem($type)
    {
        $this->db->query('SELECT type_name FROM product_item WHERE type_name= :type');
        $this->db->bind(':type', $type);
        
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function createType($typeName)
    {
        if(!$this->isTypeExisting($typeName)){
            $this->db->query('INSERT INTO product_type (name) VALUES(:name)');
            $this->db->bind(':name', $typeName);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function createProductItem($type, $productName)
    {
        
        if(!$this->isProductItemExisting($productName)){
            $this->db->query('INSERT INTO product_item  (name, type_name) VALUES(:name, :type_name) ');
            $this->db->bind(':name', $productName);
            $this->db->bind(':type_name', $type);
            $this->db->execute();
            return true;
        }else{
            return false;
        }
    }

    public function updateProduct($name, $selected)
    {
        if(!$this->isProductItemExisting($selected)){
            return false;
        }else{
            $this->db->query('UPDATE product_item SET name=:newName WHERE name=:oldName');
            $this->db->bind(':newName', $name);
            $this->db->bind(':oldName', $selected);
            $this->db->execute();
            return true;
        }
    }

    public function deleteProductItem($item)
    {
        if($this->isProductItemExisting($item)){
            $this->db->query('DELETE FROM product_item WHERE name = :name');
            $this->db->bind(':name', $item);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function deleteProductType($type)
    {

        if($this->isTypeExistingInItem($type)){
            return false;
        }elseif($this->isTypeExisting($type)){
            $this->db->query('DELETE FROM product_type WHERE name = :name');
            $this->db->bind(':name', $type);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    //Menu

    public function isMenuItemExisting($name)
    {
        $this->db->query('SELECT name FROM menu_item WHERE name= :name');
        $this->db->bind(':name', $name);
        
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function isCategoryExistingInMenu($category)
    {
        
        $id = $this->getCategoryID($category);


        $this->db->query('SELECT category_id FROM menu_item WHERE category_id= :category');
        $this->db->bind(':category', $id);
        
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }


    public function getCategoryID($categoryName)
    {
        $this->db->query('SELECT cid FROM category WHERE ctg_name=:name');
        $this->db->bind(':name', $categoryName);

        $row = $this->db->resultRow();
        $row = $row->cid;

        return $row;
    }

    public function isMenuIDExisting($id){
        $this->db->query('SELECT id FROM menu_item WHERE id=:id');
        $this->db->bind(':id',$id);

        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }

    }

    public function getImageName($id)
    {
        if($this->isMenuIDExisting($id)){
            $this->db->query('SELECT image FROM menu_item WHERE id=:id');
            $this->db->bind(':id',$id);

            $row = $this->db->resultRow();
            $img = $row->image;
            return $img;
        }else{
            return false;
        }
        
    }


    public function createMenuItem($category, $products, $name, $price, $img)
    {
        if($this->isMenuItemExisting($name)){
            return false;
        }else{
            $products_concat = implode(", ",$products);
            $category_id = $this->getCategoryID($category);

            $this->db->query('INSERT INTO menu_item (category_id,name,description,price, image) VALUES(:category_id,:name,:description,:price,:image)');
            $this->db->bind(':category_id', $category_id);
            $this->db->bind(':name', $name);
            $this->db->bind(':description', $products_concat);
            $this->db->bind(':price', $price);
            $this->db->bind(':image', $img);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }
    }

    public function updateMenuItem($id, $name, $price, $img)
    {

        $this->db->query('UPDATE menu_item SET name=:name, image=:img, price=:price WHERE id=:id');
        $this->db->bind(':id', $id);
        $this->db->bind(':name',$name);
        $this->db->bind(':price',$price);
        $this->db->bind(':img',$img);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteMenuItem($id)
    {
        $this->db->query('DELETE FROM menu_item WHERE id = :id');
        $this->db->bind(':id',$id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Supplements
    public function isSupplementExisting($supplementName)
    {
        $this->db->query('SELECT supplement_name FROM supplement WHERE supplement_name= :name');
        $this->db->bind(':name', $supplementName);
        
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function createSupplement($supplementName)
    {
       if(!$this->isSupplementExisting($supplementName)){
            $this->db->query('INSERT INTO supplement (supplement_name) VALUES(:name)');
            $this->db->bind(':name', $supplementName);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
       }else{
           return false;
       }
        
    }

    
    public function updateSupplement($supplementOldName, $supplementNewName)
    {

        if($this->isSupplementExisting($supplementOldName)){

            $this->db->query('UPDATE supplement SET supplement_name = :newName WHERE supplement_name = :oldName');
            $this->db->bind(':newName', $supplementNewName);
            $this->db->bind(':oldName', $supplementOldName);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }

    }

    public function deleteSupplement($supplementName)
    {
        if(!$this->isSupplementExisting($supplementName)){
            return false;
        }else{
            $this->db->query('DELETE FROM supplement WHERE supplement_name = :name');
            $this->db->bind(':name', $supplementName);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

    public function AddDeliveryMan($data) {
        $this->db->query('INSERT INTO delivery_man (first_name, last_name, email, password) VALUES(:first_name, :last_name, :email, :password)');
        $this->db->bind(':first_name', $data['firstname']);
        $this->db->bind(':last_name', $data['lastname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['pwd']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getAllDeliveryman() {
        $this->db->query('SELECT * FROM delivery_man');
        $data = $this->db->resultArray();

        if(empty($data)){
            return false;
        }else{
            return $data;
        }
    }

    public function deleteDeliveryman($id){
        $this->db->query('DELETE FROM delivery_man WHERE id= :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function takenDeliverymanEmailValidation($email)
    {
        $this->db->query('SELECT * FROM delivery_man WHERE email= :email');
        $this->db->bind(':email', $email);
        /*$this->db->execute();*/
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}