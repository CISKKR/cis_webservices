<?php 
if(isset($_POST['submit']) && $_POST['submit']!="")
{
	
	$post=http_build_query($_POST);

	$url="https://crystals-pay.biz/paynet/api/v2/sale-form/620";
	$ch = curl_init();
    // Post values
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_POST, true);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close ($ch);  
    $value= explode(" &", $output);
	echo $url1=$value[4]; 
     echo "<PRE>";
   
    parse_str($output, $new);	
	 print_r($new);
echo "</PRE>";
    /*if($url1!='')
    {
    	
		$ch = curl_init();
	    // Post values
	    curl_setopt ($ch, CURLOPT_URL, $url1);
	    curl_setopt ($ch, CURLOPT_POST, true);
	    curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	    $output1 = curl_exec($ch);
	    curl_close ($ch); 

	    $str=json_encode($output1);
		file_put_contents("data.txt", $str . "\n\n\n", FILE_APPEND);
		exit();
    }*/
}


 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Submit</title>
	
</head>
<body>

<form method="post" action="">
	<table class="api-content">
		<tbody>
			<tr><td>Credit Card Detail:</td></tr>
			<tr><th><nobr>credit_card_number*</nobr></th>
			<td><input name="credit_card_number" type="text" size="20" value="4338207454393717" /></td></tr>
			<tr><th><nobr>expire_month*</nobr></th>
			<td><input name="expire_month" type="text" size="10" value="12" /></td></tr>
			<tr><th><nobr>expire_year*</nobr></th>
			<td><input name="expire_year" type="text" size="10" value="2016" /></td></tr>
			<tr><th><nobr>cvv2*</nobr></th>
			<td><input name="cvv2" type="text" size="4" value="123" /></td></tr>
			<tr><td><br></td></tr>
			<tr><td>User Information:</td></tr>

			<tr><th><nobr>endpointid or groupid</nobr></th>
        	<td><input class="mcell" name="endpointid" type="text" size="10" value="620"></td></tr>
			<tr><th><nobr>client_orderid*</nobr></th>
			<td><input id="iInv" class="mcell" name="client_orderid" type="text" size="35" value="123456" /></td></tr>
			<tr><th><nobr>order_desc*</nobr></th>
			<td><input name="order_desc" type="text" size="35" value="Test Order Description" /></td></tr>
			<tr><th><nobr>first_name</nobr></th>
			<td><input name="first_name" type="text" size="35" value="John" /></td></tr>
			<tr><th><nobr>last_name</nobr></th>
			<td><input name="last_name" type="text" size="35" value="Smith" /></td></tr>
			<tr><th><nobr>ssn</nobr></th>
			<td><input name="ssn" type="text" size="4" value="1267" /></td></tr>
			<tr><th><nobr>birthday</nobr></th>
			<td><input name="birthday" type="text" size="6" value="19820115" /></td></tr>
			<tr><th><nobr>address1*</nobr></th>
			<td><input name="address1" type="text" size="35" value="100 Main st" /></td></tr>
			<tr><th><nobr>city*</nobr></th>
			<td><input name="city" type="text" size="35" value="Seattle" /></td></tr>
			<tr><th><nobr>state</nobr></th>
			<td><input name="state" type="text" size="2" value="WA" /></td></tr>
			<tr><th><nobr>zip_code*</nobr></th>
			<td><input name="zip_code" type="text" size="10" value="98102" /></td></tr>
			<tr><th><nobr>country*</nobr></th>
			<td><input name="country" type="text" size="2" value="US" /></td></tr>
			<tr><th><nobr>phone</nobr></th>
			<td><input name="phone" type="text" size="15" value="+12063582043" /></td></tr>
			<tr><th><nobr>cell_phone</nobr></th>
			<td><input name="cell_phone" type="text" size="15" value="+19023384543" /></td></tr>
			<tr><th><nobr>amount*</nobr></th>
			<td><input class="mcell" name="amount" type="text" size="10" value="1.00" /></td></tr>
			<tr><th><nobr>email*</nobr></th>
			<td><input class="mcell" name="email" type="text" size="35" value="manish.k@cisinlabs.com" /></td></tr>
			<tr><th><nobr>currency*</nobr></th>
			<td><input name="currency" type="text" size="3" value="CNY" /></td></tr>
			<tr><th><nobr>ipaddress*</nobr></th>
			<td><input name="ipaddress" type="text" size="20" value="65.153.12.232" /></td></tr>
			<tr><th><nobr>site_url</nobr></th>
			<td><input name="site_url" type="text" size="35" value="www.google.com" /></td></tr>
			<tr><th><nobr>destination</nobr></th>
			<td><input name="destination" type="text" size="35" value="www.twitch.tv/dreadztv" /></td></tr>
			<tr><th><nobr>merchant_control*</nobr></th>
			<?php $control="620"."123456"."100"."manish.k@cisinlabs.com"."05627B09-3431-4DBC-8C98-B733A2371D31"; ?>
			<td><input class="mcell" name="control_key" type="hidden" size="40" value="05627B09-3431-4DBC-8C98-B733A2371D31"/><input class="mcell" name="control" type="text" size="40" value="<?=sha1($control)?>"/></td></tr>
			<tr><th><nobr>redirect_url*</nobr></th>
			<td><input name="redirect_url" type="text" size="35" value="http://karpay.kr.cisinlive.com/union/callback.php" /></td></tr>
			<tr><th><nobr>server_callback_url</nobr></th>
			<td><input name="server_callback_url" type="text" size="35" value="http://karpay.kr.cisinlive.com/union/callback.php" /></td></tr>
			<tr><th><nobr>merchant_data</nobr></th>
			<td><input name="merchant_data" type="text" size="35" value="VIP customer" /></td></tr>
			<tr><th><nobr></nobr></th>
			<td><input type="submit" name="submit" value="Submit"></td></tr>
		</tbody>
	</table>
</form>

</body>
</html>
