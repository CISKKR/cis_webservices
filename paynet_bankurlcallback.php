<?php //error_reporting(E_ALL); 
include("connection.php"); 
include("functions.php"); 

    // Post JSON Data Convert in Request Format
    $jsonData = file_get_contents("php://input");//Get all post data
    $post_data = json_decode($jsonData, true);//decode post data
    $_POST= $post_data;

    $endpointid='620';
    $orderno=generateRandomOrder();

    $client_orderid=$orderno;
    
    $order_desc='ABC';
    $first_name=mysql_real_escape_string(trim($_POST['first_name']));
    $last_name=mysql_real_escape_string(trim($_POST['last_name']));
    $ssn=mysql_real_escape_string(trim($_POST['ssn']));
    $birthday=mysql_real_escape_string(trim($_POST['birthday']));
    $address1=mysql_real_escape_string(trim($_POST['address1']));
    $city=mysql_real_escape_string(trim($_POST['city']));
    $state=mysql_real_escape_string(trim($_POST['state']));
    $zip_code=mysql_real_escape_string(trim($_POST['zip_code']));
    $country=mysql_real_escape_string(trim($_POST['country']));
    $phone=mysql_real_escape_string(trim($_POST['phone']));
    $cell_phone=mysql_real_escape_string(trim($_POST['cell_phone']));
    $amount=mysql_real_escape_string(trim($_POST['amount']));
    $email=mysql_real_escape_string(trim($_POST['email']));
    $currency=mysql_real_escape_string(trim($_POST['currency']));
    $ipaddress='';
    $site_url=mysql_real_escape_string(trim($_POST['site_url']));
    $destination=mysql_real_escape_string(trim($_POST['destination']));
    $control_key='05627B09-3431-4DBC-8C98-B733A2371D31';
    $redirect_url="";
    $server_callback_url="";
    $merchant_data="Instant Payment User";

    $validate=true;
    $data=array();

    // Validation for blank

    if($first_name =='') {
    $data['status']="Error";    
    $data['msg'] = "First Name Should not be blank" ;  
    $validate=false;
    }

    if($last_name =='') {
    $data['status']="Error";    
    $data['msg'] = "Last Name Should not be blank" ;  
    $validate=false;
    }

    if($ssn =='') {
    $data['status']="Error";    
    $data['msg'] = "SSN Should not be blank" ;  
    $validate=false;
    }

    if($birthday =='') {
    $data['status']="Error";    
    $data['msg'] = "Birthday Should not be blank" ;  
    $validate=false;
    }

    if($address1 =='') {
    $data['status']="Error";    
    $data['msg'] = "Address Should not be blank" ;  
    $validate=false;
    }

    if($city =='') {
    $data['status']="Error";    
    $data['msg'] = "City Id Should not be blank" ;  
    $validate=false;
    }

    if($state =='') {
    $data['status']="Error";    
    $data['msg'] = "State Should not be blank" ;  
    $validate=false;
    }

    if($zip_code =='') {
    $data['status']="Error";    
    $data['msg'] = "Zip Code Should not be blank" ;  
    $validate=false;
    }

    if($country =='') {
    $data['status']="Error";    
    $data['msg'] = "Country Should not be blank" ;  
    $validate=false;
    }

    if($phone =='') {
    $data['status']="Error";    
    $data['msg'] = "Phone Should not be blank" ;  
    $validate=false;
    }

    if($cell_phone =='') {
    $data['status']="Error";    
    $data['msg'] = "Cell Phone Should not be blank" ;  
    $validate=false;
    }

    if($amount =='') {
    $data['status']="Error";    
    $data['msg'] = "Amount Should not be blank" ;  
    $validate=false;
    }

    if($email =='') {
    $data['status']="Error";    
    $data['msg'] = "email Should not be blank" ;  
    $validate=false;
    }

    if($currency =='') {
    $data['status']="Error";    
    $data['msg'] = "Currency Type Should not be blank" ;  
    $validate=false;
    }

    if($site_url =='') {
    $data['status']="Error";    
    $data['msg'] = "Site URL Should not be blank" ;  
    $validate=false;
    }

    if($destination =='') {
    $data['status']="Error";    
    $data['msg'] = "Destination Should not be blank" ;  
    $validate=false;
    }

    if($amount =='') {
    $data['status']="Error";    
    $data['msg'] = "Amount Should not be blank";    
    $validate=false;
    }
    

    //For success data in JSON fromat
    header('Content-Type: application/json'); 
    
    if($validate == false){
        print_r(json_encode($data)); die;
    }
    
    $query="INSERT INTO fx_transaction(transferto,orderno, amount, ccode, tsdate, transferby, type, status) VALUES('".$transferto."','".$orderno."','".$amount."','".$currency_code."','".date('Y-m-d H:i:s')."','".$transferby."','Instant','".$status."')";
    $result =mysql_query($query);
    if ($result)  
        {
            // another way to call error_log():
            error_log("order no ".$orderno." processed at ".date('Y-m-d H:i:s'), 3, "errors.log");
            //$data['msg']="Data Insert Successfully";
        }
        else 
        {
            error_log("order no ".$orderno." not inserted in database at ".date('Y-m-d H:i:s'), 3, "errors.log");
        }
 
    // print_r($data); die; 
   // print_r(json_encode($data));
   


$amount=str_replace('.','', $amount);
$control=sha1($endpointid.$client_orderid.$amount.$email.$control_key);

$curldata=array(
	'endpointid'=>$endpointid,
	'client_orderid'=>$client_orderid,
	'order_desc'=>$order_desc,
	'first_name'=>$first_name,
	'last_name'=>$last_name,
	'ssn'=>$ssn,
	'birthday'=>$birthday,
	'address1'=>$address1,
	'city'=>$city,
	'state'=>$state,
	'zip_code'=>$zip_code,
	'country'=>$country,
	'phone'=>$phone,
	'cell_phone'=>$cell_phone,
	'amount'=>$amount,
	'email'=>$email,
	'currency'=>$currency,
	'ipaddress'=>$ipaddress,
	'site_url'=>$site_url,
	'destination'=>$destination,
	'control_key'=>$control_key,
	'control'=>$control,
	'redirect_url'=>$redirect_url,
	'server_callback_url'=>$server_callback_url,
	'merchant_data'=>$merchant_data);
	
	$post=http_build_query($curldata);

	$url="https://crystals-pay.biz/paynet/api/v2/sale-form/620";
	$ch = curl_init();
    // Post values
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_POST, true);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close ($ch);

    // Text To String
    parse_str($output, $new);

    if($new['type']=='validation-error')
    {
    	$data['status']="Error";
        $data['msg']=$new['error-message'];
    }
    elseif($new['type']=='async-form-response')
    {
	    if($new['redirect-url']!='')
	    {
                $data['redirect-url']=$new['redirect-url'];
	    }
	}

?>


