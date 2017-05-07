<?php
session_start();
require_once './functions/init.php';
require_once './functions/function.php';
  protect_page();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Client Report || Evencargo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="css/generic.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="js/generic.js"></script>
    <script type="text/javascript" src="js/printThis.js"></script>
</head>
<body>

<?php
include 'header.php';
?>

<div class="container-fluid staff_panel_ind c_container">
  <div class="alpha_inside alpha_s_options alpha_report_panel">


      <?php
        include 'main_menu.php';
      ?>
      <div class="staff_panel_headerr">
        <h2>Generating report became easy</h2>
        <h5>Lorel ipsum dollar sit amet</h5>
      </div>


      <div class="col-lg-8 form_entry_col">
        <div class="add_entry_form">

            <div class="form_header">
            <div class="form_thumb">
              <img src="images/excel.png">
            </div>
            <div class="form_title">
              <h3>Client Report</h3>
            </div>
          </div>
      <form class="datewform" style="width:75%; margin:0px auto;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <input type="date" name="from" placeholder="from Date" required>
        <input type="date" name="to" placeholder="to Date" required>
        <input type="submit" name="client_report" value="Generate Report">
      </form>

      <div class="c_report_result">
      <?php

        if(isset($_REQUEST['client_report']))
        {


         $from_date = $_REQUEST['from'];
         $to_date = $_REQUEST['to'];

          $file = "client_report/15clw1sUx0AmYk.csv";

          $handle = fopen($file, 'w');
          $lines = array();
          $query = "SELECT * FROM `customer` where `status` = 2 AND `delivery_date` >= '$from_date' AND `delivery_date` <= '$to_date'";
          $init_line = "customer_name,client_order_id,customer_address,c_city,c_state,cod_amount,origin_of_consignment,destination_of_consigment,
          delivery_type,weight,awb_number,charge_of_consignment";
          array_push($lines, $init_line);
          $result =  $db->query($query);
          if(mysqli_num_rows($result) > 0)
          {
            while($rows = mysqli_fetch_assoc($result))
            {
                $customer_name = $rows['customer_name'];
                $client= $rows['client_order_id'];
                $address = $rows['customer_address'];
                $cod = $rows['cod_amount'];
                $c_city = $rows['c_city'];
                $c_state = $rows['c_state'];
                $origin = $rows['origin_of_consignment'];
                $destination = $rows['destination_of_consigment'];
                $delivery_type = $rows['delivery_type'];

                $weight = $rows['weight'];
                $awb_number = $rows['awb_number'];
                $charge_of_consignment = $rows['charge_of_consignment'];
                $d_type;
                if($delivery_type==1)
                {
                  $d_type = "COD";
                }
                else{
                  $d_type = "PREPAID";
                }

                $tmp = $customer_name.','.$client.','.$address.','.$c_city.','.$c_state.','.$cod.','.$origin.','.$destination.
                ','.$d_type.','.$weight.','.$awb_number.','.$charge_of_consignment;
                array_push($lines, $tmp);

            }

            foreach ($lines as $line)
            {
                fputcsv($handle, explode(",",$line));
            }
            fclose($handle);

            echo "<a href='".$file."' class='btn btn-success' download>Download</a>";

          }
          else
          {
            echo "<div class='btn btn-warning'>No Data Available / Invalid Input</div>";
          }




        }

      ?>

      </div>

</div>
</div>
</div>
</div></body>
</body>

</html>
