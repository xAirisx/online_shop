
<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM category WHERE name=:name");
		$stmt->execute(['name'=>$name]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Такая категория уже существует';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO category (name, slug) VALUES (:name, :slug)");
				$stmt->execute(['name'=>$name, 'slug'=>slugify($name)]);
				$_SESSION['success'] = ' Категория успешно добавлена ';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Сначала заполните форму';
	}

	header('location: category.php');

?>
