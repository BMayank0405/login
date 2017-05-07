<?php
  session_start();

  require_once './functions/init.php';
  require_once './functions/function.php';
  if(!logged_in()){
    $username = sanitize($_POST['username']);
    $result = $db->query("SELECT `id` FROM `user` WHERE `username`='$username'");
    try{
    if($result){
      while($row = $result->fetch_row()){
        $_SESSION['user_id'] = $row[0];
        $_SESSION['staff_name'] = $username;
      }
    }
    else{
      throw new Exception('Internal error Occured');
    }
    }
    catch(Exception $ex){
      echo $ex->getMessage();
      echo "\r\n";
      die();
    }
  }
  protect_page();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Panel || Evencargo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="css/generic.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="js/generic.js"></script>
</head>
<body>

<?php
  require_once 'header.php';
?>

<div class="container-fluid staff_panel_ind c_container">
	<div class="alpha_inside alpha_s_options">

      <div class="staff_panel_headerr">
        <h2>Staff Panel</h2>
        <h5></h5>
      </div>
      <div class="row">
        <div class="col-md-2 staff_options">
          <a href="add_parce.php">
            <div class="staff_options_thumb">
              <img src="images/list.png">
            </div>
          <h4>Product Delivery</h4>
          </a>
        </div>
        <div class="col-md-2 staff_options">
          <a href="product_return.php">
            <div class="staff_options_thumb">
              <img src="images/load-goods.png">
            </div>
            <h4>Product Return</h4>
          </a>
        </div>
           <div class="col-md-2 staff_options">
            <a href="report.php">
              <div class="staff_options_thumb">
                <img src="images/report.png">
              </div>
              <h4>View Report</h4>
            </a>
          </div>
      </div>
      <div class="row">
        <div class="col-md-2 staff_options">
            <a href="client_add.php">
              <div class="staff_options_thumb">
                <img src="images/client_add.png">
              </div>
              <h4>Add Client</h4>
            </a>
        </div>
        <div class="col-md-2 staff_options">
            <a href="client_report.php">
              <div class="staff_options_thumb">
                <img src="images/excel.png">
              </div>
              <h4>Client Report</h4>
            </a>
        </div>
        <div class="col-md-2 staff_options">
            <a href="client_invoice.php">
              <div class="staff_options_thumb">
                <img src="images/invoice.png">
              </div>
              <h4>Invoice</h4>
            </a>
        </div>

  </div>
</div>
</body>
</html>
