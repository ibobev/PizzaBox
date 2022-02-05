<?php
    if(!isLoggedInAdmin()){
		header('location: '. URLROOT . '/admins/login');
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
        <link rel="stylesheet" href="/PizzaBox/public/css/style-admin.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/media-style.css">
        <link rel="stylesheet" href="/PizzaBox/public/css/media-dashboard.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
        <title>Dashboard</title>
    </head>

    <body>
    <?php
        require APPROOT . '/views/includes/navadmin.php';
    ?>

    <main>
        <div id="admin_nav">
			<button onclick="displayCategoryForm()" id="btn_category" class="btn_admin">Category</button>
			<button onclick="displayProductForm()" id="btn_product" class="btn_admin">Products</button>
            <button onclick="displayMenuForm()" id="btn_menu" class="btn_admin">Menu</button> 
            <button onclick="displaySupplementForm()" id="btn_supplement" class="btn_admin">Supplements</button> 
        </div>
        <section id="admin_page">
            <!-- Menu -->
            <div id="display_menu">
                <p class="p_info"><?php  if(isset($data['success_msg_menu'])){echo $data['success_msg_menu']; } ?></p>
                <p class="p_info"><?php  if(isset($data['category_name_menu_err'])){echo $data['category_name_menu_err']; } ?></p>
                <p class="p_info"><?php  if(isset($data['menu_item_name_err'])){echo $data['menu_item_name_err']; } ?></p>
                <p class="p_info"><?php  if(isset($data['price_err'])){echo $data['price_err']; } ?></p>
                <p class="p_info"><?php  if(isset($data['no_products_selected'])){echo $data['no_products_selected']; } ?></p>
                <p class="p_info"><?php  if(isset($data['menu_id_err'])){echo $data['menu_id_err']; } ?></p>
                <p class="p_info"><?php  if(isset($data['img_err'])){echo $data['img_err']; } ?></p>
                <div class="details_box">
                    <h2 class="h2_style_admin">Create Menu Item</h2>
                    <form action="<?php echo URLROOT;?>/admins/createMenuItem" method="post" class="form_style_admin" enctype="multipart/form-data">
                        <legend>Category</legend>
                        <select class="options_box" name="category_name_menu">
                            <option value="">...</option>
                            <?php displayCategoryOptions(); ?>
                        </select>
                        <hr>
                        <label class="lbl">Name
					    <input type="text" name="menu_item_name" class="input_field" placeholder="Name" required>
					    </label>
                        <hr>
                        <legend >Products</legend>
                        <hr class="hr_dot">
                        <?php displayMenuItemOptions();?>
                        <hr>
                        <label class="lbl">Price
                        <input type="text" name="price" class="input_field" placeholder="0.00" required>
                        </label>
                        <hr>
                        <legend>Image</legend>
                        <input type="file" name="img" class="btn_img_select" required>
                        <hr>
                        <button type="submit" name="submit_create" class="btn_form">Create</button>
                    </form>
                </div>

            <!-- Update -->
                <div class="details_box">
                    <h2 class="h2_style_admin">Update Menu Item</h2>
                    <form action="<?php echo URLROOT;?>/admins/updateMenuItem" method="post" class="form_style_admin" enctype="multipart/form-data">
                        <legend>Menu Item ID</legend>
                        <select class="options_box" name="menu_item_id">
                            <option value="">...</option>
                            <?php displayMenuID()?>
                        </select>
                        <hr>
                        
                        <label class="lbl">Name
					    <input type="text" name="menu_item_name" class="input_field" placeholder="Name" required>
					    </label>
                        <hr>
                        
                        <label class="lbl">Price
                        <input type="text" name="price" class="input_field" placeholder="0.0" required>
                        </label>
                        <hr>
                        <legend>Image</legend>
                        <input type="file" name="img" class="btn_img_select" required>
                        <hr>
                        <button type="submit" name="submit_update" class="btn_form">Update</button>
                    </form>
                </div>

            <!--Delete-->
                <div class="details_box">
                    <h2 class="h2_style_admin">Delete Menu Item</h2>
                    <form action="<?php echo URLROOT;?>/admins/deleteMenuItem" method="post" class="form_style_admin">
                        <legend>Menu Item ID</legend>
                        <select class="options_box" name="menu_item_id">
                            <option value="">...</option>
                            <?php displayMenuID() ?>
                        </select>
                        <button type="submit" name="submit_delete" class="btn_form">Delete</button>
                    </form>
                </div>
            </div>
            <!-- Category -->
            <div id="display_category">
                    <p class="p_info"><?php  if(isset($data['category_name_err'])){echo $data['category_name_err']; } ?></p>
                    <p class="p_info"><?php  if(isset($data['category_new_name_err'])){echo $data['category_new_name_err']; } ?></p>
                    <p class="p_info"><?php  if(isset($data['success_msg'])){echo $data['success_msg']; } ?></p>
                <div class="details_box">
                    <h2 class="h2_style_admin">Create Category</h2>
                    <form action="<?php echo URLROOT;?>/admins/createCategory" method="post" class="form_style_admin">
                        <label class="lbl">Category Name
					    <input type="text" name="category_name" class="input_field" placeholder="Category Name" required>
					    </label>
                        
                        <button type="submit" name="submit_create" class="btn_form">Create</button>
                    </form>
                </div>

            <!--Update-->
            
                <div class="details_box">
                    <h2 class="h2_style_admin">Update Category</h2>
                    <form action="<?php echo URLROOT;?>/admins/updateCategory" method="post" class="form_style_admin" >
                        <legend>Category</legend>
                        <select class="options_box" name="selected_category_name">
                            <option value="">...</option>
                            <?php displayCategoryOptions(); ?>
                        
                        </select>
                        <hr>
                        <label class="lbl">Category New Name
					    <input type="text" name="category_new_name" class="input_field" placeholder="Category New Name" required>
					    </label>
                        <button type="submit" name="submit_update" class="btn_form">Update</button>
                    </form>
                </div>

            <!--Delete-->
                <div class="details_box">
                    <h2 class="h2_style_admin">Delete Category</h2>
                    <form action="<?php echo URLROOT;?>/admins/deleteCategory" method="post" class="form_style_admin">
                        <legend>Category</legend>
                        <select class="options_box" name="selected_category_name">
                            <option value="">...</option>
                            <?php displayCategoryOptions(); ?>

                        </select>
                        <button type="submit" name="submit_delete" class="btn_form">Delete</button>
                    </form>
                </div>
            </div>

            <!-- Product -->

            <div id="display_product">
                <p class="p_info"><?php  if(isset($data['success_msg_product'])){echo $data['success_msg_product']; } ?></p>
                <p class="p_info"><?php  if(isset($data['product_type_name_err'])){echo $data['product_type_name_err']; } ?></p>
                <p class="p_info"><?php  if(isset($data['product_item_name_err'])){echo $data['product_item_name_err']; } ?></p>
                <p class="p_info"><?php  if(isset($data['product_new_name_err'])){echo $data['product_new_name_err']; } ?></p>
                <p class="p_info"><?php  if(isset($data['selected_item_err'])){echo $data['selected_item_err']; } ?></p>
                <div class="details_box">
                    <h2 class="h2_style_admin">Create Product Type</h2>
                    <form action="<?php echo URLROOT;?>/admins/createType" method="post" class="form_style_admin">
                        <label class="lbl">Product Type
					    <input type="text" name="product_type_name" class="input_field" placeholder="Type" required>
					    </label>
                        <button type="submit" name="submit_create" class="btn_form">Create</button>
                    </form>
                </div>


                <div class="details_box">
                    <h2 class="h2_style_admin">Create Product Item</h2>
                    <form action="<?php echo URLROOT;?>/admins/createProduct" method="post" class="form_style_admin" >
                        <legend>Product Type</legend>
                        <select class="options_box" name="product_type">
                            <option value="">...</option>
                            <?php displayTypeOptions() ?>
                        </select>
                        <hr>
                        <label class="lbl">Product Name
					    <input type="text" name="product_item_name" class="input_field" placeholder="Product name" required>
					    </label>
                        
                        <button type="submit" name="submit_create" class="btn_form">Create</button>
                    </form>
                </div>

            <!--Update-->
                <div class="details_box">
                    <h2 class="h2_style_admin">Update Product</h2>
                    <form action="<?php echo URLROOT;?>/admins/updateProduct" method="post" class="form_style_admin" >
                        <legend>Product Item Name</legend>
                        <select class="options_box" name="product_name">
                            <option value="">...</option>
                            <?php displayItemOptions();?>
                        </select>
                        <hr>
                        <label class="lbl">Product New Name
					    <input type="text" name="product_new_name" class="input_field" placeholder="Product New Name" required>
					    </label>
                        <button type="submit" name="submit_update" class="btn_form">Update</button>
                    </form>
                </div>

            <!--Delete-->
                <div class="details_box">
                    <h2 class="h2_style_admin">Delete Product Item</h2>
                    <form action="<?php echo URLROOT;?>/admins/deleteProductItem" method="post" class="form_style_admin">
                        <legend>Product Item</legend>
                        <select class="options_box" name="product_item_name">
                            <option value="">...</option>
                            <?php displayItemOptions(); ?>
                        </select>
                        <button type="submit" name="submit_create" class="btn_form">Delete</button>
                    </form>
                </div>
                <div class="details_box">
                    <h2 class="h2_style_admin">Delete Product Type</h2>
                    <form action="<?php echo URLROOT;?>/admins/deleteProductType" method="post" class="form_style_admin">
                        <legend>Product Type</legend>
                        <select class="options_box" name="product_type">
                            <option value="">...</option>
                            <?php displayTypeOptions(); ?>
                        </select>
                        <button type="submit" name="submit_create" class="btn_form">Delete</button>
                    </form>
                </div>
            </div>
            <!-- Supplements -->
            <div id="display_supplement">
                    <p class="p_info"><?php  if(isset($data['supplement_name_err'])){echo $data['supplement_name_err']; } ?></p>
                    <p class="p_info"><?php  if(isset($data['supplement_new_name_err'])){echo $data['supplement_new_name_err']; } ?></p>
                    <p class="p_info"><?php  if(isset($data['success_msg'])){echo $data['success_msg']; } ?></p>
                <div class="details_box">
                    <h2 class="h2_style_admin">Create Supplement</h2>
                    <form action="<?php echo URLROOT;?>/admins/createSupplement" method="post" class="form_style_admin">
                        <label class="lbl">Supplement Name
					    <input type="text" name="supplement_name" class="input_field" placeholder="Supplement Name" required>
					    </label>
                        
                        <button type="submit" name="submit_create" class="btn_form">Create</button>
                    </form>
                </div>

            <!--Update-->
            
                <div class="details_box">
                    <h2 class="h2_style_admin">Update Supplement</h2>
                    <form action="<?php echo URLROOT;?>/admins/updateSupplement" method="post" class="form_style_admin" >
                        <legend>Supplement</legend>
                        <select class="options_box" name="selected_supplement_name">
                            <option value="">...</option>
                            <?php displaySupplementOptions(); ?>
                        
                        </select>
                        <hr>
                        <label class="lbl">Supplement New Name
					    <input type="text" name="supplement_new_name" class="input_field" placeholder="Supplement New Name" required>
					    </label>
                        <button type="submit" name="submit_update" class="btn_form">Update</button>
                    </form>
                </div>

            <!--Delete-->
                <div class="details_box">
                    <h2 class="h2_style_admin">Delete Supplement</h2>
                    <form action="<?php echo URLROOT;?>/admins/deleteSupplement" method="post" class="form_style_admin">
                        <legend>Supplement</legend>
                        <select class="options_box" name="selected_supplement_name">
                            <option value="">...</option>
                            <?php displaySupplementOptions(); ?>

                        </select>
                        <button type="submit" name="submit_delete" class="btn_form">Delete</button>
                    </form>
                </div>
            </div>


        </section>
    </main>

    <?php
        require APPROOT . '/views/includes/footer.php';
    ?>
    <script src="/PizzaBox/public/javascript/admin.js"></script>
    </body>
</html>
