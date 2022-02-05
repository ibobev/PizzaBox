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
    <title>Cart</title>
</head>

<body>

<?php
    require APPROOT . '/views/includes/navigation.php';
?>

<main>

<section id="cart_section">
    
<?php 
    if(empty($_SESSION['cart']) ){
        echo'
        <div class="empty_cart">
        <h1 class="h1_cart">Currently your cart is empty!</h1>
        </div>';
    }else{
        require_once APPROOT . '/views/includes/cart_details.php';
    } 
?>

</section>
</main>
    <?php
        require APPROOT . '/views/includes/footer.php';
    ?>
    <script src="/PizzaBox/public/javascript/menu.js"></script>
</body>
</html>