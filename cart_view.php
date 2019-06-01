<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition">
	<?php include 'includes/navbar.php'; ?>
	    <div class="container-fluid">
	        <div class="row">
	        	<div class="col-md-7 mx-auto">
	        	  <div class="container">
                    <div class="h2 row mt-4 font-weight-bold ">Корзина</div>
                    <div class="row mt-2">
		        		<table class="table">
		        			<thead>
		        			<tr>
		        				<th></th>
		        				<th>Фотография </th>
		        				<th>Название</th>
		        				<th>Цена</th>
		        				<th width="20%">Количество</th>
		        				<th>Всего</th>
                            <tr>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
	        			</div>
	        		</div>
	        		<?php
	        			if(isset($_SESSION['user'])){
                                echo '
	        					<div class="col-md-4 col-lg-3">
                                <div id="pay-button" class="btn btn-outline-info btn-block">Оплатить</div>
                                </div>
	        				';
	        			}
	        			else{
	        				echo "
	        				<div class='col-md-3 col-lg-3'>
	        				<a href='login.php' class='btn btn-outline-info btn-block'>Оплатить</a>
                            </div>
	        					
	        				";
	        			}
	        		?>
	        	</div>
                <?php include 'includes/sidebar.php'; ?>
            </div>
        </div>
	    
	     
	    
<?php $pdo->close(); ?>

<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});
	
	$("#pay-button").click(function(e){
		window.location = 'sales.php?pay='+ new Date().getTime();
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>
</body>
</html>
