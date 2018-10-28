<?php
	include 'includes/session.php';

	if(isset($_GET['pay'])){
		$payid = $_GET['pay'];
		$date = date('Y-m-d');

		$conn = $pdo->open();

		try{
			
			$stmt = $conn->prepare("INSERT INTO order (user_id, pay_id, date) VALUES (:user_id, :pay_id, :date)");
			$stmt->execute(['user_id'=>$user['id'], 'pay_id'=>$payid, 'date'=>$date]);
			$orderid = $conn->lastInsertId();
			
			try{
				$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN product ON product.id=cart.product_id WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				foreach($stmt as $row){
					$stmt = $conn->prepare("INSERT INTO details (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
					$stmt->execute(['order_id'=>$orderid, 'product_id'=>$row['product_id'], 'quantity'=>$row['quantity']]);
				}

				$stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				$_SESSION['success'] = 'Transaction successful. Thank you.';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	
	header('location: profile.php');
	
?>