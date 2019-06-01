<?php include 'includes/session.php'; ?>
<?php include '../includes/header.php'; ?>
<body>
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
<div class="row mt-4">
<div class="h2 col-lg-2  col-md-3 font-weight-bold ">Категории</div> 
<div class="col-md-3 ml-3 mt-1">  <a href="#add" data-toggle="modal" class="btn btn-outline-success btn-block"><i class="fa fa-plus"></i> Добавить</a></div>
</div>
<div class="row mt-4">
<table id="example1" class="table">
  <thead>
    <tr>
       <th>Название</th>
        <th colspan="2" class="ml-4">Инструменты</th>
        <th></th>
       </tr>
   </thead>
    <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT * FROM category");
                      $stmt->execute();
                      foreach($stmt as $row){
                        echo "
                          <tr>
                            <td>".$row['name']."</td>
                            <td>
                              <button class='col-md-5 col-lg-5 btn btn-outline-info edit ml-4' data-id='".$row['id']."' data-toggle='modal' data-target='#edit'><i class='fa fa-edit'></i> Редактировать</button>
                              <button class='col-md-5 col-lg-5 btn btn-outline-danger delete ml-4' data-id='".$row['id']."' data-toggle='modal' data-target='#delete'><i class='fa fa-trash'></i> Удалить</button>
                            </td>
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
 </div>
     
<?php include 'includes/category_modal.php'; ?>
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

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'category_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.catid').val(response.id);
      $('#edit_name').val(response.name);
      $('.catname').html(response.name);
    }
  });
}
</script>
</body>
</html>
