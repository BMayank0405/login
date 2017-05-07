<?php
session_start();
require_once './functions/init.php';
require_once './functions/function.php';
  protect_page();
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/generic.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/generic.js"></script>
</head>
<body>

<?php
include 'header.php';
?>
<div class="container-fluid staff_panel_ind c_container">


  <div class="alpha_inside">
      <?php
      include 'menu.php';

      ?>
      <div class="staff_panel_headerr">
        <h2></h2>
        <h5></h5>
      </div>
      <div class="col-lg-7 form_entry_col">
        <div class="add_entry_form">


          <?php


            if(isset($_REQUEST['failed_attempts']))
            {
              $id = $_REQUEST['id'];
              $today = date("Y-m-d H:i:s");


              foreach($id as $val)
              {
                  $query = "UPDATE `customer` SET `attempt_date` = '$today',`attempts` = attempts+1 WHERE `id` = $val";
                  $result = $db->query($query);
              }
              if($result)
              {
                echo "<div style='color:#fff;'><p> ";

                echo " \n Requested  products have been updated. \n Don't resubmit the form !</p></div>";
                echo "<div class='btn btn-success'>Attempted Delivery Failed</div>";
              }
              else
              {
                echo "<div class='btn btn-danger>Error</div>'";
              }
            }
          ?>



          <div class="form_header">
            <div class="form_thumb">
              <img src="images/list.png">
            </div>
            <div class="form_title">
              <h3>Attempted Delivery Products</h3>
            </div>
          </div>



          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
          <table class="table table-striped report-table" id="_report_table"><tr> <td>S.No</td> <td>Client_order_id</td><td>Customer</td> <td>Address</td>  <td>Price</td> <td>Not Delivered  <input type="checkbox" name="select_all" id="select_all"></td> </tr>
          <?php
             $query = "SELECT * FROM `customer` WHERE `status` = 1";
             $result = $db->query($query);
             if(mysqli_num_rows($result) > 0)
             {
              $counter = 1;
              while($rows = mysqli_fetch_assoc($result))
              {
                echo '<tr><td>'.$counter.'</td> <td>'.$rows['client_order_id'].'</td> <td>'.$rows['customer_name'].'</td> <td>'.$rows['customer_address'].'</td> <td>'.$rows['cod_amount'].'</td> <td><input type="checkbox" name="id[]" value="'.$rows['id'].'"></td></tr>';
                $counter+=1;
              }
                            echo "</table><input type='submit' name='failed_attempts' value='Failed Attempt'>";
             }

            ?>
            </form>




        </div>
      </div>



  </div>


</div>




</body>
</html>
