<?php include 'includes/session.php'; ?>
<?php
  $where = '';
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'WHERE category_id ='.$catid;
  }
?>
<?php include '../includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<body>
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
<div class="h2 col-lg-3  col-md-5 font-weight-bold ">Список товаров </div> 
  
<div class="col-md-3 ml-1 mt-1">
<label  class="input-group-text bg-info text-white font-weight-bold" for="select_category">Категория</label>
<select class="custom-select" id="select_category">
 <option value="0">Все</option>
                      <?php
                        $conn = $pdo->open();

                        $stmt = $conn->prepare("SELECT * FROM category");
                        $stmt->execute();

                        foreach($stmt as $crow){
                          $selected = ($crow['id'] == $catid) ? 'selected' : ''; 
                          echo "
                            <option value='".$crow['id']."' ".$selected.">".$crow['name']."</option>
                          ";
                        }

                        $pdo->close();
                      ?>
                    </select>
                  </div>
 <div class="col-md-3 ml-2 mt-1">  <button type="button" data-target="#addnew" data-toggle="modal" id="addproduct" class="btn btn-outline-success btn-block"><i class="fa fa-plus"></i> Добавить</button></div>             
 </div>

<div class="row mt-4">
<table class="table">
    <thead>
    <th scope="col">Название</th>
    <th scope="col">Фотография </th>
    <th scope="col" >Описание</th>
    <th scope="col">Цена</th>
    <th scope="col" colspan="2" >Инструменты</th>
    </thead> 
    <tbody>
        <?php
            $conn = $pdo->open();

            try{
            $now = date('Y-m-d');
            $stmt = $conn->prepare("SELECT * FROM products $where");
            $stmt->execute();
            foreach($stmt as $row){
            $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/noimage.jpg';
            echo "<tr>
                    <th>".$row['name']."</th>
                    <th>
                    <img src='".$image."' height='30px' width='30px'>
                    <span class='ml-2'><a href='#' data-target='#edit_photo' class='photo' data-toggle='modal' data-id='".$row['id']."'><i class='fa fa-edit'></i></a></span>
                    </th>
                    <th><button type='button' data-target='#description' data-toggle='modal' class='btn btn-block btn-outline-info  desc' data-id='".$row['id']."'><i class='fa fa-search'></i> Показать</a></th>
                    <th>".number_format($row['price'])." руб.</th>
                    <th>
                    <button type='button' data-toggle='modal' data-target='#edit' class='col-md-10 mb-2 col-lg-5 btn btn-outline-info edit ml-4' data-id='".$row['id']."'><i class='fa fa-edit'></i> Редактировать</button>
                    
                    <button type='button' data-toggle='modal' data-target='#delete' class='btn btn-outline-danger ml-4 col-md-10 mb-2 col-lg-5' data-id='".$row['id']."'><i class='fa fa-trash'></i> Удалить</button>
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
<?php include 'includes/products_modal.php'; ?>
<?php include 'includes/products_modal2.php'; ?>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });



  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.desc', function(e){
  e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $('#select_category').change(function(){
    var val = $(this).val();
    if(val == 0){
      window.location = 'products.php';
    }
    else{
      window.location = 'products.php?category='+val;
    }
  });

  $('#addproduct').click(function(e){
    e.preventDefault();
    getCategory();
  });

  $("#addnew").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

  $("#edit").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'products_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#desc').html(response.description);
      $('.name').html(response.prodname);
      $('.prodid').val(response.prodid);
      $('#edit_name').val(response.prodname);
      $('#catselected').val(response.category_id).html(response.catname);
      $('#edit_price').val(response.price);
      CKEDITOR.instances["editor2"].setData(response.description);
      getCategory();
    }
  });
}
function getCategory(){
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    success:function(response){
      $('#category').append(response);
      $('#edit_category').append(response);
    }
  });
}
</script>
</body>
</html>
