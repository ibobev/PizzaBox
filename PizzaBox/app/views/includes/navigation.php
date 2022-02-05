<header id="header">
    <h1 class="style_h1">PizzaBox</h1>
    <nav class="navigation_bar">

        <div class="slide">
			<div id="pos_slide"  onclick="openSlideMenu()">
				<svg width="25" height="25">
					<path d="M0,5 25,5" stroke="#dd8e15" stroke-width="5"/>
					<path d="M0,14 25,14" stroke="#dd8e15" stroke-width="5"/>
					<path d="M0,23 25,23" stroke="#dd8e15" stroke-width="5"/>
				</svg>
			</div>
		</div>

        <ul class="nav_links">
            <?php if(!isLoggedIn()) : ?>
            <li>
                <a href="<?php echo URLROOT ?>/index">Home</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/customers/register">Register</a>
            </li>
            <?php endif; ?> 
            <?php if(isLoggedIn()) : ?>
            <li>
                <a class="cart_nav" href="<?php echo URLROOT ?>/orders/cart">
                    <div>
                    <img class="cart_img" src ="/PizzaBox/public/images/cart.png">
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo URLROOT ?>/orders/menu">Menu</a>
            </li>
            <li>
                <a href="<?php echo URLROOT ?>/customers/account">Account</a>
            </li>
            <?php endif; ?> 
            <li>
                <?php if(!isLoggedIn()) : ?>
                    <a href="<?php echo URLROOT; ?>/customers/login">Login</a>
                <?php else : ?>
                    <a href="<?php echo URLROOT; ?>/customers/logout">Logout</a>
                <?php endif; ?>    
            </li>
        </ul>
    </nav>
        <div id="side_menu" class="side_nav">
			<div class="btn_close" onclick="closeSlideMenu()">&times; </div>
            <?php if(!isLoggedIn()) : ?>
                <a href="<?php echo URLROOT ?>/index">Home</a>
                <a href="<?php echo URLROOT; ?>/customers/register">Register</a>
            <?php endif; ?> 
            <?php if(isLoggedIn()) : ?>
                <a href="<?php echo URLROOT ?>/orders/cart">Cart</a>
                <a href="<?php echo URLROOT ?>/orders/menu">Menu</a>
                <a href="<?php echo URLROOT ?>/customers/account">Account</a>
            <?php endif; ?> 
                <?php if(!isLoggedIn()) : ?>
                    <a href="<?php echo URLROOT; ?>/customers/login">Login</a>
                <?php else : ?>
                    <a href="<?php echo URLROOT; ?>/customers/logout">Logout</a>
                <?php endif; ?>    
			</div>	
</header>