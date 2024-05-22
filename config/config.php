<?php


//host
$host = "localhost";

//dbname

$dbname = "Bookstore";

//username

$user ="root";

//pw

$pass = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// if($conn){
//     echo "Worked sucessfully";
// } else{
//     echo "error in db connection"
// }