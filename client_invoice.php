<?php
session_start();
require_once './functions/init.php';
require_once './functions/function.php';
  protect_page();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Invoice  || Evencargo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" media="all" href="css/generic.css">
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
              <img src="images/invoice.png">
            </div>
            <div class="form_title">
              <h3>Client Invoice</h3>
            </div>
          </div>


        <form class="datewform" style="width:75%; margin:0px auto;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

             <input type="date" name="from" placeholder="from Date" required>
             <input type="date" name="to" placeholder="to Date" required>
            <input type="submit" name="client_invoice" value="Download Report">
          </form>



                <?php
                      if(isset($_REQUEST['client_invoice']))
                      {
                        $from_date = $_REQUEST['from'];
                        $to_date = $_REQUEST['to'];

                         $query = "SELECT * FROM `customer` where `status` = 2 AND `delivery_date` >= '$from_date' AND `delivery_date` <= '$to_date'";

                         $result = $db->query($query);
                         if(mysqli_num_rows($result) > 0)
                         {

                          $today = date("d-m-Y");

                          echo '<div class="invoice_container"><div id="cancel-invoice">X</div> <div class="invoice_box" id="client_invoice"> <br/><div class="invoice_header" style="padding-bottom:20px"> <div class="in_head_left"> <div class="invoice_logo"><img src="images/logo.png"></div><br/><div style="text-align:left" padding-bottom><b style="font-size: 24px;">Even Cargo</b><br/>Even Innovations<br />C-109, Flat no 2, ground floor, Paryavaran Complex,<br />Saket, New Delhi, India, 110030<br />Phone +91-9810843332<br/></div></div><div class="in_head_right"><br/><br/><br/><br/><h2>INVOICE</h2> DATE : '.$today.' <br/>Sales Tax No. :beapk6939ksd002<br/>Mail: contact@evencargo.in </div></div> <div class="invoice_body"><table class="table table-bordered" id="inv_table"> <thead> <tr><th>Delivery_date</th> <th>Product ID / Consignment ID</th><th>Applicable Weight(gms)</th> <th>Weight Charges</th> <th>Fuel Surcharge</th><th>COD Applicable</th> <th>Total Amount</th></tr> </thead> <tbody>';
                          $counter = 1;
                          while($rows = mysqli_fetch_assoc($result))
                          {
                            $delivery_date = $rows['delivery_date'];
                            $client_order_id = $rows['client_order_id'];
                            $awb_number = $rows['awb_number'];
                            $weight = $rows['weight'];
                            $charge_of_consignment = $rows['charge_of_consignment'];
                            $cod_charges = $rows['cod_amount'];
                            $surcharge = $rows['sur_charge'];
                            $weightCharge = $rows['wt_charge'];
                            echo " <tr> <td>".$delivery_date."</td> <td>".$client_order_id."/". $awb_number." </td> <td>".$weight."</td><td>".$weightCharge."</td> <td>".$surcharge."</td><td>".$cod_charges."</td><td id='invoice_amount".$counter."'>"  .$charge_of_consignment."</td> </tr>";
                            $counter+=1;

                          }

                          echo "<tr><td></td><td></td><td></td><td></td><td></td><td>SUB TOTAL</td> <td id='invoice_total'></td></tr>";
                          echo '</tbody> </table> </div> <div class="invoice_footer"> <div> <p>Make all cheques payable to Even Innovations <br />If you have any questions concerning this invoie <br />Contact: Yogesh Kumar<br />+91-9810843332<br />contact@evencargo.in<br /> </div> <h5 style="font-weight:bold;text-align:center;">THANK YOU FOR YOUR BUSINESS !</h5> <button class="btn btn-success"><a href="download_invoice.php?from='.$from_date.'&to='.$to_date.'&client_invoice=ok">Print Invoice</a></button> </div> </div> </div>';


                          echo "<script> var length = document.getElementById('inv_table').rows.length; var price=[]; var total =0; for(var i=1;i<length-1;i++) { var target = 'invoice_amount'+i; price.push(document.getElementById(target).innerHTML); }

                            for(var i = 0; i < price.length;i++) { total= total + parseFloat(price[i]); console.log(price[i] + ' '+ i);}
                            document.getElementById('invoice_total').innerHTML = total;
                          </script>";
                         }

                      }
                    ?>

                  </div>

      </div>


  </div>
</div>

</body>
</html>
