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
		<title>Register</title>
	</head>
	<body>
		<main>
			<section id="wrap_form">
				<div class="form_box">
					<h1>Register</h1>
					<div class="msg">
						<p class = 'success'><?php echo $data['success_msg']; ?></p>
						<p><?php echo $data['email_err']; ?></p>
						<p><?php echo $data['name_err']; ?></p>
						<p><?php echo $data['pwd_err']; ?></p>
						<p><?php echo $data['pwdr_err']; ?></p>
					</div>
					<form action="<?php echo URLROOT; ?>/customers/register" method="post" id="input_form" class="input_credentials">
                        <input type="text" name="email" class="input_field" placeholder="E-mail" value="<?php //echo $email; ?>" required>
                        <input type="text" name="name" class="input_field" placeholder="First Name" value="<?php //echo $name; ?>" required>
						<input type="password" name="pwd" class="input_field" placeholder="Password" required>
						<input type="password" name="pwdr" class="input_field" placeholder="Confirm Password" required>
                        <button type="submit" name="submit_reg" class="btn_submit">Register</button>
					</form>
					<p class="p_style">Already have an account? Log In <a href="<?php echo URLROOT ?>/customers/login">here</a></p>
				</div>

			</section>
		</main>	
	</body>

</html>