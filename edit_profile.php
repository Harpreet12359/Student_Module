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
    // session_start(); 

    session_start();
    $id = $_GET['id'];
    
    if(isset($_SESSION['user'])){
   
        if($_SESSION['user'] == $id){
            echo "valid user";
        }
    }else{
        echo "Please login";
        header('Location: student_login.php');
    }
    $sql = "select * from student where s_id = $id";
    // print_r($sql);die('test');
    $query = mysqli_query($conn , $sql);
    $rows = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT PROFILE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</head>
<body>
    <button type="submit" name="submit" class="btn btn-danger"><a  href="student_logout.php">Logout</a></button>
<div class="container" >
<form action="edit_profile.php" method="POST" enctype="multipart/form-data">
 <div class="text-center text-warning" ><br><h1>EDIT PROFILE</h1></div>

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
    <input type="name"  name="name" class="form-control" id="name" value="<?php echo (isset($rows['s_name']))? $rows['s_name'] : '' ?>">
  </div>

  <div class="mb-3">
    <label  class="form-label">Mobile</label>
    <input type="mobile" name="mobile" class="form-control" id="mobile" value="<?php echo (isset($rows['mobile']))? $rows['mobile'] : '' ?>">
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
  <button type="update" name="update" class="btn btn-primary">Update</button>

</form>

<?php
$error = 0;
$errorstring =array();
if(isset($_POST['update'])){
    $s_name = $_POST['name'];

    if($_sname == '' || empty($s_name)){
        $error = 1;
        $errorstring[] = "Student Name is Invalid";
    }

    $s_mobile = $_POST['mobile'];

    if($s_mobile == '' || empty($s_mobile)){
        $error = 1;
        $errorstring[] ="Student Mobile Number is Invalid";
    }

    if(!empty($s_mobile) && (strlen($s_mobile)<10 || strlen($s_mobile)>15)){
        $error =1;
        $errorstring[] = "length of mobile should be between 2 to 20 characters";
    }

    $s_address = $_POST['address'];

    if($s_address == '' || empty($s_address)){
        $error = 1;
        $errorstring[] ="Student Address is Invalid";
    }

    $s_class = $_POST['class'];

    $s_dob = $_POST['dob'];
    if($s_dob == '' || empty($s_dob)){
        $error = 1;
        $errorstring[] ="Student Date Of Birth is Invalid";
    }

    $s_image = $_FILES['image'];

    if(isset($_FILES['image'])){

        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
     
        move_uploaded_file($file_tmp,"images/".$file_name);
        }

    $sql = "UPDATE `student` SET `s_name`='$s_name',`mobile`='$s_mobile',`address`='$s_address',`class`='$s_class',`dob`='$s_dob',`image`='$file_name' WHERE 1";
    $query = mysqli_query($conn , $sql);

    header("location:./student_info.php");
}
?>
</div>
</body>
</html>