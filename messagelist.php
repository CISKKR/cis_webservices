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
    $data['msg'] = "Transaction ID Should not be blank" ;  
    $validate=false;
    }

    //For success data in JSON fromat
    header('Content-Type: application/json');

    if($validate == false){
      //$data['msg']= substr($data['msg'], 0, -1) ;
        print_r(json_encode($data)); die;
    }

   $result =mysql_query("SELECT * FROM fx_tcomments WHERE tid='".$tid."' ORDER BY cid DESC ");
   if (mysql_num_rows($result) > 0)  
   {
        // fetch data in array format  
        $message=array();
        while ($row=mysql_fetch_array($result, MYSQL_ASSOC)) 
            {  
                $messages=array(
                'commentby'=>$row['commentby'],
                'comment'=>$row['comment'],
                'created_date'=>$row['cdate']);
                array_push($message,$messages);
            }
        $data['status']="Success";
        $data['msg']="Message List";
        $data['message']=$message;

    }
    else 
    {
        $data['status']="Error";
        $data['msg']="No Message Found For This Transaction";
    }
    
    print_r(json_encode($data));
    die;

?>
