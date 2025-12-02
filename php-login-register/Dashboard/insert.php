<?php 
//Databse Connection file
include('dbconnection.php');
if(isset($_POST['submit']))
  {
  	//getting the post values
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $bio=$_POST['bio'];
   $ppic=$_FILES["profilepic"]["name"];
// get the image extension
$extension = substr($ppic,strlen($ppic)-4,strlen($ppic));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file
$imgnewfile=md5($ppic).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["profilepic"]["tmp_name"],"profilepics/".$imgnewfile);
// Query for data insertion
$query=mysqli_query($con, "insert into users(first_name,last_name, email,bio,profilepic)value('$fname','$lname','$email', '$bio','$imgnewfile' )");
if ($query) {
echo "<script>alert('You have successfully inserted the data');</script>";
echo "<script type='text/javascript'> document.location ='index.php'; </script>";
} else{
echo "<script>alert('Something Went Wrong. Please try again');</script>";
}}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>
<!-- component -->
<div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
  <div class="container max-w-screen-lg mx-auto">
    <div>
      <h2 class="font-semibold text-xl text-gray-600">Project Bncc</h2>
      <p class="text-gray-500 mb-6">Wellcome to Dashboard</p>

     <form method="POST" enctype="multipart/form-data">
     <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
          <div class="text-gray-600">
            <p class="font-medium text-lg">ADD USER</p>
            <p>Please fill out all the fields.</p>
          </div>

          <div class="lg:col-span-2">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
              <div class="md:col-span-5">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="f_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""  required="true"/>
              </div>

              <div class="md:col-span-5">
                <label for="l_name">last Name</label>
                <input type="text" name="lname" id="l_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""  required="true"/>
              </div>

              <div class="md:col-span-5">
                <label for="email">Email Address</label>
                <input type="text" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="email@domain.com"  required="true"/>
              </div>

              <div class="form-group">
              <label for="email">Foto</label>
                <input type="file" class="h-10 border  rounded w-full bg-gray-50" name="profilepic"  required="true">
                <span style="color:red; font-size:12px;">Only jpg / jpeg/ png /gif format allowed.</span>
            </div> 

            <div class="form-group">
            <label for="email">Bio</label>
                <input type="text" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" name="bio" placeholder="Enter your bio" required="true" maxlength="10"  required="true">
            </div>
      
              <div class="md:col-span-5 text-right">
                <div class="inline-flex items-end">
                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" name="submit">Submit</button>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
     </form>
    </div>

    <a href="https://www.buymeacoffee.com/dgauderman" target="_blank" class="md:absolute bottom-0 right-0 p-4 float-right">
      <img src="https://www.buymeacoffee.com/assets/img/guidelines/logo-mark-3.svg" alt="Buy Me A Coffee" class="transition-all rounded-full w-14 -rotate-45 hover:shadow-sm shadow-lg ring hover:ring-4 ring-white">
    </a>
  </div>
</div>
</form>
</body>
</html>