<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['user'])){
		header('location: index.php');
	}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition">
<?php include 'includes/navbar.php'; ?>
	 
<div class="container-fluid">
        <div class="row ">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='callout callout-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}

	        			if(isset($_SESSION['success'])){
	        				echo "
	        					<div class='callout callout-success'>
	        						".$_SESSION['success']."
	        					</div>
	        				";
	        				unset($_SESSION['success']);
	        			}
	        		?>
	        		</div>
            </div>
        <div class="row justify-content-md-center">
            <div class="col-sm-1" style='font-size: 100px'><i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <div class="col-sm-6 mt-3">
            <div class="row mt-4 ml-2">
            <div class="col-sm-7 col-md-4 mr-2">
            	<h4>Имя:</h4>
	        	<h4>Email:</h4>
	        	<h4>Контакты:</h4>
	        	<h4>Адресс:</h4>
	        	<h4>Дата регистрации:</h4>
            </div>
            <div class="col-sm-4 col-md-5">
	        	<h4><?php echo $user['firstname'].' '.$user['lastname']; ?></h4>
	        	<h4><?php echo $user['email']; ?></h4>
	        	<h4><?php echo (!empty($user['contact_info'])) ? $user['contact_info'] : 'N/a'; ?></h4>
	        	<h4><?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?></h4>
	        	<h4><?php echo date('M d, Y', strtotime($user['created_on'])); ?></h4>
	       </div>
            </div>
            <div class="row mt-2 ml-2">
            <div class="col-lg-4 col-md-6  mt-2">
            <a href="#edit" class="btn btn btn-info btn-block" data-toggle="modal"><i class="fa fa-edit"></i> Редактировать</a>
            </div>
            </div>
	     
	    </div>
	  </div>
        <div clas="row justify-content-md-center">
        <h4 ><i class="fa fa-calendar"></i> <b>История заказов</b></h4>
        <table class="table mt-4">
  <thead>
    <tr>
      <th class="hidden"></th>
      <th>Дата</th>
      <th>Номер заказа</th>
      <th>Количество</th>
      <th>Детали</th>
    </tr>
  </thead>
  <tbody>
    <?php
	     $conn = $pdo->open();

	       try{
	        $stmt = $conn->prepare("SELECT * FROM sales WHERE user_id=:user_id ORDER BY sales_date DESC");
	        $stmt->execute(['user_id'=>$user['id']]);
	        foreach($stmt as $row){
	        	$stmt2 = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE sales_id=:id");
	        	$stmt2->execute(['id'=>$row['id']]);
	        	$total = 0;
	        	foreach($stmt2 as $row2){
	        		$subtotal = $row2['price']*$row2['quantity'];
	        		$total += $subtotal;
	        		}
	        		echo "
	        			<tr>
	        				<td class='hidden'></td>
	        				<td>".date('M d, Y', strtotime($row['sales_date']))."</td>
	        				<td>".$row['pay_id']."</td>
	        				<td>&#36; ".number_format($total)."</td>
	        				<td><button  data-toggle='modal' data-target='#transaction' class='btn btn-sm btn-info transact' data-id='".$row['id']."'><i class='fa fa-search'></i> Показать</button></td>
                        </tr>
	        		";
	        		}

	        	}catch(PDOException $e){
					echo "There is some problem in connection: " . $e->getMessage();
				}

	        	$pdo->close();
	    ?>
  </tbody>
  </table>
        </div>
 </div>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/profile_modal.php';?>
<?php include 'includes/scripts.php'; ?>
<script>
  
$(function(){
	$(document).on('click', '.transact', function(e){
		e.preventDefault();
		$('#transaction').modal('show');
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'transaction.php',
			data: {id:id},
			dataType: 'json',
			success:function(response){
				$('#date').html(response.date);
				$('#transid').html(response.transaction);
				$('#detail').prepend(response.list);
				$('#total').html(response.total);
			}
		});
	});

	$("#transaction").on("hidden.bs.modal", function () {
	    $('.prepend_items').remove();
	});
});
</script>
</body>
</html>
