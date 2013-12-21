<!DOCTYPE html>
<html>
    <head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
</head>
<body>

<?php
require_once("ayar.php"); 
require_once("../lib/fbsdk/src/facebook.php"); 
$facebook = new Facebook($fbayar); 
if(isset($_GET['error'])){ 
     // İzin verilmedi, iptale tıklandı. 
     header("Location: index.php"); 
     // Hiçbirşey yapmadık, kullanıcıyı sadece index.php sayfasına yönlendirdik. 
} 
else{ 
     // İzin verilme koşulu sağlandıysa 
     $fbID = $facebook->getUser(); 
     
     $uyekontrol = mysql_query("SELECT * FROM uyeler WHERE fbID='$fbID'"); 

     if(mysql_num_rows($uyekontrol)==1){ 
          // Daha önce kayıt olmuş bir üye ise 
          $_SESSION['fboturum']="tamam"; 
          $uyebilgi = mysql_fetch_object($uyekontrol); 
          $_SESSION['fboturumid'] = $uyebilgi->id; 
          header("Location: index.php"); 
     } 
     else{ 
          // Daha önce kayıt olmuş bir üye değilse 
           
          // api metodundan üye bilgilerini çekelim 
          $yeniuye = $facebook->api("/{$fbID}",'GET'); 

          // üye bilgileri $yeniuye dizisinde tutulacak. 
           
          $adsoyad = $yeniuye['name']; 
          $email = $yeniuye['email']; 

          mysql_query("INSERT INTO uyeler (adsoyad,fbID,email) VALUES ('$adsoyad','$fbID','$email')"); 

          $uyeidcek = mysql_query("SELECT * FROM uyeler WHERE fbID='$fbID'"); 
          $yeniuyeid = mysql_fetch_object($uyeidcek); 

          $_SESSION['fboturum']="tamam"; 
          $_SESSION['fboturumid'] = $yeniuyeid->id; 
          header("Location: index.php"); 
     } 
}  
?>
    
</body>
</html>
