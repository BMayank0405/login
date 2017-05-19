<?php
require_once './functions/init.php';
?>
<!DOCTYPE html>
<html>
<head>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="staff_user/css/generic.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="staff_user/js/generic.js"></script>
	  <script type="text/javascript" src="staff_user/js/user-generic.js"></script>
</head>
<body background="4.jpg">


<nav class="navbar navbar-default navbar-fixed-top" id="header">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"></button>

      <a class="navbar-brand c_brand" href="index.php"><img class="img-responsive" src="staff_user/images/logo.png" width="40" height="40"><span>Even Cargo</span></a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">HOME</a></li>
        <li><a href="">Track Id</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="track_outer">


<div class="container-fluid">

		<div class="col-md-4 track_inp_box">
			<div class="">
				<h2>Track id</h2>
				<div class="">
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET" validate>
				<div class="form-group">
					Enter the awb number provided to you<br />
				</div>

				<div class="form-group">
					<input type="text" name="id" placeholder="Enter Number" required>
				</div>
				<div class="form-group" style="text-align:center;">
					<input type="submit" name="sub_req" value="Track Order">
				</div>
				</div>
			</div>
		</div>

		<?php
		if(isset($_REQUEST['sub_req']))
		{


			$awb_number = $_REQUEST['id'];

			$query = "SELECT * FROM `customer` WHERE `awb_number = '$awb_number'";
			$db->query($query);
			if(mysqli_num_rows($result) > 0)
			{
					while($rows = mysqli_fetch_assoc($result))
					{
						$status = $rows['status'];
						$dispatch_date = $rows['dispatch_date'];
						$delivery_date = $rows['delivery_date'];
						$client_order_id = $rows['client_order_id'];
						$customer_name = $rows['customer_name'];
						$mob_no = $rows['customer_phone'];
						$price = $rows['cod_charge'];
						$address = $rows['customer_address'];
						$dtype = $rows['delivery_type'];
						$enlist_date = $rows['enlist_date'];
						$attempts = $rows['attempts'];
						$attempts_date = $rows['attempt_date'];
					}
					if($dtype == 1)
					{
						$dtype = "Cash On Delivery";
					}
					else
					{
						$dtype = "Pre-paid";
					}

					echo '
					<div class="col-md-7 track_info_box">
					<div id="prd_stts" style="display:none;">'.$status.'</div>
					<h4>Track Product</h4>
					<div class="track_box_org at_warehouse">
						<div class="tbo_thumb">
							<img src="staff_user/images/t1.png">
						</div>
						<div class="tbo_head col-md-4">
							<h4>Received At Warehouse</h4>
						</div>
						<div class="col-md-7">
							<p>';
					$default_date = '0000-00-00';
					if($enlist_date > $default_date)
					{

						echo $enlist_date;

					}
					else
					{
						echo 'Recently';
					}
					echo'   <br />Received at Warehouse</p>
						</div>
					</div>';

					echo '
						<div class="track_box_org dispatched_from">

							<div class="tbo_thumb">
								<img src="staff_user/images/t3.png">
							</div>';

					if($status >= 1)
					{
					echo '
							<div class="tbo_head col-md-4">
								<h4>Dispached from Warehouse </h4>
							</div>
							<div class="col-md-7">
								<p> '.$dispatch_date.' <br /> Out For Delivery</p>
							</div>
						</div>
						';

					}
					else
					{
						echo '
							<div class="tbo_head col-md-4">
								<h4>Dispached from Warehouse </h4>
							</div>
							<div class="col-md-7">
								<p> ------------- <br /> </p>
							</div>
						</div>
						';
					}
					if($attempts > 0 && $status >=1)
					{
					echo '
						<div class="track_box_org delivered">
							<div class="tbo_thumb"  style="background:#f8a765;">
								<img src="staff_user/images/t4.png">
							</div>
							';
					}
					else
					{
					echo '
						<div class="track_box_org delivered">
							<div class="tbo_thumb">
								<img src="staff_user/images/t4.png">
							</div>
							';
					}
					if($status >= 2)
					{
					echo '
							<div class="tbo_head col-md-4">
								<h4>Delivered</h4>
							</div>
							<div class="col-md-7">
								<p>'.$delivery_date.'<br />Delivered at Customer Address</p>
							</div>
						</div>
					</div>
					';
					}
					elseif($status >= 1 && $attempts > 0)
					{
					echo '
							<div class="tbo_head col-md-4">
								<h4>Delivery Attempted</h4>
							</div>
							<div class="col-md-7">
								<p>'.$attempts_date.'<br />Delivery attempted at Customer Address</p>
							</div>
						</div>
					</div>
					';
					}
					else
					{
						echo '<div class="tbo_head col-md-4">
									<h4>Delivered</h4>
								</div>
								<div class="col-md-7">
									<p>-----------<br /></p>
								</div>
							</div>
						</div>';
					}


					echo '
					<div class="col-md-11 track_prod_info">
						<h3>Product Detail</h3>
						<div class="col-md-6 tpi_inf">
							<h4>Product Info</h4>
							<div class="col-md-9">
								<table class="table table-striped ">
									<tr><td>Product Name</td><td>'.$client_order_id.'</td></tr>
									<tr><td>Price</td><td>'.$price.'</td></tr>
									<tr><td>Type</td><td>'.$dtype.'</td></tr>
								</table>
							</div>
						</div>
						<div class="col-md-6 tpi_inf">
							<h4>Customer Info</h4>
							<div class="col-md-9">
								<table class="table table-striped ">
									<tr><td>Customer</td><td>'.$customer_name.'</td>
									<tr><td>Mobile</td><td>'.$mob_no.'</td></tr>
									<tr><td>Address</td><td>'.$address.'</td></tr>
								</table>
							</div>
						</div>
					</div>
					';
				 }
				 else
				 {
				 	echo '<div class="col-md-7 track_not_avail"><h2>Input Consignment Id is not valid</h2></div>';
				 }
			}


		?>



</div>
</div>



</body>
</html>
