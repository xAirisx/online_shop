<?php include 'includes/session.php'; ?>
<?php
	$conn = $pdo->open();

	$slug = $_GET['product'];

	try{
		 		
	    $stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id WHERE products.slug = :slug");
	    $stmt->execute(['slug' => $slug]);
	    $product = $stmt->fetch();
		
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	//page view
	$now = date('Y-m-d');
	if($product['date_view'] == $now){
		$stmt = $conn->prepare("UPDATE products SET views_today=views_today+1 WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid']]);
	}
	else{
		$stmt = $conn->prepare("UPDATE products SET views_today=1, date_view=:now WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid'], 'now'=>$now]);
	}

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition">

<?php include 'includes/navbar.php'; ?>

    <div class="container-fluid">

	        <div class="row justify-content-md-center">
	        	<div class="col-sm-6 mt-4">
	        		<div class="callout" id="callout" style="display:none">
	        			<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
	        			<span class="message"></span>
	        		</div>
		            <div class="row">
		            	<div class="col-md-6">
		            		<img src="<?php echo (!empty($product['photo'])) ? 'images/'.$product['photo'] : 'images/noimage.jpg'; ?>" width="100%">
		            	</div>
		            	<div class="col-md-6">
		            		<h1 class="page-header"><?php echo $product['prodname']; ?></h1>
		            		<h3><b>&#36; <?php echo number_format($product['price']); ?></b></h3>
		            		<p><b>Category:</b> <a href="category.php?category=<?php echo $product['slug']; ?>"><?php echo $product['catname']; ?></a></p>
		            		<p><b>Description:</b></p>
		            		<p><?php echo $product['description']; ?></p>
		            	</div>
		            </div>
		            <div class="row mt-4">
		            <form class="form-inline" id="productForm">
                        <div class="form-group">
                        <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group mr-2" role="group">
                            <button type="button" id="minus" class="btn btn-light"><i class="fa fa-minus"></i></button>
                            <input type="text" name="quantity" id="quantity" class="form-control" value="1">
                            <button type="button" id="add" class="btn btn-light"><i class="fa fa-plus"></i></button>
                            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
                            </div>
                            </div>
                            </div>
                        <button type="submit" class="btn btn-lg btn-info"><i class="fa fa-shopping-cart"></i> В корзину</button>
			            		
                    </form>
		            </div>
	        	</div>
	        
	        		<?php include 'includes/sidebar.php'; ?>
	        	
	        </div>
	      
    </div>
<?php $pdo->close(); ?>
<?php include 'includes/footer.php'; ?>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$('#add').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		quantity++;
		$('#quantity').val(quantity);
	});
	$('#minus').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		if(quantity > 1){
			quantity--;
		}
		$('#quantity').val(quantity);
	});

});
</script>
</body>
</html>
