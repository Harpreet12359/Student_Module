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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Student Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</head>
<body>

<button type="submit" name="submit" class="btn btn-danger"><a  href="student_logout.php">Logout</a></button>

<?php
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
    <tr class="text-center"> 
<div class="container">
<div class="col-lg-12">

<h1 class="text-warning text-center">Display Student Info</h1>
<table class="table table-striped table-hover table-bordered">
<tr class="bg-black text-center">
  <tr>
    <th>Student Name</th>
    <td><?php echo $rows['s_name']; ?></td></tr>
    <th>Student Email</th>
    <td><?php echo $rows['s_email']; ?> </td></tr>
    <th>Student Mobile</th>
    <td><?php echo $rows['mobile']; ?> </td></tr>
    <th>Student Address</th>
    <td><?php echo $rows['address']; ?> </td></tr>
    <th>Student Class</th>
    <td><?php echo $rows['class']; ?></td></tr>
    <th>Student Date Of Birth</th>
    <td><?php echo $rows['dob']; ?></td></tr> 
</table>
<br>
<button type="submit" name="submit" class="btn-warning btn text-white"><a href="edit_profile.php?id=<?php echo $rows['s_id'];?>">Edit Profile</a></button> 

</div>
</div>
    
</body>
</html>