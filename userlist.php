<?php 
include("connection.php"); 
header('Content-Type: application/json');
    
    $result =mysql_query("SELECT * FROM fx_users");
    if (mysql_num_rows($result) > 0)  
        {
            $user=array();
            // fetch data in array format  
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
            {  
                // Fetch data of bname Column and store in array of banks  
                if($row['username']!="admin"){
                    //$users=array('username'=>$row['username']);
                    array_push($user,$row['username']);
                }
                $data['status']="Success";
                $data['msg']="User List";
                $data['user']=$user;  
                 
                  
            }         
        }
    else 
        {
            $data['status']="Error";
            $data['msg'] = "No user found";
        }
    print_r(json_encode($data));
    die;
?>
