<header class="main-header">

  <nav class="navbar navbar-light  navbar-expand-sm bg-warning justify-content-between" >

     <a href="index.php" class="navbar-brand"><i class="fa fa-ravelry" aria-hidden="true"></i>
        <b>SportOnline</b></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
     </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">

       <li class="nav-item" ><a class="nav-link" href="index.php">HOME</a></li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CATEGORY</a>
           <div  class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <?php
                $conn = $pdo->open();
                try{
                  $stmt = $conn->prepare("SELECT * FROM category");
                  $stmt->execute();
                  foreach($stmt as $row){
                    echo "
                        <a class='dropdown-item' href='category.php?category=".$row['slug']."'>".$row['name']."</a>
                    ";                  
                  }
                }
                catch(PDOException $e){
                  echo "There is some problem in connection: " . $e->getMessage();
                }

                $pdo->close();

              ?>
              </div>
        </li>
        </ul>   
           </div>
            <form method="POST" action="search.php" class="form-inline ml-4 ">
              <div class="input-group " style="width: 500px">
                <input class="form-control " type="search" placeholder="Search" aria-label="Поиск">
               <div class="input-group-append">
                  <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search" aria-hidden="true"></i>
                </button>
               </div>
               </div>
            </form>
                    <a  style="font-size: 25px" class="nav-item ml-3 mb-1 text-dark" href="cart_view.php" >
                        <i class="fa fa-lg fa-shopping-cart" aria-hidden="true"></i>
                    </a>
                   <b> <div style="font-size: 20px" class="nav-item ml-1" > <span class="cart_count "></span>
</div></b>
        <div class="collapse navbar-collapse ml" id="navbarNav">
          <ul class="navbar-nav ml-auto">     
        
             <?php
            if(isset($_SESSION['user'])){
              echo '
              
              <div  class="nav-item ml-4 mt-3" ><b style="font-size: 15px"> '.$user['firstname'].' '.$user['lastname'].'</b></div>
              <div  class="nav-item ml" ><a style="font-size: 35px" href="profile.php" title="Профиль" class="nav-item ml-1 text-dark"><i class="fa fa-user" aria-hidden="true"></i></a></div>
             

                <div  class="nav-item ml-4 mt-1" ><a style="font-size: 30px" href="logout.php" title="Вход" class="nav-item ml-1 text-dark"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i></a></div>
                
              ';
            }
            else{
              echo "

                <b style='font-size: 18px' class='nav-item mt-3'><a class= 'text-dark ' >Войти</a></b>
              <a style='font-size: 35px' class='ml-2 text-dark nav-item' href='login.php' ><i class='fa fa-sign-in' aria-hidden='true'></i></a>
                
              ";
            }
          ?>
            
            </ul>
          
        </div>
  </nav>
   
</header>
