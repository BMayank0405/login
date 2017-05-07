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


			<div class="col-lg-7 col-md-offset-1 adparce">
				<div class="add_entry_form">

					<div class="form_header">
						<div class="form_thumb">
							<img src="images/list.png">
						</div>
						<div class="form_title">
							<h3>Pickup Request</h3>
						</div>
					</div>

					<form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" validate>
            <input type="text"  name="customer_name"    placeholder="Customer Name"    pattern="[a-zA-Z0-9\s]+" required autofocus >
						<input type="text"  name="client_order_id"  placeholder="Client Order ID"  pattern="[a-zA-Z0-9]+"   required >
						<input type="text"  name="awb_number"       placeholder="Awb Number"       pattern="[a-zA-Z0-9]+"   required >
						<input type="text"  name="pincode"          placeholder="Pincode"          pattern="[0-9]{6,8}"     required >
						<input type="tel"   name="customer_phone"   placeholder="Mobile Number"    pattern="[7-9]{1}[0-9]{9}" required title="Enter valid Mobile Number">
						<input type="text"  name="customer_address" placeholder="Customer Address" pattern="[a-zA-Z0-9_(\-)(\\/.#'`$%@:)(\s)]*[,]\s{0,}[a-zA-Z0-9_(\-)(\\/.#'`$%@:)(\s)[,\]]*" required>
						<input type="text"  name="customer_state"   placeholder="Customer state"   pattern="([a-zA-Z]{1,}\s){0,}[a-zA-Z]{1,}" required>
						<input type="text"  name="customer_city"    placeholder="Customer city"    pattern="([a-zA-Z]{1,}\s){0,}[a-zA-Z]{1,}" required>
						<input type="text"  name="cod"              placeholder="Cod Amount"       pattern="\d*" required>
            <input type="text"  name="weight"           placeholder="weight (in gm)"   pattern="\d*" title="Number only in gm" required>

            <select name="origin_consignment" required>
  						<option value="" disabled="disabled" selected="selected">Origin Of Consignment</option>
  						<?php
  							$query ="SELECT * FROM `city`";
  							$result = $db->query($query);
  							while($rows = mysqli_fetch_assoc($result))
  							{
  								echo "<option value='".$rows['city_id']."'>".$rows['city_name']."</option>";
  							}
  						?>
  					</select>
  					<select name="destination_consignment" required>
  						<option value="" disabled="disabled" selected="selected">Destination Of Consignment</option>
  						<?php
  							$query ="SELECT * FROM `city`";
  							$result = $db->query($query);
  							while($rows = mysqli_fetch_assoc($result))
  							{
  								echo "<option value='".$rows['city_id']."'>".$rows['city_name']."</option>";
  							}
  						?>
  					</select>
						<input type="submit" name="pickup_request" value="Pickup Request">
					</form>
					<?php

						if(isset($_POST['pickup_request']))
						{
              $customer_name = sanitize($_POST['customer_name']);
							$client = sanitize($_POST['client_order_id']);
							$awb_no = sanitize($_POST['awb_number']);
							$customer_address =sanitize($_POST['customer_address']);
							$customer_phone = sanitize($_POST['customer_phone']);
							$c_state = sanitize($_POST['customer_state']);
							$c_city = sanitize($_POST['customer_city']);
              $weight = sanitize($_POST['weight']);
							$cod_amount = sanitize($_POST['cod']);
							$status = 20; //inital state
							$pincode = sanitize($_POST['pincode']);
              $origin = sanitize($_POST['origin_consignment']);
              $destination = sanitize($_POST['destination_consignment']);

							$r_mode = 21;
              $charge_array = charges_calculate($weight,$cod_amount,$r_mode);
              $charge_of_consignment = $charge_array['totalcharge'];
              $codcharge = $charge_array['codcharge'];
              $surcharge = $charge_array['surcharge'];
              $weightcharge = $charge_array['weightcharge'];


							$query = "INSERT INTO return_product(r_id,client_order_id,awb_number,pincode,customer_name,customer_phone,customer_address,
                c_city,c_state,cod_amount,charge_of_consignment,origin_of_consignment,destination_of_consignment,weight,status,wt_charge,sur_charge)
                VALUES(null,'$client','$awb_no',$pincode,'$customer_name',$customer_phone,'$customer_address','$c_city','$c_state',
                  $cod_amount,$charge_of_consignment,$origin,$destination,'$weight',$status,'$weightcharge','$codcharge','$surcharge'))";

              $result = $db->query($query);

							if($result)
							{
					           echo "<div class='btn btn-success'>Item Enlisted with awb number : ".$awb_number."</div>";
							}
							else
							{
								echo "<div class='btn btn-error'>Error Requesting</div>";
							}
						}

						?>
				</div>
			</div>

      			<div class="col-md-4 add_file_csv">
      				<div>
      					<h2>Add Parcel using csv file</h2>
      					<form name="import" method="post" enctype="multipart/form-data">
      						<input type="file" name="file" / required accept=".csv"><br />
      						<input type="submit" name="file_submit" value="Submit" />
      					</form>
      				</div>
      				<?php
      					if(isset($_REQUEST["file_submit"]))
      					{
      					$allowed = 'csv';
      					$file = $_FILES['file']['tmp_name'];
      					$path = $_FILES['file']['name'];
      					$extension = pathinfo($path,PATHINFO_EXTENSION);
      					//$pincode = sanitize($_REQUEST['pincode']);
      					if(!empty($path)){
          				if(is_uploaded_file($file)){
                    $cities = [];
                    $query = "SELECT * FROM `city`";
                    $result = $db->query($query);
                    if(mysqli_num_rows($result) > 0) {
                      while($rows = mysqli_fetch_assoc($result)) {
                        $cities[$rows['city_name']] = $rows['city_id'];
                      }
                  }
            				if (($handle = fopen($file, 'r')) !== FALSE) {
                      $c=1;
                      $i=[];
              				fgetcsv($handle); //this is only to be used if we don't want the top most row.
      				        while (($filesop = fgetcsv($handle, 1000, ",")) !== FALSE) {
      				          $filesop = array_map("trim",$filesop);
                        if(in_array('',$filesop)){
                          array_push($i,$c);
                          continue;
                        }
                        else{
                          $client = sanitize($filesop[0]);
                          $awb_no = sanitize($filesop[1]);
                          $pincode = sanitize($filesop[2]);
        									$customer_name = sanitize($filesop[3]);
        									$customer_phone = sanitize($filesop[4]);
        									$customer_address =sanitize($filesop[5]);
        									$c_city = sanitize($filesop[6]);
        									$c_state = sanitize($filesop[7]);
        									$cod_amount = sanitize($filesop[8]);

                          $weight = sanitize($filesop[9]);
                          $r_mode = 21;
                          $charge_array = charges_calculate($weight,$cod_amount,$r_mode);
                          $charge_of_consignment = $charge_array['totalcharge'];
                          $codcharge = $charge_array['codcharge'];
                          $surcharge = $charge_array['surcharge'];
                          $weightcharge = $charge_array['weightcharge'];
        									$status = 20; //inital state
                          $today = date("Y-m-d");
                          $origin = trim(strtolower(sanitize($filesop[10])));
                          $destination = trim(strtolower(sanitize($filesop[11])));
                          $origin = $cities[$origin];
            							$destination = $cities[$destination];


                          $c_query ="INSERT INTO customer (id ,client_order_id ,awb_number ,pincode ,customer_name , customer_phone , customer_address,
                             c_city ,c_state , cod_amount , delivery_type, charge_of_consignment , origin_of_consignment , destination_of_consignment ,
                             weight , status ,enlist_date , wt_charge , cod_charge ,sur_charge)
                            VALUES(null,'$client','$awb_no',$pincode,'$customer_name',$customer_phone,
              							'$customer_address','$c_city','$c_state',$cod_amount,'$deliver_type',$charge_of_consignment,$origin,
              							$destination,'$weight',$status,'$today','$weightcharge','$codcharge','$surcharge')";

                          $c_result = $db->query($c_query);

        									if($c_result)
        									{
        										echo '<div class="file_status_container"> <div class="file_success"> <div class="file_success_thumb">
                             <img src="images/success.png"> </div> <div> <h2>File has been successfully imported.</h2>';
                             echo "Row ";
                						 foreach ($i as $value) {
                						  print($value." - ");
                						 }
                						 echo "has some proble . Enter it manually.";
        									}
        									else {
        										echo '<div class="file_status_container"> <div class="file_success"> <div class="file_success_thumb"> <img src="images/cancel.png"> </div> <div> <h2>There was some problem with your file. <br />'.mysqli_error($db).'</h2> </div> </div> </div>';
        									}
                        }
      				        }
      				        fclose($handle);
      				        }
      							else if($_FILES['file']['error'] > 0)
      							{
      								$error = "Error Opening file";
      							}
            		}
            		else {
              		echo 'error while opening the file.';
            		}
          		}
      				else {
      					echo 'file is empty';
      				}
      			}
					?>



			</div>


	</div>


</div>







</body>
</html>
