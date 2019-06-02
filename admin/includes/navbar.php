
<header class="main-header">
  <nav class="navbar navbar-light navbar-expand-md bg-warning justify-content-between" >
     <a href="home.php" class="navbar-brand"><i class="fa fa-ravelry" aria-hidden="true"></i>
        <b>SportOnline</b></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
     </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <li class="nav-item" ><a class="nav-link" href="home.php">Статистика</a></li>
        <li class="nav-item" ><a class="nav-link" href="sales.php">Продажи</a></li>
        <li class="nav-item" ><a class="nav-link" href="users.php">Пользователи</a></li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Товары
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="products.php">Список товаров</a>
          <a class="dropdown-item" href="category.php">Список категорий</a>
        </div>
      </li>
       </ul>
       <ul class="navbar-nav ml-auto ">
       <li  class="nav-item mt-3" ><b style="font-size: 15px"> <?php echo $admin['firstname'].' '.$admin['lastname']; ?></b></li>
        <li  class="nav-item ml-2" ><a style="font-size: 35px" href="#profile" data-toggle="modal" title="Профиль" class="nav-item text-dark" id="admin_profile"><i class="fa fa-user" aria-hidden="true"></i></a></li>       
        <li  class="nav-item ml-3 mt-1" ><a style="font-size: 30px" href="../logout.php" title="Выход" class="nav-item ml-1 text-dark"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i></a></li>         
      
        </ul>
 
    </div>
  </nav>
</header>
<?php include 'includes/profile_modal.php'; ?>
