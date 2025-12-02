<?php 
//Database Connection
include('dbconnection.php');
if(isset($_POST['submit']))
  {
  $eid=$_GET['editid'];
  //Getting Post Values
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $bio=$_POST['bio'];
 
//Query for data updation
$query=mysqli_query($con, "UPDATE users set first_name='$fname',last_name='$lname', Email='$email', bio='$bio' where ID='$eid'");
 
if ($query) {
echo "<script>alert('You have successfully update the data');</script>";
echo "<script type='text/javascript'> document.location ='index.php'; </script>";
}
else
{
echo "<script>alert('Something Went Wrong. Please try again');</script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<!-- component -->
<div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
  <div class="container max-w-screen-lg mx-auto">
    <div>
      <h2 class="font-semibold text-xl text-gray-600">Project Bncc</h2>
      <p class="text-gray-500 mb-6">Wellcome to edit page.</p>

   <form method="POST">
   <?php
$eid=$_GET['editid'];
$ret=mysqli_query($con,"select * from users where id='$eid'");
while ($row=mysqli_fetch_array($ret)) {
?>
   <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
          <div class="text-gray-600">
            <p class="font-medium text-lg">EDIT USER</p>
            <p>Please fill out all the fields.</p>
          </div>

            
          <div class="lg:col-span-2">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
              <div class="md:col-span-5">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="f_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="<?php  echo $row['first_name'];?>"  required="true"/>
              </div>

              <div class="md:col-span-5">
                <label for="l_name">last Name</label>
                <input type="text" name="lname" id="l_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="<?php  echo $row['last_name'];?>"  required="true"/>
              </div>

              <div class="md:col-span-5">
                <label for="email">Email Address</label>
                <input type="text" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="<?php  echo $row['email'];?>"  placeholder="email@domain.com"  required="true"/>
              </div>

              <div class="form-group">
              <label for="foto">Foto</label>
                <img src="profilepics/<?php  echo $row['profilepic'];?>" width="120" height="120">
                <a href="change-image.php?userid=<?php echo $row['id'];?>">Change Image</a>
                </div>

            <div class="form-group">
            <label for="email">Bio</label>
                <input type="text" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" name="bio" placeholder="Enter your bio" required="true" value="<?php  echo $row['bio'];?>" maxlength="10" >
            </div>
            <?php 
}?>
              <div class="md:col-span-5 text-right">
                <div class="inline-flex items-end">
                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" name="submit">Submit</button>
                </div>
              </div>

            </div>

        </div>
      </div>
   </form>
    </div>


</div>
</body>
</html>