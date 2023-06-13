<?php 
try {
//host
$host = "localhost";

//dbname
$dbname = "blogcms";

//user 
$user = "root";

//password
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo $e->getmessage();
}



// if($conn == true){
//     echo "conn works fine";
// }else {
//     echo "conn did not work";
// }




?>