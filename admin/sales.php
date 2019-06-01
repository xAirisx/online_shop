<?php include 'includes/session.php'; ?>
<?php include '../includes/header.php'; ?>
<body class="hold-transition">

<?php include 'includes/navbar.php'; ?>
 
<div class="container">

<div class="h2 row mt-4  col-md-12 font-weight-bold ">История продаж </div> 
<div class="row mt-4 ml-1">
    <form method="POST" class="form-inline" action="sales_print.php">
       <div class="input-group mb-3">
         <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
        </div>
            <input type="text" class="form-control col-md-10" id="reservation" name="date_range">
       </div>
        <button  type="submit" class="btn btn-outline-success mb-3 ml-4" name="print">Печать</button>
       </form>
 </div>

 <div class="row mt-4">          
              <table class="table">
                <thead>
                  <th >Дата</th>
                  <th >Имя покупателя</th>
                  <th >Номер заказа</th>
                  <th >Количество</th>
                  <th >Все детали</th>
                  
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT *, sales.id AS salesid FROM sales LEFT JOIN users ON users.id=sales.user_id ORDER BY sales_date DESC");
                      $stmt->execute();
                      foreach($stmt as $row){
                        $stmt = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE details.sales_id=:id");
                        $stmt->execute(['id'=>$row['salesid']]);
                        $total = 0;
                        foreach($stmt as $details){
                          $subtotal = $details['price']*$details['quantity'];
                          $total += $subtotal;
                        }
                        echo "
                          <tr>
                            <td>".date('M d, Y', strtotime($row['sales_date']))."</td>
                            <td>".$row['firstname'].' '.$row['lastname']."</td>
                            <td>".$row['pay_id']."</td>
                            <td>".number_format($total)." руб.</td>
                            <td><button type='button' data-toggle='modal' data-target='#transaction' class='col-lg-7 btn btn-outline-info btn-sm transact btn-block' data-id='".$row['salesid']."'><i class='fa fa-search'></i> View</button></td>
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

<?php include '../includes/profile_modal.php'; ?>

<?php include 'includes/scripts.php'; ?>
<!-- Date Picker -->
<script>
$(function(){
  //Date picker
  $('#datepicker_add').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker_edit').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })


  //Date range picker
  $('#reservation').daterangepicker()

  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )
  
});
</script>
<script>
$(function(){
  $(document).on('click', '.transact', function(e){
    e.preventDefault();
    $('#transaction').modal('show');
    var id = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: 'transact.php',
      data: {id:id},
      dataType: 'json',
      success:function(response){
        $('#date').html(response.date);
        $('#transid').html(response.transaction);
        $('#detail').prepend(response.list);
        $('#total').html(response.total);
      }
    });
  });

  $("#transaction").on("hidden.bs.modal", function () {
      $('.prepend_items').remove();
  });
});
</script>
</body>
</html>
