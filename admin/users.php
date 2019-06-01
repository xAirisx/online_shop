<?php include 'includes/session.php'; ?>
<?php include '../includes/header.php'; ?>
<body class="hold-transition">
 <?php include 'includes/navbar.php'; ?>

<div class="container">
<div class="row mt-2">
<div class="col-md-12">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
             
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
             
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      </div>
</div>
<div class="row mt-4 ">
<div class="h2 col-lg-3  col-md-5 font-weight-bold ">Пользователи </div> 
<div class="col-md-3 ml-3 mt-1">  <a  href= "#add" data-target="#add" data-toggle="modal" class="btn btn-outline-success btn-block"><i class="fa fa-plus"></i> Добавить</a></div>
</div>
<div class="row mt-4">

              <table id="example1" class="table ">
                <thead>
                  <th  scope="col">Фото</th>
                  <th  scope="col">Email</th>
                  <th  scope="col">Имя </th>
                  <th  scope="col">Дата регистрации</th>
                  <th  scope="col" colspan="3" class="ml-4">Инструменты</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT * FROM users WHERE type=:type");
                      $stmt->execute(['type'=>0]);
                      foreach($stmt as $row){
                        $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                        echo "
                          <tr >
                            <th  scope='row ' class='font-weight-light'>
                              <img src='".$image."' height='30px' width='30px'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='".$row['id']."'><i class='fa fa-edit'></i></a></span>
                            </th>
                            <th class='font-weight-light'>".$row['email']."</th>
                            <th class='font-weight-light'>".$row['firstname'].' '.$row['lastname']."</th>
                            <th class='font-weight-light'>".date('M d, Y', strtotime($row['created_on']))."</th>
                            <th class='font-weight-light'>
                            <button class='col-md-10 mb-2 col-lg-5 btn btn-outline-info edit ml-4' data-id='".$row['id']."' data-toggle='modal' data-target='#edit'><i class='fa fa-edit'></i> Редактировать</button>
                              <button class='col-md-10 mb-2 col-lg-5 btn btn-outline-danger delete ml-4' data-id='".$row['id']."' data-toggle='modal' data-target='#delete'><i class='fa fa-trash'></i> Удалить</button>
                            </th>
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
       

<?php include 'includes/users_modal.php'; ?>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });


});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'users_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#edit_email').val(response.email);
      $('#edit_password').val(response.password);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#edit_contact').val(response.contact_info);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
