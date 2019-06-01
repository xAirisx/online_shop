<?php include 'includes/session.php'; ?>
<?php
	$slug = $_GET['category'];

	$conn = $pdo->open();

	try{
		$stmt = $conn->prepare("SELECT * FROM category WHERE slug = :slug");
		$stmt->execute(['slug' => $slug]);
		$cat = $stmt->fetch();
		$catid = $cat['id'];
	}
	catch(PDOException $e){
		echo "Проблемы с подключение к базе данных: " . $e->getMessage();
	}

	$pdo->close();

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition">
<?php include 'includes/navbar.php'; ?>
<div class="container-fluid">
<div class="row">
	<div class="col-md-7  col-lg-6 mx-auto">
        <div class="container">
            <div class="h2 row mt-4 font-weight-bold "><?php echo $cat['name']; ?></div>
            <div class="row mt-4">

		       		<?php
		       			$conn = $pdo->open();
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
						    $stmt->execute(['catid' => $catid]);
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	
	       						echo "
	       							<div class='col-md-6 col-lg-4'>
	       								<div class='card '>
										  <img class='card-img-top' src='".$image."' alt='Card image cap'>
										  <div class='card-body'>
										    <h5 class='card-title text-dark'> <a clas='text-dark' href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
                                            <b class='text-dark'>".number_format($row['price'])." руб.</b>
										  </div>
											
										</div>
                                    </div>
	       						";
						}
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
	        	</div>
	</div>
	</div>
	<?php include 'includes/sidebar.php'; ?>
</div>
</div>


<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
