<?php
   include("connection.php"); 
   function generateRandomOrder($length = 4) {
    $today = date("Ymd");
    $rand = strtoupper(substr(uniqid(sha1(time())),0,4));   
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
      $orderno="ORD-".$today."-".$randomString;
    return $orderno;
}
 function checkOrderNo(){
     $sql="SELECT orderno from fx_transaction where orderno='".$orderno."'";
     $result =mysql_query($query);
     $num_rows = mysql_num_rows($result);
     if($num_rows>=1)
         return false;
     else
         return true;
 }

   
?>