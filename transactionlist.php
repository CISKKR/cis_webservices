<?php include("connection.php"); 

    // Post JSON Data Convert in Request Format
    $jsonData = file_get_contents("php://input");//Get all post data
    $post_data = json_decode($jsonData, true);//decode post data
    $_POST= $post_data;
    
    $username=mysql_real_escape_string(trim($_POST['username']));
    $validate=true;
    $data=array();

    // Validation for blank
    if($username =='') {
    $data['status']="Error"; 
    $data['msg'] = "Username Should not be blank," ;  
    $validate=false;
    }

    //For success data in JSON fromat
    header('Content-Type: application/json');

    if($validate == false){
        print_r(json_encode($data)); die;
    }

    
   $result =mysql_query("SELECT * FROM fx_transaction WHERE transferby='".$username."' ");
   if (mysql_num_rows($result) > 0)  
   {
        $transaction=array();
        while ($row=mysql_fetch_array($result, MYSQL_ASSOC)) 
            {  
                $transactions=array(
                'tid'=>$row['tid'],
                'transferto'=>$row['transferto'],
                'amount'=>$row['amount'],
                'currency_code'=>$row['ccode'],
                'deposit_date'=>$row['deposit_date'],
                'bank_name'=>$row['bname'],
                'image'=>$row['image'],
                'created_date'=>$row['tsdate'],
                'ttype'=>$row['type'],
                'status'=>$row['status']);
                //print_r($tranasctions);
                array_push($transaction,$transactions);
            }
        $data['status']="Success";
        $data['msg']="Transaction List";
        $data['transaction']=$transaction;
    }
    else 
    {
        $data['status']="Error";
        $data['msg'] = "No transactions found";
    }

    print_r(json_encode($data));
    die;
?>
