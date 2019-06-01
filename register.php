<?php include 'includes/session.php'; ?>
<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

    
	if (isset($_POST['signup'])) {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];

		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;

		
		if($password != $repassword){
			$_SESSION['error'] = 'Пароли не совпадают!';
			header('location: signup.php');
		}
		else{
			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'Email уже занят!';
				header('location: signup.php');
			}
			
			else{
				$now = date('Y-m-d');
				$password = password_hash($password, PASSWORD_DEFAULT);

                
				try{
						$stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, created_on, address, status) VALUES (:email, :password, :firstname, :lastname, :now, :address, :status)");
                        $stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'now'=>$now, 'address'=>"", 'status'=>1]);
                        $_SESSION['success'] = ' Пользователь успешно добавлен ';
                         header('location: index.php');
                }
                catch(PDOException $e) {
                     $output .= '
                            <div class="alert alert-danger">
                                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                                '.$e->getMessage().'
                            </div>
                            
                            header("location: index.php");
                        ';
                }
            }
    
        }
	}
	else{
		$_SESSION['error'] = 'Сначала заполниет форму!';
		header('location: signup.php');
	}
	
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php echo $output; ?>
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
