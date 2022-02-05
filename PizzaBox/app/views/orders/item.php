<?php 
    if(!isLoggedIn()){
        header('location: '. URLROOT . '/customers/login');
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content ="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PizzaBox/public/css/style.css">
    <link rel="stylesheet" href="/PizzaBox/public/css/style-footer.css">
    <link rel="stylesheet" href="/PizzaBox/public/css/style-order.css">
	<link rel="stylesheet" href="/PizzaBox/public/css/style-header.css">
	<link rel="stylesheet" href="/PizzaBox/public/css/style-errors.css">
    <link rel="stylesheet" href="/PizzaBox/public/css/media-style.css">
    <link rel="stylesheet" href="/PizzaBox/public/css/media-menu.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <title>Item</title>
</head>

<body>

<?php
    require APPROOT . '/views/includes/navigation.php';
?>

<main>
<section id="err_section">
    <p class="p_info_order"><?php  if(isset($data['success_msg'])){echo $data['success_msg']; } ?></p>
    <p class="p_info_order"><?php  if(isset($data['quantity_err'])){echo $data['quantity_err']; } ?></p>
    <p class="p_info_order"><?php  if(isset($data['all_products_removed_err'])){echo $data['all_products_removed_err']; } ?></p>
</section>

<section id="item_section">
    <?php displayOrderItem(); ?>
    <div class="menu_flex_container">
    <form action="<?php echo URLROOT;?>/orders/addToCart" method="post" class="form_menu">
    <legend class="style_legend">Products</legend>
    <p>Check any product you wish to remove!</p>
    <div class="products_box">
    <?php generateItemProductsAsCheckBox(); ?>
    </div>
    <legend id="quantity" class="style_legend">Quantity</legend>
    <input type="text" name="quantity" class="input_field_size" placeholder="0" required>
    <legend id="supplements"class="style_legend">Supplements</legend>
    <p>Check any supplement you wish to add to order!</p>
    <div class="supplement_box">
    <?php supplementCheckBoxList(); ?>
    </div>
    <button type="submit" name="add" class="btn_add">Confirm</button>
    </form>
    </div>
</section>
</main>
    <?php
        require APPROOT . '/views/includes/footer.php';
    ?>
    <script src="/PizzaBox/public/javascript/menu.js"></script>
</body>
</html>