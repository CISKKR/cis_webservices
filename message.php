<?php //error_reporting(E_ALL); 
include("connection.php"); 

    // Post JSON Data Convert in Request Format
    $jsonData = file_get_contents("php://input");//Get all post data
    $post_data = json_decode($jsonData, true);//decode post data
    $_POST= $post_data;

    $username=mysql_real_escape_string(trim($_POST['username']));
    $userrole=mysql_real_escape_string(trim($_POST['userrole']));
    $comment=mysql_real_escape_string(trim($_POST['comment']));
    $tid=mysql_real_escape_string(trim($_POST['tid']));
    
    $validate=true;
    $data=array();

    // Validation for blank
    if($username =='') {
    $data['status']="Error";    
    $data['msg'] = "Username Should not be blank" ;  
    $validate=false;
    }

    if($userrole =='') {
    $data['status']="Error";    
    $data['msg'] = "Username Role Should not be blank" ;  
    $validate=false;
    }

    if($comment =='') {
    $data['status']="Error";    
    $data['msg'] = "Comment Should not be blank";    
    $validate=false;
    }

    if($tid =='') {
    $data['status']="Error";    
    $data['msg'] = "Transaction ID Should not be blank";    
    $validate=false;
    }

    //For success data in JSON fromat
    header('Content-Type: application/json'); 
    
    if($validate == false){
        print_r(json_encode($data)); die;
    }

    $sresult=mysql_query("SELECT * FROM fx_tcomments WHERE tid='".$tid."' ORDER BY cdate DESC LIMIT 1");
    $count=mysql_num_rows($sresult);

    if($count==1){
        $row=mysql_fetch_array($sresult);
        $status=$row['cstatus'];
        $newmsg="Yes";
    } else {
        $status="Pending";
        $newmsg="Yes";
    }


    $query="INSERT INTO fx_tcomments(tid, commentby, userrole, comment, cstatus, cdate, newmsg) VALUES('".$tid."','".$username."','".$userrole."','".$comment."','".$status."','".date('Y-m-d H:i:s')."','".$newmsg."')";
    $result =mysql_query($query);
    if ($result)  
        {
            $data['status']="Success";
            $data['msg']="Message Submit Successfully";
        }
        else 
        {
            $data['status']="Error";
            $data['msg']="Message Not Submit";
        }
 
    // print_r($data); die; 
    print_r(json_encode($data));
    die;
?>