<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove']))
    {
        array_splice($_SESSION['cart'], $_POST['item'],1);
        header('location:'. URLROOT . '/orders/cart'); 
    }
?>

<div id="cart_details">
<section id="err_section">
    <p class="p_info_order"><?php  if(isset($data['address_err'])){echo $data['address_err']; } ?></p>
    <p class="p_info_order"><?php  if(isset($data['phone_err'])){echo $data['phone_err']; } ?></p>
</section>
<?php $totalCost = 0;?>
<h1 class="h1_cart">Order Details</h1>
<div id="order_table">
<table class="table_style">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Supplements</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Remove</th>
            
        </tr>
    </thead>
    <tbody>
        <?php 
            $index = 0;
            foreach($_SESSION['cart'] as $item)
            {
                echo'
                <tr> 
                    <td>'.
                        $item[0]
                    .'</td>
                    <td>'.
                        $item[1]
                    .'</td>
                    <td>'.
                        $item[2]
                    .'</td>
                    <td>'.
                        $item[3]
                    .'</td>
                    <td>'.
                        $item[4]
                    .'</td>
                    <td>
                    <form action='.URLROOT.'/orders/cart method="post">
                        <input type="hidden" name="item" value="'.$index.'"/>
                        <button type="submit" name="remove" class="btn_remove">X</button>
                    </form>
                    </td>
                </tr>
                ';
                $index +=1;
                $totalCost += $item[4];
            }   
        ?>
    </tbody>
</table>

</div>
<div id="checkout_div">
    <h1 class="h1_cart">Total Cost:</h1>
    <p class="total_cost">&euro;<?php echo $totalCost;?></p>
    <form action="<?php echo URLROOT;?>/orders/checkout" method="post" class="form_checkout">
    <input type="hidden" name="address" value="<?php echo $_SESSION['address'] ?>"/>
    <input type="hidden" name="phone" value="<?php echo $_SESSION['phone_number'] ?>"/>
    <input type="hidden" name="customer" value="<?php echo $_SESSION['customer_id'] ?>"/>
    <?php 
        foreach($_SESSION['cart'] as $item)
        {
            echo '
            <input type="hidden" name="order_details[]" value="'.$item[0].'"/>
            <input type="hidden" name="order_details[]" value="'.$item[1].'"/>
            <input type="hidden" name="order_details[]" value="'.$item[2].'"/>
            <input type="hidden" name="order_details[]" value="'.$item[3].'"/>
            <input type="hidden" name="order_details[]" value="'.$item[4].'"/>
            ';
        }
    ?>
    <input type="hidden" name="data" value="$_SESSION['cart']"/>
    <button type="submit" name="checkout" class="btn_checkout">Checkout</button>
    </form>
</div>
</div>


