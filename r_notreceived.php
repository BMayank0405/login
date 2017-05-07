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
      include 'return_menu.php';

      ?>
      <div class="staff_panel_headerr">
        <h2>Lorel Ipsum heading</h2>
        <h5>ipsum dollar sit amet</h5>
      </div>
      <div class="col-lg-7 form_entry_col">
        <div class="add_entry_form">

          <div class="form_header">
            <div class="form_thumb">
              <img src="images/list.png">
            </div>
            <div class="form_title">
              <h3>Failed Pickups</h3>
            </div>
          </div>



          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
          <table class="table table-striped report-table" id="_report_table"> <tr> <td>S.No</td> <td>Id</td> <td>Customer</td> <td>Address</td> <td>Price</td> <td>Not Received  <input type="checkbox" name="select_all" id="select_all"></td> </tr>
          <?php
             $query = "SELECT * FROM `return_product` WHERE `status` = 21";
             $result = $db->query($query);
             if(mysqli_num_rows($result) > 0)
             {
              $counter = 1;
              while($rows = mysqli_fetch_assoc($result))
              {
                echo '<tr><td>'.$counter.'</td> <td>'.$rows['client_order_id'].'</td> <td>'.$rows['customer_name'].'</td> <td>'.$rows['customer_address'].'</td> <td>'.$rows['cod_amount'].'</td> <td><input type="checkbox" name="r_id[]" value="'.$rows['r_id'].'"></td></tr>';
                $counter+=1;
              }
                            echo "</table><input type='submit' name='r_notreceived' value='Failed Pickups'>";
             }

            ?>
            </form>


          <?php
            if(isset($_REQUEST['r_notreceived']))
            {
              $r_id = $_REQUEST['r_id'];
              $today = date("Y-m-d");
              foreach($r_id as $val)
              {
                $query = "UPDATE `return_product` SET `status` = 23 WHERE `r_id` = $val";
                $result = $db->query($query);
              }
              if($result)
              {
                echo "<div class='btn btn-success'>Not Received</div>";
              }
              else
              {
                echo "<div class='btn btn-danger>Error</div>'";
              }
            }
          ?>


        </div>
      </div>



  </div>


</div>




</body>
</html>
