<?php 
//Database Connection
include('dbconnection.php');
if(isset($_POST['submit']))
  {
$uid=$_GET['userid'];
//getting the post values
$ppic=$_FILES["profilepic"]["name"];
$oldppic=$_POST['oldpic'];
$oldprofilepic="profilepics"."/".$oldppic;
// get the image extension
$extension = substr($ppic,strlen($ppic)-4,strlen($ppic));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}else{
//rename the image file
$imgnewfile=md5($ppic).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["profilepic"]["tmp_name"],"profilepics/".$imgnewfile);
// Query for data insertion
$query=mysqli_query($con, "update users set ProfilePic='$imgnewfile' where id='$uid' ");
if ($query) {
//Old pic deletion
unlink($oldprofilepic);
echo "<script>alert('Profile pic updated successfully');</script>";
echo "<script type='text/javascript'> document.location ='index.php'; </script>";
}else{
echo "<script>alert('Something Went Wrong. Please try again');</script>";
 }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chance Image</title>
</head>
<body>
<form  method="POST" enctype="multipart/form-data">
<?php
$eid=$_GET['userid'];
$ret=mysqli_query($con,"select * from users where id='$eid'");
while ($row=mysqli_fetch_array($ret)) {
?>
 
<h2>Update </h2>
<p class="hint-text">Update your profile pic.</p>
<input type="hidden" name="oldpic" value="<?php  echo $row['profilepic'];?>">
<div class="form-group">
<img src="profilepics/<?php  echo $row['profilepic'];?>" width="120" height="120">
</div>
 
<div class="form-group">
<input type="file" class="form-control" name="profilepic"  required="true">
<span style="color:red; font-size:12px;">Only jpg / jpeg/ png /gif format allowed.</span>
</div> 
 
<div class="form-group">
<button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Update</button>
</div>
<?php }?>
</body>
</html>