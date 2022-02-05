<header id="header">
    <h1 class="style_h1">PizzaBox Deliveryman</h1>
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
            <li>
                <a href="<?php echo URLROOT ?>/deliverymans/orders_list">Orders List</a>
            </li>
            <li>
                <a href="<?php echo URLROOT ?>/deliverymans/my_orders">My Orders</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/deliverymans/logoutDeliveryman">Logout</a>    
            </li>
        </ul>
    </nav>

    <div id="side_menu" class="side_nav">
		<div class="btn_close" onclick="closeSlideMenu()">&times; </div>
            <a href="<?php echo URLROOT ?>/deliverymans/orders_list">Orders List</a>
            <a href="<?php echo URLROOT ?>/deliverymans/my_orders">My Orders</a>
            <a href="<?php echo URLROOT; ?>/deliverymans/logoutDeliveryman">Logout</a>
	</div>	
</header>