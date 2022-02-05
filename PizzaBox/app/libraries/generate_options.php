<?php

//variable $data is used to store associative array

function displayCategoryOptions()
{
    $db = new Database();
    $db->query('SELECT ctg_name FROM category');

    $data = $db->resultArray();


    foreach($data as $value)
    {
        echo'<option value="'.strval($value['ctg_name']).'">'.strval($value['ctg_name']).'</option>';
    }
}

function displayTypeOptions()
{
    $db = new Database();
    $db->query('SELECT name FROM product_type');

    $data = $db->resultArray();


    foreach($data as $value)
    {
        echo'<option value="'.strval($value['name']).'">'.strval($value['name']).'</option>';
    }
}

function displayItemOptions()
{
    $db = new Database();
    $db->query('SELECT name FROM product_item');

    $data = $db->resultArray();


    foreach($data as $value)
    {
        echo'<option value="'.strval($value['name']).'">'.strval($value['name']).'</option>';
    }
}

function displayMenuItemOptions()
{
    $db = new Database();

    $db->query('SELECT type_name, name FROM product_item ORDER BY type_name');

    $data = $db->resultArray();

    $previousValue = '';

    foreach($data as $value)
    {
        $currentProductType=$value['type_name'];


        if($currentProductType != $previousValue){
            echo '<legend class="products_legend">'.strval($value['type_name']).'</legend>';
        }

        echo '<label class="gen_lbl">'.strval($value['name']).'';
        echo '<input type="checkbox" id="'.strval($value['name']).'" name="products[]" value="'.strval($value['name']).'">';
        echo '</label>';

        $previousValue = $currentProductType;
        
    }

}

function displayMenuID()
{
    $db = new Database();

    $db->query('SELECT id FROM menu_item');
    $data = $db->resultArray();

    foreach($data as $value)
    {
        echo'<option value="'.strval($value['id']).'">'.strval($value['id']).'</option>';
    }

}

function displayMenuItems()
{
    $db = new Database();

    $db->query('SELECT * FROM menu_item LEFT JOIN category ON menu_item.category_id=category.cid ORDER BY category_id');
    $data = $db->resultArray();

    if(empty($data)){
        return false;
    }

    $previousCategory = '';

    foreach($data as $value)
    {
        $currentCategory = $value['category_id']; 

        if($currentCategory != $previousCategory){
            echo '<div class="exclude"';
            echo '<h2>'.strval($value['ctg_name']).'</h2>';
            echo '<hr class="hr_border">';
            echo '</div>';
        }

        echo 
        '<div class="menu_flex_container">
            <form action="/PizzaBox/orders/cart" method="post" class="form_menu">
            <img class="menu_item_img" src="/PizzaBox/public/images/menu/'.$value['image'].'">
            <h2 class="style_h2_menu">'.$value['name'].'</h2>
            <div class="p_box">
                <p class="p_left">Product ID: <b>'.$value['id'].'</b></p>
                <p class="p_left">Description: <b>'.$value['description'].';</b></p>
                <p class="p_left">Price: <b>'.$value['price'].'</b></p>
            </div>
            <input type="hidden" name="item" value="'.$value['id'].'"/>
            <button type="submit" name="add" class="btn_add">Add</button>
            </form>
        </div>';

        $previousCategory = $currentCategory;
    }

}

function displaySupplementOptions()
{
    $db = new Database();
    $db->query('SELECT supplement_name FROM supplement');

    $data = $db->resultArray();


    foreach($data as $value)
    {
        echo'<option value="'.strval($value['supplement_name']).'">'.strval($value['supplement_name']).'</option>';
    }
}


function displayMenuHot()
{

    $db = new Database();

    $db->query('SELECT * FROM menu_item LEFT JOIN category ON menu_item.category_id=category.cid ORDER BY category_id');
    $data = $db->resultArray();

    if(empty($data)){
        return false;
    }

    $previousCategory = '';

    foreach($data as $value)
    {
        $currentCategory = $value['category_id']; 

        if($currentCategory == $previousCategory){
            continue;
        }

        echo 
            '<div class="menu_flex_container">
            <img class="menu_item_img" src="/PizzaBox/public/images/menu/'.$value['image'].'">
            <h2 class="style_h2_menu">'.$value['name'].'</h2>
            <div class="p_box">
                <p class="p_left">Description: <b>'.$value['description'].';</b></p>
                <p class="p_left">Price: <b>'.$value['price'].'</b></p>
            </div>
            <a href="/PizzaBox/customers/login" class="a_link_box">Order Now</a>
            </div>';

        $previousCategory = $currentCategory;

    }
}

function generatePizzaMenu()
{
    $db = new Database();

    $db->query('SELECT * FROM menu_item LEFT JOIN category ON menu_item.category_id=category.cid WHERE ctg_name="Pizza" ORDER BY category_id');
    $data = $db->resultArray();

    if(empty($data)){
        return false;
    }

    foreach($data as $value)
    {
        echo 
        '<div class="menu_flex_container">
            <form action="/PizzaBox/orders/item" method="post" class="form_menu">
            <img class="menu_item_img" src="/PizzaBox/public/images/menu/'.$value['image'].'">
            <h2 class="style_h2_menu">'.$value['name'].'</h2>
            <div class="p_box">
                <p class="p_left">Product ID: <b>'.$value['id'].'</b></p>
                <p class="p_left">Description: <b>'.$value['description'].';</b></p>
                <p class="p_left">Price: <b>'.$value['price'].'</b></p>
            </div>
            <input type="hidden" name="item" value="'.$value['id'].'"/>
            <button type="submit" name="add" class="btn_add">Add</button>
            </form>
        </div>';
    }
    

}

function generatePastaMenu()
{
    $db = new Database();

    $db->query('SELECT * FROM menu_item LEFT JOIN category ON menu_item.category_id=category.cid WHERE ctg_name="Pasta" ORDER BY category_id');
    $data = $db->resultArray();

    if(empty($data)){
        return false;
    }

    
    foreach($data as $value)
    {
        echo 
        '<div class="menu_flex_container">
            <form action="/PizzaBox/orders/item" method="post" class="form_menu">
            <img class="menu_item_img" src="/PizzaBox/public/images/menu/'.$value['image'].'">
            <h2 class="style_h2_menu">'.$value['name'].'</h2>
            <div class="p_box">
                <p class="p_left">Product ID: <b>'.$value['id'].'</b></p>
                <p class="p_left">Description: <b>'.$value['description'].';</b></p>
                <p class="p_left">Price: <b>'.$value['price'].'</b></p>
            </div>
            <input type="hidden" name="item" value="'.$value['id'].'"/>
            <button type="submit" name="add" class="btn_add">Add</button>
            </form>
        </div>';
    }
    

}

function generateBeverageMenu()
{
    $db = new Database();

    $db->query('SELECT * FROM menu_item LEFT JOIN category ON menu_item.category_id=category.cid WHERE ctg_name="Beverage" ORDER BY category_id');
    $data = $db->resultArray();

    if(empty($data)){
        return false;
    }

    
    foreach($data as $value)
    {
        echo 
        '<div class="menu_flex_container">
            <form action="/PizzaBox/orders/item" method="post" class="form_menu">
            <img class="menu_item_img" src="/PizzaBox/public/images/menu/'.$value['image'].'">
            <h2 class="style_h2_menu">'.$value['name'].'</h2>
            <div class="p_box">
                <p class="p_left">Product ID: <b>'.$value['id'].'</b></p>
                <p class="p_left">Description: <b>'.$value['description'].';</b></p>
                <p class="p_left">Price: <b>'.$value['price'].'</b></p>
            </div>
            <input type="hidden" name="item" value="'.$value['id'].'"/>
            <button type="submit" name="add" class="btn_add">Add</button>
            </form>
        </div>';

    }

}

function displayOrderItem()
{
    $db = new Database();
    $item_id = $_POST['item'];

    /*if(empty($item_id)){
        header('location:'. URLROOT . '/orders/menu');
    }*/

    $db->query('SELECT * FROM menu_item WHERE id = :item_id');
    $db->bind(':item_id', $item_id);

    $row = $db->resultArray();

    //var_dump($row);

    if(empty($row)){
        return false;
    }
    
    echo 
    '<div class="menu_flex_container">
        <img class="menu_item_img" src="/PizzaBox/public/images/menu/'.$row[0]['image'].'">
        <h2 class="style_h2_menu">'.$row[0]['name'].'</h2>
        <div class="p_box">
            <p class="p_left">Product ID: <b>'.$row[0]['id'].'</b></p>
            <p class="p_left">Description: <b>'.$row[0]['description'].';</b></p>
            <p class="p_left">Price: <b>'.$row[0]['price'].'</b></p>
        </div>
    </div>';

    //return $item_id;

}

function generateItemProductsAsCheckBox()
{
    $item_id = $_POST['item'];
    $db = new Database();

    $db->query('SELECT name, description FROM menu_item WHERE id=:menu_item_id');
    $db->bind(':menu_item_id',$item_id);

    $data = $db->resultArray();
    //var_dump($data);
    $description = $data[0]['description'];
    //echo $description;
    $description_separated_items = explode(',',$description);

    //print_r($description_separated_items);
    
    echo '<input type="hidden" name="menu_item_name" value="'.$data[0]['name'].'"/>';
    echo '<input type="hidden" name="item" value="'.$item_id.'"/>';
    
    foreach($description_separated_items as $value)
    {
        echo '<label>'.strval($value).'';
        echo '<input type="checkbox" id="'.strval($value).'" name="remove_products[]" value="'.strval($value).'">';
        echo '</label>';
        echo '<br>';
    }
}

function supplementCheckBoxList()
{
    $db = new Database();

    $db->query('SELECT supplement_name FROM supplement');
    $data = $db->resultArray();
    //var_dump($data);
    
    foreach($data as $value)
    {
        echo '<label>'.strval($value['supplement_name']).'';
        echo '<input type="checkbox" id="'.strval($value['supplement_name']).'" name="add_supplements[]" value="'.strval($value['supplement_name']).'">';
        echo '</label>';
    }
}

function displayPendingOrders()
{
    $db = new Database();

    $db->query('SELECT dd.delivery_id, dd.delivery_man_id, od.id AS order_id, od.item_name,
     od.quantity, od.total, od.description, od.supplements , c.first_name, c.last_name, c.address,
      c.phone_number, dd.status, dd.date 
      FROM order_details od 
      INNER JOIN delivery_details dd on od.delivery_details_id = dd.delivery_id 
      INNER JOIN customer c on dd.customer_id = c.id 
      WHERE status = "Pending" 
      ORDER BY dd.delivery_id;');

    $rows = $db->resultArray();

    if(empty($rows)){
        echo "<h1>There are no pending orders at this moment.</h1>";
    }

    $deliveryData = [];

    foreach($rows as $values) {
        $deliveryData[$values['delivery_id']] = array(
            'item_names' => '',
            'total_price' => 0,
            'first_name' => '',
            'last_name' => '',
            'quantity' => '',
            'address' => '',
            'phone_number' => '',
            'date' => '',
            'status' => '',
            'order_id' => '',
            'description' => '',
            'supplements' => '',
            'deliveryman_id' => ''
        );
    }
    
    foreach ($rows as $value) {
        
        $deliveryData[$value['delivery_id']]['item_names'] = $deliveryData[$value['delivery_id']]['item_names'].$value['quantity']."x".$value['item_name'].", ";
        $deliveryData[$value['delivery_id']]['total_price'] = $deliveryData[$value['delivery_id']]['total_price'] + $value['total'];
        $deliveryData[$value['delivery_id']]['first_name'] = $value['first_name'];
        $deliveryData[$value['delivery_id']]['last_name'] = $value['last_name'];
        $deliveryData[$value['delivery_id']]['quantity'] = $deliveryData[$value['delivery_id']]['quantity']." ".$value['quantity'];
        $deliveryData[$value['delivery_id']]['address'] = $value['address'];
        $deliveryData[$value['delivery_id']]['phone_number'] = $value['phone_number'];
        $deliveryData[$value['delivery_id']]['date'] = $value['date'];
        $deliveryData[$value['delivery_id']]['status'] = $value['status'];
        $deliveryData[$value['delivery_id']]['order_id'] = $deliveryData[$value['delivery_id']]['order_id']." ".$value['order_id'];
        $deliveryData[$value['delivery_id']]['deliveryman_id'] = $value['delivery_man_id'];
    }

    foreach ($deliveryData as $key => $value) {
        if($value['status'] == "Pending") {
            echo 
            '<div class="menu_flex_container">
                <form action="/PizzaBox/deliverymans/Orders_list" method="get" class="form_menu">
                    <h2 class="style_h2_menu">Order '.$key.'</h2>
                    <div class="p_box">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Product
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Supplements
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';
                                for ($i = 0; $i < sizeof($rows); $i = $i + 1) {

                                    if($key == $rows[$i]['delivery_id']){
                                        echo   '<tr>
                                        <td>
                                            '.$rows[$i]['item_name'].'
                                        </td>
                                        <td>
                                            '.$rows[$i]['quantity'].'
                                        </td>
                                        <td>
                                            '.$rows[$i]['description'].'
                                        </td>
                                        <td>
                                            '.$rows[$i]['supplements'].'
                                        </td>
                                        <td>
                                            '.$rows[$i]['total'].'
                                        </td>
                                    </tr>';
                                    }
                                } 
                                
                        echo '</tbody>
                        </table>
                        <p class="p_left">Customer name: <b>'.$value['first_name'].' '.$value['last_name'].'</b></p>
                        <p class="p_left">Total: <b>'.$value['total_price'].'</b></p>
                        <p class="p_left">Customer addres: <b>'.$value['address'].'</b></p>
                        <p class="p_left">Customer phone: <b>'.$value['phone_number'].'</b></p>
                        <p class="p_left">Date of order: <b>'.$value['date'].'</b></p>
                    </div>
                    <input type="hidden" name="delivery_id" value="'.$key.'"/>
                    <button type="submit" name="accept" class="btn_deliveryman">Take delivery</button>
                </form>
            </div>';
        }
    }
}

function displayAcceptedOrders()
{
    $db = new Database();

    $db->query('SELECT dd.delivery_id, dd.delivery_man_id, od.id AS order_id, od.item_name,
    od.quantity, od.total, od.description, od.supplements , c.first_name, c.last_name, c.address,
    c.phone_number, dd.status, dd.date 
    FROM order_details od 
    INNER JOIN delivery_details dd on od.delivery_details_id = dd.delivery_id 
    INNER JOIN customer c on dd.customer_id = c.id 
    WHERE status = "Delivering" AND dd.delivery_man_id = :delivery_man_id
    ORDER BY dd.delivery_id;');

    $db->bind(':delivery_man_id', $_SESSION['deliveryman_id']);
    $rows = $db->resultArray();

    if(empty($rows)){
        echo "<h1>You don't have any accepted orders.</h1>";
    }

    $deliveryData = [];

    foreach($rows as $values) {
        $deliveryData[$values['delivery_id']] = array(
            'item_names' => '',
            'total_price' => 0,
            'first_name' => '',
            'last_name' => '',
            'quantity' => '',
            'address' => '',
            'phone_number' => '',
            'date' => '',
            'status' => '',
            'order_id' => '',
            'description' => '',
            'supplements' => '',
            'deliveryman_id' => ''
        );
    }
    
    foreach ($rows as $value) {
            
        $deliveryData[$value['delivery_id']]['item_names'] = $deliveryData[$value['delivery_id']]['item_names'].$value['quantity']."x".$value['item_name'].", ";
        $deliveryData[$value['delivery_id']]['total_price'] = $deliveryData[$value['delivery_id']]['total_price'] + $value['total'];
        $deliveryData[$value['delivery_id']]['first_name'] = $value['first_name'];
        $deliveryData[$value['delivery_id']]['last_name'] = $value['last_name'];
        $deliveryData[$value['delivery_id']]['quantity'] = $deliveryData[$value['delivery_id']]['quantity']." ".$value['quantity'];
        $deliveryData[$value['delivery_id']]['address'] = $value['address'];
        $deliveryData[$value['delivery_id']]['phone_number'] = $value['phone_number'];
        $deliveryData[$value['delivery_id']]['date'] = $value['date'];
        $deliveryData[$value['delivery_id']]['status'] = $value['status'];
        $deliveryData[$value['delivery_id']]['order_id'] = $deliveryData[$value['delivery_id']]['order_id']." ".$value['order_id'];
        $deliveryData[$value['delivery_id']]['deliveryman_id'] = $value['delivery_man_id'];
    }

    foreach ($deliveryData as $key => $value) {
        if($value['status'] == "Delivering" && $_SESSION['deliveryman_id'] == $value['deliveryman_id']) {
            echo 
            '<div class="menu_flex_container">
                <form action="/PizzaBox/deliverymans/my_orders" method="get" class="form_menu">
                    <h2 class="style_h2_menu">Order '.$key.'</h2>
                    <div class="p_box">
                        <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    Product
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    Supplements
                                </th>
                                <th>
                                    Price
                                </th>
                            </tr>
                        </thead>
                        <tbody>';
                            for ($i = 0; $i < sizeof($rows); $i = $i + 1) {

                                if($key == $rows[$i]['delivery_id']){
                                    echo   '<tr>
                                    <td>
                                        '.$rows[$i]['item_name'].'
                                    </td>
                                    <td>
                                        '.$rows[$i]['quantity'].'
                                    </td>
                                    <td>
                                        '.$rows[$i]['description'].'
                                    </td>
                                    <td>
                                        '.$rows[$i]['supplements'].'
                                    </td>
                                    <td>
                                        '.$rows[$i]['total'].'
                                    </td>
                                </tr>';
                                }
                            } 
                        
                        echo '</tbody>
                        </table>
                        <p class="p_left">Customer name: <b>'.$value['first_name'].' '.$value['last_name'].'</b></p>
                        <p class="p_left">Total: <b>'.$value['total_price'].'</b></p>
                        <p class="p_left">Customer addres: <b>'.$value['address'].'</b></p>
                        <p class="p_left">Customer phone: <b>'.$value['phone_number'].'</b></p>
                        <p class="p_left">Date of order: <b>'.$value['date'].'</b></p>
                    </div>
                    <input type="hidden" name="delivery_id" value="'.$key.'"/>
                    <input type="hidden" name="delivery_finish" value="Finished"/>
                    <button type="submit" name="accept" class="btn_deliveryman">Finish delivery</button>
                </form>
            </div>';
               
        }
    }
}

