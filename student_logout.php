<?php
$hostname= "localhost";
$username = "root";
$password = "";
$database = "student_module";
$conn = mysqli_connect($hostname , $username , $password , $database);
if($conn){
    echo "connected";
}else{
echo"not connected";
    }
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
unset($_SESSION);
session_destroy();
header('Location: student_login.php');

die;
?>
</body>
</html>