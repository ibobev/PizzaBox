<?php
    if(!isLoggedInDeliveryman()){
		header('location: '. URLROOT . '/deliverymans/login');
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content ="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/PizzaBox/public/css/style.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/style-footer.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/style-header.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/style-deliveryman.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/media-deliveryman.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
        <title>Active Orders</title>
    </head>

    <body>
    <?php
        require APPROOT . '/views/includes/navdeliveryman.php';
    ?>

    <main>
            <section id="orders_section">
                <?php displayPendingOrders(); ?>
            </section>
    </main>

    <?php
        require APPROOT . '/views/includes/footer.php';
    ?>
    <script src="/PizzaBox/public/javascript/admin.js"></script>
    </body>
</html>