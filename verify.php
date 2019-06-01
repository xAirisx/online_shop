<?php
	include 'includes/session.php';
	$conn = $pdo->open();

	if(!empty($_POST['login'])){
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		try{

			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email = :email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				if($row['status']){
					if(password_verify($password, $row['password'])){
						if($row['type']){
							$_SESSION['admin'] = $row['id'];
						}
						else{
							$_SESSION['user'] = $row['id'];
						}
					}
					else{
						$_SESSION['error'] = 'Неправильный пароль';
					}
				}
				else{
					
				}
			}
			else{
				$_SESSION['error'] = 'Email не найден';
			}
		}
		catch(PDOException $e){
			echo "Проблемы с подключение к базе данных: " . $e->getMessage();
		}

	}
	else{
		$_SESSION['error'] = 'Сначала заполните форму';
	}

	$pdo->close();

	header('location: login.php');

?>
