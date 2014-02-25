<?php 
// Create or access the session
session_start();
?>
<!DOCTYPE HTML> 
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/modules/head.php'; ?>
    </head>
    <body>
        <section id="container">
            <nav class="menubar">
                <?php include $_SERVER['DOCUMENT_ROOT'].'/modules/menu-bar.php';?>
            </nav>
            <header>
                <?php include $_SERVER['DOCUMENT_ROOT'].'/modules/header.php';?>
            </header>
            <section class="main-content title-bk-img">
                <nav class="main-menu">
                    <?php include $_SERVER['DOCUMENT_ROOT'].'/modules/main-menu.php';?>
                </nav>
                <!--<img class="title-bk-img" src="img/title_bk_img.png" alt="Image fades to white behind menu" />-->
                <section>
                    <h2 id="page-top">Product Management</h2>
                    <ul class="page-contents">
                        <li class="page-sub-menu">Categories
                        <ul>
                            <?php
                            foreach($_SESSION['categories'] as $item) {
                        		echo "<li><a href='.?action=getProductCategory&amp;catId=$item[0]'>".$item[1]."</a></li>"; //need to set the href to pull the right view based on the category
                    		}
                            ?>
                    		<li><a href='.'>All</a></li>
                        </ul>
                        </li>
                        <?php if($_SESSION['loggedin'] == true && $_SESSION['rights'] > 1): ?>
                        <li class="page-sub-menu"><a href=".?action=addProductForm">Add New Product</a>
                            <ul>
                                <li><?php echo $addProductForm[0] ?></li>
                            </ul>
                        </li>
                        <?php endif ?>
                    </ul>
                    <div class="page-contents-under">&nbsp;</div>  <!--**** this should be a menu for any sub-categories-->
                    <?php
                    include $_SERVER['DOCUMENT_ROOT'].'/modules/cat-menu.php';
                    if($action == 'addProductForm') { //display the addProductForm<?php
                        if(isset($message)) {
                            echo '<div class="cntrl-message">'.$message.'</div>';
                        }
                        unset($message);
                        echo $addProductForm[0];
                    } else if(!empty($product) && $action == 'getProduct') {
                        if(isset($message)) {
                            echo '<div class="cntrl-message">'.$message.'</div>';
                        }
                        unset($message);
                    ?>
                        <a class="back-anchor" href=".">&lt;&lt;Back</a>
                        <div class="product">
        					<img class="left" src="<?php echo $product[0][productThumb] ?>" alt="thumbnail image">
							<p class="product-info left">
								<!--ID: <?php echo $product[0][productID] ?><br>-->
								<span class="product-name"><?php echo $product[0][productName] ?></span><br>
								<span class="product-price">$<?php echo $product[0][productPrice] ?></span><br>
								<span class="product-qty">QTY: <?php echo $product[0][productStock] ?></span>
							</p>
                            <p class="product-long-desc left">
                                <?php echo $product[0][productLongDesc] ?>
                            </p>
                            <p class="clear"></p>
                        </div>
                    <?php } else { //get the default view
                        if(isset($message)) {
                            echo '<div class="cntrl-message">'.$message.'</div>';
                        }
                        unset($message);
                        //check to see if there are any products to display
                        if(count($products) > 0) {
                            foreach($products as $product):
                    ?>
                            <div class="product-preview left">
                                <a href="<?php echo '.?action=getProduct&amp;productId='.$product[productID]; ?>">
                                <img class="product-thumb left" src="<?php echo $product[productThumb] ?>" alt="thumbnail image">
            					<p class="product-info left">
    								<span class="product-name"><?php echo $product[productName] ?></span><br>
    								<span class="product-price">$<?php echo $product[productPrice] ?></span><br>
    							</p>
                                <p class="product-short-desc clear">
                                    <?php echo $product[productShortDesc] ?>
                                </p>
                                <p class="clear"></p>
                                </a>
                            </div>
                            <?php endforeach; ?>
                            <p class="clear"></p>
                    <?php
                        }
                    }
                    ?>
                </section>
            </section>
            <footer id="footer">
                <?php include $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php'; ?>
            </footer>
    	
		</section>
	</body>
</html>