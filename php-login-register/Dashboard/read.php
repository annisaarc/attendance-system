<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div class="col-sm-7" align="right">
<a href="edit.php?editid=<?php echo htmlentities ($row['id']);?>" class="btn btn-primary"><span>Edit User Details</span></a>
</div>

<?php
include('dbconnection.php');
$vid=$_GET['viewid'];
$ret=mysqli_query($con,"SELECT * from users where id=$vid");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
 
?>
 <!-- component -->
<div class="w-2/3 mx-auto">
  <div class="bg-white shadow-md rounded my-6">
    <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
      <thead>
        <tr>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Foto</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">First Name</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Last Name</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Email</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Bio</th>
        </tr>
      </thead>
      <tbody>
        <tr class="hover:bg-grey-lighter">
          <td><img src="profilepics/<?php  echo $row['profilepic'];?>" width="80" height="80"></td>
            <td class="py-4 px-6 border-b border-grey-light"><?php  echo $row['first_name'];?></td>
            <td class="py-4 px-6 border-b border-grey-light"><?php  echo $row['last_name'];?></td>
            <td class="py-4 px-6 border-b border-grey-light"><?php  echo $row['email'];?></td>
            <td class="py-4 px-6 border-b border-grey-light"><?php  echo $row['bio'];?></td>
          </tr>
      </tbody>
        <?php 
  $cnt=$cnt+1;
  }?>
    </table>
  </div>
</div>

</body>
</html>
