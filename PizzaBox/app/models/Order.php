<?php

class Order
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function allProductsRemoved($removed, $itemRemovedFrom)
    {
        $this->db->query('SELECT description FROM menu_item WHERE name = :item_name');
        $this->db->bind(':item_name',$itemRemovedFrom);

        $data = $this->db->resultArray();
        $description = $data[0]['description'];
        $description_separated_items = explode(',',$description);

        $countAllRemoved = count($removed);
        $countOriginal = count($description_separated_items);

        if($countAllRemoved == $countOriginal){
            return true;
        }else{
            return false;
        }
    }

    public function getOrderDescriptionRemoved($removed, $itemRemovedFrom)
    {
        $this->db->query('SELECT description FROM menu_item WHERE name = :item_name');
        $this->db->bind(':item_name',$itemRemovedFrom);

        $data = $this->db->resultArray();
        $description = $data[0]['description'];
        $description_separated_items = explode(',',$description);

        for($i=0; $i<count($description_separated_items); $i++){
            for($j=0; $j<count($removed); $j++){
                if($removed[$j]==$description_separated_items[$i]){
                    array_splice($description_separated_items, $i,1);
                }
            }
        }

        $description_separated_items = implode(',',$description_separated_items);

        return $description_separated_items;
    }

    public function getOriginalDescription($menu_item)
    {
        $this->db->query('SELECT description FROM menu_item WHERE name = :item_name');
        $this->db->bind(':item_name',$menu_item);

        $data = $this->db->resultArray();
        $description = $data[0]['description'];
        $description_separated_items = explode(',',$description);

        $description_separated_items = implode(',',$description_separated_items);

        return $description_separated_items;
    }

    public function getTotalCost($product_name, $quantity)
    {
        $this->db->query('SELECT price FROM menu_item WHERE name = :item_name');
        $this->db->bind(':item_name',$product_name);

        $price=$this->db->resultArray();
        $totalCost = $price[0]['price'] * $quantity;

        return $totalCost;
    }

    public function prepareDeliveryDetails($customer_id)
    {
        $curr_date = date("Y-m-d H:i:s");
        $status = 'Pending';
        $this->db->query('INSERT INTO delivery_details (customer_id,date,status) VALUES(:customer, :current_date, :status)');
        $this->db->bind(':customer',$customer_id);
        $this->db->bind(':current_date',$curr_date);
        $this->db->bind(':status',$status);
        $this->db->execute();

        $d_id = $this->db->getLastID();

        return $d_id;

    }

    public function addOrderDetails($details, $customer)
    {
        $delivery_id = $this->prepareDeliveryDetails($customer);
        $j = 1;
        for($i=0; $i<count($details); $i++)
        {
            if($i % 5 == 0){
                $item_name = $details[$i];
            }elseif($i % 5 == 1){
                $description = $details[$i];
            }elseif($i % 5 == 2){
                $supplements = $details[$i];
            }elseif($i % 5 == 3){
                $quantity = $details[$i];
            }elseif($i % 5 == 4){
                $total = $details[$i];
            }

            if(($j % 5 == 0)){
                //$total += $total;
                $this->db->query('INSERT INTO order_details (delivery_details_id,item_name,description,supplements,quantity,total) VALUES(:delivery_id, :itm, :descr, :suppl, :qnty, :ttl)');
                $this->db->bind(':delivery_id', $delivery_id);
                $this->db->bind(':itm', $item_name);
                $this->db->bind(':descr', $description);
                $this->db->bind(':suppl', $supplements);
                $this->db->bind(':qnty', $quantity);
                $this->db->bind(':ttl', $total);

                if(!$this->db->execute()){
                   return false; 
                }
            }
            $j+=1;
        }

        return true;

    }

    
}