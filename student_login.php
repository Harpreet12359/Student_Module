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
    <title>STUDENT LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
<div class="container" >
<form action="student_login.php" method="POST" enctype="multipart/form-data">
 <div class="text-center text-warning" ><br><h1>STUDENT LOGIN</h1></div>
 <div class="mb-3">
    <label  class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="email">
  </div>
  <div class="mb-3">
    <label  class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Login</button>   <a  href="student_register.php">Register</a>
</form>
</div>

<?php
if(isset($_POST['submit'])){
    $s_email = $_POST['email'];
    $s_password = $_POST['password'];

    $sql = "select * from  student where s_email = '$s_email' and password ='$s_password'";
    
    $query = mysqli_query($conn , $sql);
    $row = mysqli_num_rows($query);
        if($row > 0){
            $userdata = mysqli_fetch_row($query);
            $_SESSION['user'] = $userdata[0];
            echo "Login successfull.";
            header("location: ./studentinfo.php?id=".$userdata[0]);
        }else{
            echo "Invalid details";
        }
    
}
?>
    
</body>
</html>