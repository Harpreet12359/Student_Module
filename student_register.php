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
   
?>

<?php
if(isset($_POST['submit'])){
  
  $error = 0;
  $errorstring =array();
  $s_name = $_POST['name'];
  if($s_name == '' || empty($s_name)){
    $error = 1;
    $errorstring[]= "please insert Student Name";
}

  $s_email = $_POST['email'];

  if($s_email == '' || empty($s_email)){
    $error = 1;
    $errorstring[] = "Please Insert Student Email Id";
   }
 
   if($error ==0){
    $sql1 = "SELECT * FROM `student` WHERE s_email ='$s_email'";
   
    $query1 = mysqli_query($conn , $sql1);
    $row = mysqli_num_rows($query1);
    if($row >= 1){
        $error=1;
        $errorstring[] = "Email already exist, plese try with new email.";
    }
}
  $s_password = $_POST['password'];

  if($s_password == '' || empty($s_password)){
    $error = 1;
    $errorstring[] = "Please insert Password";
   }

   if(!empty($s_password) && (strlen($s_password)<8 || strlen($s_password)>20)){
    $error =1;
    $errorstring[] = "length of password should be between 2 to 20 characters";
}
  $s_cpassword = $_POST['confirmpassword'];
 


  $s_mobile = $_POST['mobile'];

  if($s_mobile == '' || empty($s_mobile)){
    $error = 1;
    $errorstring[] = "Please insert Mobile Number";
   }
 
   if(!empty($s_mobile) && (strlen($s_mobile)<10 || strlen($s_mobile)>15)){
    $error =1;
    $errorstring[] = "length of mobile should be between 2 to 20 characters";
}
  $s_address = $_POST['address'];
  if($s_address == '' || empty($s_address)){
    $error = 1;
    $errorstring[] = "Please insert Student Address";
   }

  $s_class = $_POST['class'];
  $s_dob = $_POST['dob'];
  if($s_dob == '' || empty($s_dob)){
    $error = 1;
    $errorstring[] = "Please insert Student Date Of Birth";
   }
  $s_image = $_FILES['image'];

   if(isset($_FILES['image'])){

   $file_name = $_FILES['image']['name'];
   $file_size = $_FILES['image']['size'];
   $file_tmp = $_FILES['image']['tmp_name'];
   $file_type = $_FILES['image']['type'];

   move_uploaded_file($file_tmp,"images/".$file_name);
   }


  $sql = "INSERT INTO student VALUES ('','$s_name',' $s_email','$s_password',' $s_mobile',' $s_address',' $s_class',' $s_dob','$file_name')";
  // echo($sql); die("test");
  $query =mysqli_query($conn , $sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT REGISTER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container" >
<form action="student_register.php" method="POST" enctype="multipart/form-data">
 <div class="text-center text-warning" ><br><h1>STUDENT REGISTER</h1></div>
 <?php
 
 if(isset($errorstring) && !empty($errorstring) && isset($_POST['submit'])){
  echo  "<span class='error'>";
    foreach($errorstring as $arrordata){
        echo  $arrordata; echo "</br>";
    }
    echo "</span>";
 }
 ?>
  <div class="mb-3">
    <label  class="form-label">Name</label>
    <input type="name"  name="name" class="form-control" id="name">
  </div>
  <div class="mb-3">
    <label  class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="email">
  </div>
  <div class="mb-3">
    <label  class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password">
  </div>
  <div class="mb-3">
    <label  class="form-label">Confirm Password</label>
    <input type="password" name="confirmpassword" class="form-control" id="confirmpassword">
  </div>
  <div class="mb-3">
    <label  class="form-label">Mobile</label>
    <input type="mobile" name="mobile" class="form-control" id="mobile">
  </div>
  <div class="mb-3">
    <label  class="form-label">Address</label>
    <input type="address"  name="address" class="form-control" id="address">
  </div>
  <div class="mb-3">
    <label  class="form-label">Class</label>
    <select class="form-control" name="class" id="class" required>
                    <option class="form-control" value="" selected hidden>Choose Option</option>
                    <option class="form-control" value="BCA">BCA</option>
                    <option class="form-control" value="BA">BA</option>
                    <option class="form-control" value="B.TECH">B.TECH</option>
                    <option class="form-control" value="B.COM">B.COM</option>
                </select>
  </div>
  <div class="mb-3">
    <label  class="form-label">Date Of Birth</label>
    <input type="date" name="dob" class="form-control" id="dob">
  </div>
  <div class="mb-3">
    <label  class="form-label">Profile Image</label>
    <input type="file" name="image" class="form-control" id="image">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>   <a  href="student_login.php">Login</a>
</form>
</div>


</body>
</html>