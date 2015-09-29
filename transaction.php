<?php include("connection.php"); 

    // Post JSON Data Convert in Request Format
    $jsonData = file_get_contents("php://input");//Get all post data
    $post_data = json_decode($jsonData, true);//decode post data
    $_POST= $post_data;

    $tid=mysql_real_escape_string(trim($_POST['tid']));
    $validate=true;
    $data=array();

    // Validation for blank
    if($tid =='') {
    $data['status']="Error";
    $data['msg'] .= "Transaction ID Should not be blank" ;  
    $validate=false;
    }

    //For success data in JSON fromat
    header('Content-Type: application/json');

    if($validate == false){
      //$data['msg']= substr($data['msg'], 0, -1) ;
        print_r(json_encode($data)); die;
    }

   $result =mysql_query("SELECT * FROM fx_transaction WHERE tid='".$tid."' ");
   if (mysql_num_rows($result) > 0)  
   {
        // fetch data in array format  
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        if($row['type']=='Manual')
        {    
            $data['status']="Success";
            $data['msg']="Transaction Data";
            $data['transaction']=array(
                    'tid'=>$row['tid'],
                    'transferto'=>$row['transferto'],
                    'amount'=>$row['amount'],
                    'currency_code'=>$row['ccode'],
                    'deposit_date'=>$row['deposit_date'],
                    'bank_name'=>$row['bname'],
                    'image'=>'http://karpay.kr.cisinlive.com/uploads/'.$row['image'],
    	            'created_date'=>$row['tsdate'],
                    'ttype'=>$row['type'],
                    'status'=>$row['status']);
        }
        else
        {
            $data['status']="Success";
            $data['msg']="Transaction Data";
            $data['transaction']=array(
                    'tid'=>$row['tid'],
                    'transferto'=>$row['transferto'],
                    'amount'=>$row['amount'],
                    'currency_code'=>$row['ccode'],
                    'created_date'=>$row['tsdate'],
                    'ttype'=>$row['type'],
                    'status'=>$row['status']);
        }
    }
    else 
    {
        $data['status']="Error";
        $data['msg']="No transactions found";
    }
    
    print_r(json_encode($data));
    die;

?>