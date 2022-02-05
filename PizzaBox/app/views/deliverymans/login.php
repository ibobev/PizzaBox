<?php 
	if(isLoggedInDeliveryman()){
		header('location: '. URLROOT . '/deliverymans/orders_list');
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <link rel="stylesheet" href="/PizzaBox/public/css/style-forms.css">
	    <title>Deliveryman Login</title>
    </head>

    <body>
		<main>
			<section id="wrap_form">
				<div class="form_box">
					<h1>Deliveryman Login</h1>
					<div class="msg">
						<p><?php echo $data['email_err']; ?></p>
                        <p><?php echo $data['pwd_err']; ?></p>
						
					</div> 
					<form action="<?php echo URLROOT; ?>/deliverymans/login" method="post" id="input_form" class="input_credentials">
						<input type="text" name="email" class="input_field" placeholder="Email" required>
						<input type="password" name="pwd" class="input_field" placeholder="Password" required>
						<button type="submit" name="submit_log" class="btn_submit">Log In</button>
					</form>
				</div>
			</section>

		</main>	
    </body>
</html>