<?php

class Deliveryman
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function loginDeliveryman($email, $pwd)
    {
        $this->db->query('SELECT * FROM delivery_man WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->resultRow();
        
        if(!empty($row)){
            $deliverymanPassword = $row->password; 
        }else{
            return false;
        }

        if($pwd == $deliverymanPassword){
            return $row;
        }else{
            return false;
        }
    }

    public function takeDelivery($deliveryID, $deliverymanID) {
        $this->db->query('UPDATE delivery_details SET delivery_man_id = :delivery_man_id, status="Delivering" WHERE delivery_id = :delivery_id');
        $this->db->bind(':delivery_id', $deliveryID);
        $this->db->bind(':delivery_man_id', $deliverymanID);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function finishDelivery($deliveryID, $status) {
        $this->db->query('UPDATE delivery_details SET status = :status WHERE delivery_id = :delivery_id');
        $this->db->bind(':delivery_id', $deliveryID);
        $this->db->bind(':status', $status);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}