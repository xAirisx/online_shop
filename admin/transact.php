<?php
	include 'includes/session.php';

	$id = $_POST['id'];

	$conn = $pdo->open();

	$output = array('list'=>'');

	$stmt = $conn->prepare("SELECT * FROM product_order LEFT JOIN product ON product.id=product_order.product_id LEFT JOIN order ON order.id=product_order.order_id WHERE product_order.order_id=:id");
	$stmt->execute(['id'=>$id]);

	$total = 0;
	foreach($stmt as $row){
		$output['transaction'] = $row['pay_id'];
		$output['date'] = date('M d, Y', strtotime($row['date']));
		$subtotal = $row['price']*$row['quantity'];
		$total += $subtotal;
		$output['list'] .= "
			<tr class='prepend_items'>
				<td>".$row['name']."</td>
				<td>&#36; ".number_format($row['price'], 2)."</td>
				<td>".$row['quantity']."</td>
				<td>&#36; ".number_format($subtotal, 2)."</td>
			</tr>
		";
	}
	
	$output['total'] = '<b>&#36; '.number_format($total, 2).'<b>';
	$pdo->close();
	echo json_encode($output);

?>