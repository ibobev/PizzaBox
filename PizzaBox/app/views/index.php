<!DOCTYPE html>
<html>

<?php
    require APPROOT . '/views/includes/head.php';
?>

<body>

<?php
    require APPROOT . '/views/includes/navigation.php';
?>

<main>
<section id="landing_page">
    <div class="crop_img">
        <img id="home_img" src="/PizzaBox/public/images/pizzadisplay.jpg">
    </div>
    <div id="text_box">
        <img id="logo_img" src ="/PizzaBox/public/images/pizzaboxlogotr.png">
        <a href="<?php echo URLROOT; ?>/customers/login" class="a_link">Order Now</a>
    </div>
</section>

<div class="separator_box"></div>

<section id="hot">
<h2 class="style_hot_h2">Popular orders</h2>
<div class="pizza_flexbox">
    <?php displayMenuHot();?>
</div>
</section>

</section>
<section id="about">
    <div id="abt_box">
        <h2 class="style_courgette">About Us</h2>
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel semper ipsum, id accumsan turpis.
        Donec ullamcorper dapibus nulla. Pellentesque commodo, dolor at commodo commodo, risus leo laoreet quam, 
        vitae iaculis lectus nisi a erat. Fusce viverra consequat sagittis. Nullam euismod tincidunt urna et tristique. 
        Sed egestas risus ac tincidunt faucibus.Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </p>
        <div class="social_img_box">
		<a href="https://www.facebook.com/" target="_blank">
			<img class="social_img_style" src="/PizzaBox/public/images/social/fb.png" alt="Facebook">
		</a>
        <a href="https://instagram.com/" target="_blank">
			<img class="social_img_style" src="/PizzaBox/public/images/social/insta.png" alt="Instagram">
        </a>
		<a href="https://twitter.com/" target="_blank">
			<img class="social_img_style" src="/PizzaBox/public/images/social/tw.png" alt="Twitter">
        </a>
        <a href="https://youtube.com/" target="_blank">
			<img class="social_img_style" src="/PizzaBox/public/images/social/yt.png" alt="Youtube">
        </a>
	</div>
        </div>
        
    <div class="parallax_effect"></div>
    
</section>

<div class="separator_box2"></div>

</main>

<?php
    require APPROOT . '/views/includes/footer.php';
?>

<script src="/PizzaBox/public/javascript/script.js"></script>
</body>
</html>