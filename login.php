<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition ">

<div class="container ">

<div class="row align-items-center align-items-center justify-content-center py-4">
    <div class="card card-block col-md-5">
    <div class="card-body">
    	<div class="card-title h5 text-center">С возвращением!</div>
    	<?php
            if(isset($_SESSION['error'])){
                echo "
                <div class='alert alert-danger' role='alert'>
                    <div>".$_SESSION['error']."</div> 
                </div>
                ";
                unset($_SESSION['error']);
            }
            if(isset($_SESSION['success'])){
                echo "
                <div class='alert alert-success' role='alert'>
                    <div>".$_SESSION['success']."</div> 
                </div>
                ";
                unset($_SESSION['success']);
            }
            ?>
    	<form class="card-text" action="verify.php" method="POST">

            <div class="form-group">
        		<input type="email" class="form-control" name="email" placeholder="Email" required>
      		</div>
      		
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Пароль" required>
            </div>

          	<button type="submit" class="btn btn-block btn-warning" name="login" value="true">Войти</button>
    	</form>
      <br>
      <a href="signup.php" class="text-center">Зарегестрироваться</a><br>
      <a href="index.php"><i class="fa fa-home"></i> На главную</a>
      </div>
  	</div>
</div>

<?php include 'includes/scripts.php' ?>
</body>
</html>

