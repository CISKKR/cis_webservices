<?php 
include("connection.php"); 
header('Content-Type: application/json');
           
           $result =mysql_query("SELECT bname FROM fx_bank");
           if (mysql_num_rows($result) > 0)  
           {
                $bank=array();
                // fetch data in array format  
                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
                {  
                    //$banks=array('bankname'=>$row['bname']);
                    array_push($bank,$row['bname']);
 
                }
                $data['status']="Success";
                $data['msg']="Bank List";
                $data['bank']=$bank;         
            }
            else 
            {
                $data['status']="Error";
                $bata['msg'] = "No bank found";
            }
    print_r(json_encode($data));
    die;
?>
