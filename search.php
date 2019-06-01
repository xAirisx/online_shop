<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body>

<?php include 'includes/navbar.php'; ?>
<div class="container-fluid">
<div class="row">
<div class="col-md-7 col-lg-6 mx-auto">
<div class="container">
	            <?php
	       			
	       			$conn = $pdo->open();

	       			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products WHERE name LIKE :keyword");
	       			$stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);
	       			$row = $stmt->fetch();
	       			if($row['numrows'] < 1){
	       				echo '<div class="h2 row mt-4"> Ничего не найдено для   <div class="font-weight-bold ml-2"><i>'.$_POST['keyword'].'</i></div></div>';
	       			}
	       			else{
	       				echo '<div class="h2 row mt-4  ">Результаты поиска для   <div class="font-weight-bold ml-2"><i >'.$_POST['keyword'].'</i></div></div><div class="row mt-4">';
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE :keyword");
						    $stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);
					 
						    foreach ($stmt as $row) {
						    	$highlighted = preg_filter('/' . preg_quote($_POST['keyword'], '/') . '/i', '<b>$0</b>', $row['name']);
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	
	       						echo "
	       							<div class='col-md-6 col-lg-4'>
	       								<div class='card '>
		       									<img class='card-img-top' src='".$image."' >
                                        <div class='card-body'>
		       								<h5><a href='product.php?product=".$row['slug']."'>".$highlighted."</a></h5>
		       									<b>".number_format($row['price'])." руб.</b>
		       								</div>
	       								</div>
	       							</div>
	       							
	       						";
	       						
						    }
						    
							
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}
					}

					$pdo->close();

	       		?> 
	        	</div>
	        	</div>
	        	</div>
	        	
	        		<?php include 'includes/sidebar.php'; ?>
	        	
	        </div>
	     
  


<?php include 'includes/scripts.php'; ?>
</body>
</html>
