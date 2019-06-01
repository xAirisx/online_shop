<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition">

<?php include 'includes/navbar.php'; ?>
<div class="container-fluid">
<div class="row mt-2">
<div class="col-lg-12 col-md-12">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
             
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
             
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      </div>
</div>
	 <div class="row">
    <div class="col-md-7 mx-auto mt-2">
	 <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner " >
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="images/banner1.png" alt="First slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="images/banner2.png" alt="Second slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
        </div>
         <div class="container">
	    <div class="h2 row mt-4 font-weight-bold ">Лучшие товары месяца</div>
             <div class="row align-items-start mt-4">
		       		<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	
						    $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	
	       						
	       						echo "
	       						<div class='col-md-4' >
	       								<div class='card '>
										  <img class='card-img-top'   src='".$image."' alt='Card image cap'>
										  <div class='card-body'>
										    <h5 class='card-title text-dark'> <a clas='text-dark' href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
                                            <b class='text-dark'>&#36;".number_format($row['price'])."</b>
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
