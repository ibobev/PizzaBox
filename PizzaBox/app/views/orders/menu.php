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
    <title>Menu</title>
</head>

<body>

<?php
    require APPROOT . '/views/includes/navigation.php';
?>

<main>

<div id="menu_nav">
    <button onclick="displayPizza()" id="btn_pizza" class="btn_item">Pizza</button>
	<button onclick="displayPasta()" id="btn_pasta" class="btn_item">Pasta</button>
    <button onclick="displayBeverage()" id="btn_beverage" class="btn_item">Beverage</button> 
</div>

<section id="menu_section">
    <div id="display_pizza">
    <?php generatePizzaMenu();?>
    </div>
    <div id="display_pasta">
    <?php generatePastaMenu();?>
    </div>
    <div id="display_beverage">
    <?php generateBeverageMenu();?>
    </div>
    

</section>
</main>
    <?php
        require APPROOT . '/views/includes/footer.php';
    ?>
    <script src="/PizzaBox/public/javascript/menu.js"></script>
</body>
</html>