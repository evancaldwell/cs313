<?php

try {
    require $_SERVER['DOCUMENT_ROOT'].'/conn/connAdmin.php';
} catch(Exception $e){
    $message = "Sorry couldn't get your stuff, try again";
	$_SESSION['errorMessage'] = $message;
	header('location: /errors/'); //**** this should be a folder with error message view - don't have this yet
}

function getCategories() {
	// pull all the categories from the database
	// pull in the database from the controller
	global $db;
	
	try {
		$sql = 'SELECT * FROM productCategories ORDER BY categoryID DESC';
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$categories = $stmt->fetchAll();
		$stmt->closeCursor();
		return $categories;
	} catch(PDOException $e) {
		return 0;
	}
}

function getProducts($catId) {
	global $db;
	
    if($catId > 0) {
    	try {
            $sql = 'SELECT * FROM products WHERE productCategoryID = :catId ORDER BY productID DESC';
    		$stmt = $db->prepare($sql);
    		$stmt->bindValue(':catId', $catId);
    		$stmt->execute();
    		$productList = $stmt->fetchAll();
    		$stmt->closeCursor;
    		return $productList;
    	} catch(PDOException $e) {
    		return 0;
    	}
    } else {
    	try {
            $sql = 'SELECT * FROM products ORDER BY productID DESC';
    		$stmt = $db->prepare($sql);
    		$stmt->execute();
    		$productList = $stmt->fetchAll();
    		$stmt->closeCursor;
    		return $productList;
    	} catch(PDOException $e) {
    		return 0;
    	}
    }
}
function getProduct($prodId) {
    global $db;
    
    try {
        $sql = 'SELECT * FROM products WHERE productID = :prodId';
        	$stmt = $db->prepare($sql);
    		$stmt->bindValue(':prodId', $prodId);
    		$stmt->execute();
    		$product = $stmt->fetchAll();
    		$stmt->closeCursor;
    		return $product;
    	} catch(PDOException $e) {
    		return 0;
    	}
}

function addUpdateProduct($product, $action) {
    // pull in the database from the controller
    global $db;
	
	try {
		// the sql query ready to be turned into a prepared statement using the values
        if($action == 'addProduct') {
            $sql = "INSERT INTO products
                        (productSKU, productName, productPrice, productWeight, productCartDesc, productShortDesc, productLongDesc, productThumb, 
                        productImage, productCategoryID, productFeatured, productNew, productStock, productLive, productUnlimited, productLocation)
                    VALUES
                        (:sku, :name, :price, :weight, :cartdesc, :shortdesc, :longdesc, :thumb, 
                        :image, :categoryid, :featured, :isnew, :stock, :live, :unlimited, :location)";
        } elseif($action == 'updateProduct') {
            $sql = "UPDATE products SET
                        (productSKU, productName, productPrice, productWeight, productCartDesc, productShortDesc, productLongDesc, productThumb, 
                        productImage, productCategoryID, productFeatured, productNew, productStock, productLive, productUnlimited, productLocation)
                    VALUES
                        (:sku, :name, :price, :weight, :cartdesc, :shortdesc, :longdesc, :thumb, 
                        :image, :categoryid, :featured, :isnew, :stock, :live, :unlimited, :location)
                    WHERE productID = :prodId";
        }
                    
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':sku', $product[sku]);
        $stmt->bindValue(':name', $product[name]);
        $stmt->bindValue(':price', $product[price]);
        $stmt->bindValue(':weight', $product[weight]);
        $stmt->bindValue(':cartdesc', $product[cartDesc]);
        $stmt->bindValue(':shortdesc', $product[shortDesc]);
        $stmt->bindValue(':longdesc', $product[longDesc]);
        $stmt->bindValue(':thumb', $product[thumbPath]);
        $stmt->bindValue(':image', $product[imagePath]);
        $stmt->bindValue(':categoryid', $product[categoryId]);
        $stmt->bindValue(':featured', $product[featured]);
        $stmt->bindValue(':isnew', $product[isnew]);
        $stmt->bindValue(':stock', $product[stock]);
        $stmt->bindValue(':live', $product[live]);
        $stmt->bindValue(':unlimited', $product[unlimited]);
        $stmt->bindValue(':location', $product[location]);
        if($action == 'updateProduct') {
            $stmt->bindValue(':prodId', $product[id]);
            echo '<br>now in the stmt if<br>';
        }
        $stmt->execute();
        $id = $db->lastInsertId(); // get and return the last ID that was generated
        echo '<br>ID: '.$id;
        $stmt->closeCursor();
        return $id;
	} catch(PDOException $e) {
		return 0;
	}
}