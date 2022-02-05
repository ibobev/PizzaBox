<?php
    if(!isLoggedInAdmin()){
		header('location: '. URLROOT . '/admins/login');
	}
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/PizzaBox/public/css/style.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/style-footer.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/style-admin.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/media-style.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/media-dashboard.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/style-header.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
		<title>Manage deliveryman</title>
	</head>
	<body>

        <?php
            require APPROOT . '/views/includes/navadmin.php';
        ?>
		<main>

            <div id="admin_nav">
                <button onclick="displayAddDeliverymanForm()" id="btn_add" class="btn_admin">Add</button>
                <button onclick="displayDeliverymanList()" id="btn_list" class="btn_admin">list</button>
            </div>
            <section id="admin_page">
                <div id="display_add">
                    <div class="details_box">
                        <h2 class="h2_style_admin">Add deliveryman</h1>
                        <div>
                            <p><?php echo $data['success_msg']; ?></p>
                            <p><?php echo $data['email_err']; ?></p>
                            <p><?php echo $data['firstname_err']; ?></p>
                            <p><?php echo $data['lastname_err']; ?></p>
                            <p><?php echo $data['pwd_err']; ?></p>
                            <p><?php echo $data['pwdr_err']; ?></p>
                        </div>
                        <form action="<?php echo URLROOT; ?>/admins/deliveryman" method="post" id="input_form" class="form_style_admin">
                            <input type="text" name="email" class="input_field" placeholder="E-mail" required>
                            <input type="text" name="firstname" class="input_field" placeholder="First Name" required>
                            <input type="text" name="lastname" class="input_field" placeholder="Last Name" required>
                            <input type="password" name="pwd" class="input_field" placeholder="Password" required>
                            <input type="password" name="pwdr" class="input_field" placeholder="Confirm Password" required>
                            <button type="submit" name="submit_reg" class="btn_form">Register</button>
                        </form>
                    </div>
                </div>
                <div id="display_list">
                    <div class="details_box" id="dis_list_table">
                        <h2 class="h2_style_admin">Deliveryman list</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Password
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php 
                                    if($data["deliveryman_list"]) {
                                        foreach ($data["deliveryman_list"] as $value) {
                                            echo '<tr>
                                                <td>
                                                    '.$value["first_name"].' '.$value["last_name"].'
                                                </td>
                                                <td>
                                                    '.$value["email"].'
                                                </td>
                                                <td>
                                                    '.$value["password"].'
                                                </td>
                                                <td>
                                                    <form action="'.URLROOT.'/admins/deliveryman" method="get">
                                                        <input type="hidden" name="deliveryman_id" value="'.$value["id"].'">
                                                        <input type="submit" value="x" name="remove_btn">
                                                    </form>
                                                </td>
                                            </tr>';
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
		</main>
        <script src="/PizzaBox/public/javascript/admin.js"></script>	
	</body>

</html>