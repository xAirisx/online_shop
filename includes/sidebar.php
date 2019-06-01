<div class="col-md-4 col-lg-3 mt-4 mr-4">
<ul class="list-group">
<li class="list-group-item  list-group-item-info h3"><b>Рекомендуем вам</b></li>

	  		
	  		<?php
	  			$now = date('Y-m-d');
	  			$conn = $pdo->open();

	  			$stmt = $conn->prepare("SELECT * FROM products WHERE date_view=:now ORDER BY views_today DESC LIMIT 10");
	  			$stmt->execute(['now'=>$now]);
	  			foreach($stmt as $row){
	  				echo "<li class='list-group-item '><a class='text-dark' href='product.php?product=".$row['slug']."'>".$row['name']."</a></li>";
	  			}

	  			$pdo->close();
	  		?>
</ul>
</div>
