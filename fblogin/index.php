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
if(@$_SESSION['fboturum']=="tamam"){ 
    // giriş yapılmışsa burası 
    $cikisurl = $facebook->getLogoutUrl(array( 
         'next' => 'http://localhost/github/facelogin/fblogin/fbout.php' 
    )); 
    echo "<a href=\"{$cikisurl}\">Çıkış yapmak için tıklayın.</a>"; 

     // İzin verilme koşulu sağlandıysa 
     $fbID = $facebook->getUser(); 
     
    // api metodundan üye bilgilerini çekelim 
   $yeniuye = $facebook->api("/{$fbID}",'GET'); 

   // üye bilgileri $yeniuye dizisinde tutulacak. 

   echo $yeniuye['age_range'];

} 
else{ 
// giriş yapılmamışsa burası 
$girisurl = $facebook->getLoginUrl(array( 
     'scope' => 'publish_stream,email', 
     'redirect_uri' => 'http://localhost/github/facelogin/fblogin/fbin.php' 
)); 
echo "<a href=\"{$girisurl}\">Facebook ile giriş için tıklayın.</a>"; 
}

?>
    
</body>
</html>
