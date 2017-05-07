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
    <script type="text/javascript" src="js/printThis.js"></script>
</head>
<body>

<?php
include 'header.php';
?>

<div class="container-fluid staff_panel_ind c_container">
  <div class="alpha_inside alpha_s_options alpha_report_panel">
      <div class="nav nav-pills nav-stacked report_options_side ">
        <h2>Reports</h2>
        <li><strong>Delivery</strong></li>
        <li class="c_report_view" report-type='d_enlist'><a href="#">Enlisted Product</a></li>
        <li class="c_report_view" report-type='d_dispatch'><a href="#">Dispatch Product</a></li>
        <li class="c_report_view" report-type='d_delivery'><a href="#">Delivery Product</a></li>
        <li class="c_report_view" report-type='d_failed'><a href="#">Failed Delivery</a></li>
        <li class="c_report_view" report-type='d_charge'><a href="#">Delivery Charges</a></li>

        <li><strong>Pickup</strong></li>
        <li class="c_report_view" report-type='r_request'><a href="#">Requested Pickup</a></li>
        <li class="c_report_view" report-type='r_out'><a href="#">Out For Pickup</a></li>
        <li class="c_report_view" report-type='r_received'><a href="#">Pickup Received</a></li>
        <li class="c_report_view" report-type='r_failed'><a href="#">Failed Pickup</a></li>
        <li class="c_report_view" report-type='r_charges'><a href="#">Pickup Charges</a></li>

      </div>

      <?php
        include 'main_menu.php';
      ?>
      <div class="staff_panel_headerr">
        <h2>Generating report became easy</h2>
        <h5></h5>
      </div>


      <div class="row" id="report_container">



          <div>

            <?php

             if(isset($_REQUEST['delivery_report']))
             {

              echo '<table class="table table-striped report-table" id="_report_table"> <tr> <td>S.No</td> <td>Id</td> <td>Product</td> <td>Customer</td> <td>Price</td> <td>Delivery Date</td> </tr>';
              /*$date = $_REQUEST['date'];
              $query = "SELECT * from `product` where `delivery_date` <= '$date' and `status` = 2 ";
              */
              $query = "SELECT * FROM `product` WHERE `status` = 2";
              $result = mysqli_query($conn,$query);
              if($result)
              {
                $sno = 1;
                while($rows = mysqli_fetch_assoc($result))
                {
                  echo "
                      <tr>
                        <td>".$sno."</td>
                        <td>".$rows['consignment__id']."</td>
                        <td>".$rows['product_name']."</td>
                        <td>".$rows['customer_name']."</td>
                        <td>".$rows['price']."</td>
                        <td>".$rows['delivery_date']."</td>
                      </tr>";
                $sno+=1;
                }
              }
              echo " </table>
              <button class='btn btn-success print-view'>Print</button>";
            }

             if(isset($_REQUEST['enlist_report']))
             {

              echo '<table class="table table-striped report-table" id="_report_table"> <tr> <td>S.No</td> <td>Id</td> <td>Product</td> <td>Customer</td> <td>Price</td> </tr>';

              $query = "SELECT * from `product` where `status` = 0 ";
              $result = mysqli_query($conn,$query);
              if($result)
              {
                $sno = 1;
                while($rows = mysqli_fetch_assoc($result))
                {
                  echo "
                      <tr>
                        <td>".$sno."</td>
                        <td>".$rows['consignment__id']."</td>
                        <td>".$rows['product_name']."</td>
                        <td>".$rows['customer_name']."</td>
                        <td>".$rows['price']."</td>
                      </tr>";
                $sno+=1;
                }
              }
              echo " </table>
              <button class='btn btn-success print-view'>Print</button>";
            }

            if(isset($_REQUEST['dispatch_report']))
             {

              echo '<table class="table table-striped report-table" id="_report_table"> <tr> <td>S.No</td> <td>Id</td> <td>Product</td> <td>Customer</td> <td>Price</td> <td>Delivery Date</td> </tr>';

              /*$date = $_REQUEST['date'];
              $query = "SELECT * from `product` where `dispatch_date` <= '$date' and `status` = 1";
              */
              $query = "SELECT * FROM `product` WHERE `status` = 1";
              $result = mysqli_query($conn,$query);
              if($result)
              {
                $sno = 1;
                while($rows = mysqli_fetch_assoc($result))
                {
                  echo "
                      <tr>
                        <td>".$sno."</td>
                        <td>".$rows['consignment__id']."</td>
                        <td>".$rows['product_name']."</td>
                        <td>".$rows['customer_name']."</td>
                        <td>".$rows['price']."</td>
                        <td>".$rows['dispatch_date']."</td>
                      </tr>";
                $sno+=1;
                }
              }
              echo " </table>
              <button class='btn btn-success print-view'>Print</button>";
            }

            if(isset($_REQUEST['cancel_report']))
             {
              echo '<table class="table table-striped report-table" id="_report_table"> <tr> <td>S.No</td> <td>Id</td> <td>Product</td> <td>Customer</td> <td>Price</td> <td>Status</td> </tr>';

              /*$date = $_REQUEST['date'];
              $query = "SELECT * from `product` where `delivery_date` <= '$date' ";
              */
              $query = "SELECT * FROM `product` WHERE `status` = 3";
              $result = mysqli_query($conn,$query);
              if($result)
              {
                $sno = 1;
                while($rows = mysqli_fetch_assoc($result))
                {
                  echo "
                      <tr>
                        <td>".$sno."</td>
                        <td>".$rows['consignment__id']."</td>
                        <td>".$rows['product_name']."</td>
                        <td>".$rows['customer_name']."</td>
                        <td>".$rows['price']."</td>
                        <td>FAILED</td>
                      </tr>";
                $sno+=1;
                }
              }
              echo " </table>
              <button class='btn btn-success print-view'>Print</button>";
            }

            if(isset($_REQUEST['charges_report']))
            {
               echo '<table class="table table-striped report-table" id="_report_table"> <tr> <td>S.No</td> <td>Id</td> <td>Product</td> <td>Customer</td> <td>Price</td> <td>Charge of Consignment</td> </tr>';
               $query = "SELECT * FROM `product`";
               $result = mysqli_query($conn,$query);
               if($result)
               {
                $sno = 1;
                while($rows = mysqli_fetch_assoc($result))
                {
                  echo "
                      <tr>
                        <td>".$sno."</td>
                        <td>".$rows['consignment__id']."</td>
                        <td>".$rows['product_name']."</td>
                        <td>".$rows['customer_name']."</td>
                        <td>".$rows['price']."</td>
                        <td>".$rows['charge_of_consignment']."</td>
                      </tr>";
                      $sno+=1;
                }
               }
            }

             if(isset($_REQUEST['r_request']))
             {

              echo '<table class="table table-striped report-table" id="_report_table"> <tr> <td>S.No</td> <td>Id</td> <td>Product</td> <td>Customer</td> <td>Price</td> </tr>';

              $query = "SELECT * from `product_return` where `status` = 20 ";
              $result = mysqli_query($conn,$query);
              if($result)
              {
                $sno = 1;
                while($rows = mysqli_fetch_assoc($result))
                {
                  echo "
                      <tr>
                        <td>".$sno."</td>
                        <td>".$rows['consignment_r__id']."</td>
                        <td>".$rows['product_name']."</td>
                        <td>".$rows['customer_name']."</td>
                        <td>".$rows['price']."</td>
                      </tr>";
                $sno+=1;
                }
              }
              echo " </table>
              <button class='btn btn-success print-view'>Print</button>";
            }

             if(isset($_REQUEST['r_out']))
             {

              echo '<table class="table table-striped report-table" id="_report_table"> <tr> <td>S.No</td> <td>Id</td> <td>Product</td> <td>Customer</td> <td>Price</td> </tr>';

              $query = "SELECT * from `product_return` where `status` = 21 ";
              $result = mysqli_query($conn,$query);
              if($result)
              {
                $sno = 1;
                while($rows = mysqli_fetch_assoc($result))
                {
                  echo "
                      <tr>
                        <td>".$sno."</td>
                        <td>".$rows['consignment_r__id']."</td>
                        <td>".$rows['product_name']."</td>
                        <td>".$rows['customer_name']."</td>
                        <td>".$rows['price']."</td>
                      </tr>";
                $sno+=1;
                }
              }
              echo " </table>
              <button class='btn btn-success print-view'>Print</button>";
            }

             if(isset($_REQUEST['r_received']))
             {

              echo '<table class="table table-striped report-table" id="_report_table"> <tr> <td>S.No</td> <td>Id</td> <td>Product</td> <td>Customer</td> <td>Price</td> </tr>';

              $query = "SELECT * from `product_return` where `status` = 22 ";
              $result = mysqli_query($conn,$query);
              if($result)
              {
                $sno = 1;
                while($rows = mysqli_fetch_assoc($result))
                {
                  echo "
                      <tr>
                        <td>".$sno."</td>
                        <td>".$rows['consignment_r__id']."</td>
                        <td>".$rows['product_name']."</td>
                        <td>".$rows['customer_name']."</td>
                        <td>".$rows['price']."</td>
                      </tr>";
                $sno+=1;
                }
              }
              echo " </table>
              <button class='btn btn-success print-view'>Print</button>";
            }

             if(isset($_REQUEST['r_failed']))
             {

              echo '<table class="table table-striped report-table" id="_report_table"> <tr> <td>S.No</td> <td>Id</td> <td>Product</td> <td>Customer</td> <td>Price</td> </tr>';

              $query = "SELECT * from `product_return` where `status` = 23 ";
              $result = mysqli_query($conn,$query);
              if($result)
              {
                $sno = 1;
                while($rows = mysqli_fetch_assoc($result))
                {
                  echo "
                      <tr>
                        <td>".$sno."</td>
                        <td>".$rows['consignment_r__id']."</td>
                        <td>".$rows['product_name']."</td>
                        <td>".$rows['customer_name']."</td>
                        <td>".$rows['price']."</td>
                      </tr>";
                $sno+=1;
                }
              }
              echo " </table>
              <button class='btn btn-success print-view'>Print</button>";
            }

             if(isset($_REQUEST['r_charges']))
             {

              $query = "SELECT * from `product_return` ";
              $result = mysqli_query($conn,$query);
              if($result)
              {
                 echo '<table class="table table-striped report-table" id="_report_table"> <tr> <td>S.No</td> <td>Id</td> <td>Product</td> <td>Customer</td> <td>Price</td> <td>Charge of Consignment</td> </tr>';
                 $query = "SELECT * FROM `product_return`";
                 $result = mysqli_query($conn,$query);
                 if($result)
                 {
                    $sno = 1;
                    while($rows = mysqli_fetch_assoc($result))
                    {
                      echo "
                          <tr>
                            <td>".$sno."</td>
                            <td>".$rows['consignment_r__id']."</td>
                            <td>".$rows['product_name']."</td>
                            <td>".$rows['customer_name']."</td>
                            <td>".$rows['price']."</td>
                            <td>".$rows['charge_of_consignment']."</td>
                          </tr>";
                          $sno+=1;
                    }
                  }
                }


              }

            ?>


        </div>

      </div>
  </div>
</div>


</body>
</html>
