<?php //error_reporting(E_ALL); 
include("connection.php"); 

    // Post JSON Data Convert in Request Format
    $jsonData = file_get_contents("php://input");//Get all post data
    $post_data = json_decode($jsonData, true);//decode post data
    $_POST= $post_data;

    $transferto=mysql_real_escape_string(trim($_POST['transferto']));
    $amount=mysql_real_escape_string(trim($_POST['amount']));
    $currency_code=mysql_real_escape_string(trim($_POST['currency_code']));
    $status=mysql_real_escape_string(trim($_POST['status']));
    //$bank_name=mysql_real_escape_string(trim($_POST['bank_name']));
    $transferby=mysql_real_escape_string(trim($_POST['transferby']));
    $validate=true;
    $data=array();

    // Validation for blank
    if($transferto =='') {
    $data['status']="Error";    
    $data['msg'] = "Transfer To Username Should not be blank" ;  
    $validate=false;
    }

    if($amount =='') {
    $data['status']="Error";    
    $data['msg'] = "Amount Should not be blank";    
    $validate=false;
    }

    if($currency_code =='') {
    $data['status']="Error";    
    $data['msg'] = "Currency Code Should not be blank";    
    $validate=false;
    }

    if($status =='') {
    $data['status']="Error";    
    $data['msg'] = "Status Should not be blank";    
    $validate=false;
    }

    /*if($bank_name =='') {
    $data['status']="Error";    
    $data['msg'] = "Bank Name Should not be blank";    
    $validate=false;
    }*/

    if($transferby =='') {
    $data['status']="Error";    
    $data['msg'] = "Transfer By Username Should not be blank";    
    $validate=false;
    }

    //For success data in JSON fromat
    header('Content-Type: application/json'); 
    
    if($validate == false){
        print_r(json_encode($data)); die;
    }
    
    $query="INSERT INTO fx_transaction(transferto, amount, ccode, tsdate, transferby, type, status) VALUES('".$transferto."','".$amount."','".$currency_code."','".date('Y-m-d H:i:s')."','".$transferby."','Instant','".$status."')";
    //$result =mysql_query($query);
    if ($result)  
        {
            $data['status']="Success";
            $data['msg']="Data Insert Successfully";
        }
        else 
        {
            $data['status']="Error";
            $data['msg']="Data Insert UnSuccessful";
        }
 
    // print_r($data); die; 
    print_r(json_encode($data));
    die;
?>
