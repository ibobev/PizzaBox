<?php 
	if(isLoggedIn()){
		header('location: '. URLROOT . '/customers/account');
	}
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/PizzaBox/public/css/style-forms.css">
		<link rel="stylesheet" href="/PizzaBox/public/css/media-forms.css">
		<title>Login</title>
	</head>
	<body>
		<main>
			<section id="wrap_form">
				<div class="form_box">
					<h1>Login</h1>
					<div class="msg">
						<p><?php echo $data['email_err']; ?></p>
                        <p><?php echo $data['pwd_err']; ?></p>
						
					</div> 
					<form action="<?php echo URLROOT; ?>/customers/login" method="post" id="input_form" class="input_credentials">
						<input type="text" name="email" class="input_field" placeholder="E-mail" required>
						<input type="password" name="pwd" class="input_field" placeholder="Password" required>
						<button type="submit" name="submit_log" class="btn_submit">Log In</button>
					</form>
					<p class="p_style">Don't have an account? Register <a href="<?php echo URLROOT; ?>/customers/register">here</a></p>
				</div>
			</section>

		</main>	
	</body>

</html>