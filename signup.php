<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition">
<div class="container">
  <div class="row align-items-center align-items-center justify-content-center py-4">
    <div class="card card-block col-md-5">
    <div class="card-body">
      <div class="card-title h5 text-center">Регистрация</div>
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

    	<form class="card-text" action="register.php" method="POST">
          <div class="form-group ">
            <input type="text" class="form-control" name="firstname" placeholder="Имя " value="<?php echo (isset($_SESSION['firstname'])) ? $_SESSION['firstname'] : '' ?>"  minlength="2" required>
           
          </div>
          <div class="form-group ">
            <input type="text" class="form-control" name="lastname" placeholder="Фамилия " value="<?php echo (isset($_SESSION['lastname'])) ? $_SESSION['lastname'] : '' ?>" minlength="2" required>

          </div>
      		<div class="form-group ">
        		<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ?>" required>
      		</div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Пароль " minlength="5" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="repassword" placeholder="Повторите пароль" required>
          </div>
            <button type="submit" class="btn btn-block btn-warning text-white" name="signup" value="1"><i class="fa fa-pencil"></i> Зарегестрироваться</button>
      		</div>
            
            <div class="card-body">
            <a href="login.php"> Уже зарегестрированы?</a><br>
            <a href="index.php"><i class="fa fa-home"></i> На главную</a> 
            </div>
    	

  	</div>
</div>
</div>
</div>
<?php include 'includes/scripts.php' ?>
</body>
</html>
