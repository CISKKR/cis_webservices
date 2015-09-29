<?php include("connection.php"); 
require "PasswordHash.php";

    // Post JSON Data Convert in Request Format
    $jsonData = file_get_contents("php://input");//Get all post data
    $post_data = json_decode($jsonData, true);//decode post data
    $_POST= $post_data;

    //Class Using For Password Hashing
    $t_hasher = new PasswordHash(8, FALSE);

    $username=mysql_real_escape_string(trim($_POST['username']));
    $password=mysql_real_escape_string(trim($_POST['password']));
    $token=mysql_real_escape_string(trim($_POST['token']));
    $platform=mysql_real_escape_string(trim($_POST['platform']));
    $validate=true;
    $data=array();

    // Validation for blank
    if($username =='') {
    $data['status']="Error";    
    $data['msg'] = "Username Should not be blank," ;  
    $validate=false;
    }

    if($password =='') {
    $data['status']="Error";    
    $data['msg'] = "Password Should not be blank,";    
    $validate=false;
    }

    if($token =='') {
    $data['status']="Error";    
    $data['msg'] = "Token Should not be blank,";    
    $validate=false;
    }

    if($platform =='') {
    $data['status']="Error";    
    $data['msg'] = "Platform Should not be blank,";    
    $validate=false;
    }
     
    //For success data in JSON fromat
    header('Content-Type: application/json');
        
    if($validate == false){
      $data['msg']= substr($data['msg'], 0, -1) ;
        print_r(json_encode($data)); die;
    }
    
    if($username=="admin"){

        $data['status']="Error";
        $data['msg'] = "Invalid Username";
    } 
    else
    {
        $result =mysql_query("SELECT * FROM fx_users WHERE username = '". $username ."' AND activated='1' ");
        if (mysql_num_rows($result) > 0)  
        {
            $row = mysql_fetch_array($result);
            $hash= $row['password'];
            $success=$t_hasher->CheckPassword($password, $hash);
            
            if($success==1)
            {
                $query1="UPDATE fx_users SET platform='".$platform."', token='".$token."', last_login='".date('Y-m-d H:i:s')."' WHERE id='".$row['id']."' ";
                $result1 =mysql_query($query1);

                if($row['role_id']=='1')
                $role = "Admin";
                elseif($row['role_id']=='2')
                $role = "Investor";
                else
                $role = "Agent"; 

                $data['status']="Success";
                $data['msg']="Logged in Successfully";
                $data['user']=array(
                    "email"=>$row['email'],
                    'role'=>$role,
                    'username'=>$row['username'],
                    'user_id'=>$row['id']);
            }
            
            else 
            {
                $data['status']="Error";
                $data['msg'] = "Invalid Password";
            }
        }
        else 
        {
            $data['status']="Error";
            $data['msg']="Invalid Username";
        }
    }    
 
    // print_r($data); die; 
    print_r(json_encode($data));
    die;
?>
