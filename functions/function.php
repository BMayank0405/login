<?php

  function sanitize(string $data ){
     global $db;
     $data = htmlentities(strip_tags(trim($data)),ENT_QUOTES);
     return $db->real_escape_string($data);
  }


  function logged_in() {
     return (isset($_SESSION['user_id']))?true:false;
  }

  //to protect unauthorized user from using the page
  function protect_page() {
    if( !logged_in()){
      header('Location: index.php');
      exit();
    }
  }

  // so that the logged in user user can not access the register page
function logged_in_redirect() {
  if(logged_in()){
    header('Location: lan.php');
    exit();
  }
}

//to calculate the charges of the items
function charges_calculate($weight,$price,$mode)
{

	$init_price = 30.00;
	$cost_by_weight = $init_price;
	$total_cost = 0;
	$cost_array = [];
	$cost_array['codcharge'] = 0;
	if($weight > 500)
	{
		$weight_parts = ceil($weight/500) - 1;
		$cost_by_weight += $weight_parts*25;
	}


		$total_cost+= $cost_by_weight;

		$cost_array['weightcharge']=$total_cost;

		$including_Surcharge = $total_cost * (15/100);
        $total_cost =$total_cost+$including_Surcharge;

      	$cost_array['surcharge'] = $including_Surcharge;

     if($mode == 1)
	{
		$codChages = 35;
		$percentage_codCharges = $price * (1.30/100);
		if($codChages > $percentage_codCharges)
		{
			$cost_array['codcharge'] = $codChages;
			$total_cost += $codChages;
		}
		else
		{
			$cost_array['codcharge'] = $percentage_codCharges;
			$total_cost += $percentage_codCharges;
		}


	}

	if($mode == 21)
	{
		$total_cost = $total_cost + 10;
	}

	$cost_array['totalcharge'] = $total_cost;

	return $cost_array;

}


//to get city code for the drop down
function getCityCode($array,$city)
{
	return $array[$city];
}




?>
