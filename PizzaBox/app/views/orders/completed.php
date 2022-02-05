<?php if(!isCartSet()){
    header('location:'. URLROOT . '/customers/login');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content ="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PizzaBox/public/css/style.css">
    <link rel="stylesheet" href="/PizzaBox/public/css/style-footer.css">
    <link rel="stylesheet" href="/PizzaBox/public/css/style-completed.css">
    <link rel="stylesheet" href="/PizzaBox/public/css/style-header.css">
    <link rel="stylesheet" href="/PizzaBox/public/css/media-style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <title>Completed</title>
</head>

<body>

<?php
    require APPROOT . '/views/includes/navigation.php';
?>

<main>

<section id="completed_section">
    
<div class="completed_box">
    <h1>Your order has been sent successfully!</h1>
    <img class="completed_img_style" src="/PizzaBox/public/images/completedlogo.png" alt="PizzaBox logo">
    <p class="completed_p">Thank you for choosing PizzaBox!</p>
    <img>
</div>

</section>
</main>
    <?php
        require APPROOT . '/views/includes/footer.php';
    ?>
    <script src="/PizzaBox/public/javascript/menu.js"></script>    
</body>
</html>