<?php

class Customer
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function takenEmailValidation($email)
    {
        $this->db->query('SELECT * FROM customer WHERE email= :email');
        $this->db->bind(':email', $email);
        /*$this->db->execute();*/
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function checkPassword($pwd, $customerID)
    {
        $this->db->query('SELECT * FROM customer WHERE id = :id');
        $this->db->bind(':id', $customerID);
        $row = $this->db->resultRow();

        if(!empty($row)){
            $hashedPassword = $row->password;
        }else{
            return false;
        }

        if(!password_verify($pwd, $hashedPassword)){
            return true;
        }else{
            return false;
        }
    }

    public function registerCustomer($data)
    {
        
        $this->db->query('INSERT INTO customer (first_name, email, password) VALUES(:first_name, :email, :password)');
        $this->db->bind(':first_name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['pwd']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function loginCustomer($email, $pwd)
    {
        $this->db->query('SELECT * FROM customer WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->resultRow();
        
        if(!empty($row)){
            $hashedPassword = $row->password; //password as in the table users
        }else{
            return false;
        }

        if(password_verify($pwd, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }

    public function changeAccountDetails($data, $id)
    {

        $this->db->query(
        'UPDATE customer
        SET first_name = :first_name,
        last_name = :last_name,
        /*email = :email,*/
        phone_number = :phone_number
        WHERE id = :id'
        );

        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        /*$this->db->bind(':email', $data['email']);*/
        $this->db->bind(':phone_number', $data['phone']);
        $this->db->bind(':id',$id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function changePassword($newPassword, $customerID) 
    {
        $this->db->query(
            'UPDATE customer
            SET password = :password
            WHERE id = :id'
        );

        $this->db->bind(':password', $newPassword);
        $this->db->bind(':id', $customerID);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getAccountData($customer_id)
    {
        $this->db->query('SELECT * FROM customer WHERE id = :id');
        $this->db->bind(':id', $customer_id);

        $row = $this->db->resultRow();
        
        return $row;
    }

    public function changeAddressDetails($address, $customerID) 
    {
        $this->db->query(
            'UPDATE customer
            SET address = :address
            WHERE id = :id'
        ); 

        $this->db->bind(':address', $address);
        $this->db->bind(':id', $customerID);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}