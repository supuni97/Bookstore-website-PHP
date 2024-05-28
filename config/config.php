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

$secret_key = "sk_test_DRE2vhGZek1VAcOzUvrcFO7w001C7MWXZm";

// if($conn){
//     echo "Worked sucessfully";
// } else{
//     echo "error in db connection"
// }