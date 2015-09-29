<?php 

	$user_name="master";
	$curr_code="USD";
	$curr_amount="10";
	$order_id="1";
	$remark="Successful";

	$url="http://68.233.255.125/mc/access/?api_key=9e8eb18a02a14f3c9fe714318f788230&act=recharge_manual&order_id=".$order_id."&curr_code=".$curr_code."&curr_amount=".$curr_amount."&user_name=".$user_name."&remark=".$remark;
	$ch = curl_init($url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    print_r($output);
    curl_close ($ch);   
 ?>
