<?php
session_start();
//database conection  file
include('dbconnection.php');
//Code for deletion
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$profilepic=$_GET['ppic'];
$ppicpath="profilepics"."/".$profilepic;
$sql=mysqli_query($con,"delete from users where id=$rid");
unlink($ppicpath);
echo "<script>alert('Data deleted');</script>"; 
echo "<script>window.location.href = 'index.php'</script>";     
} 

require_once("../auth.php"); 

// if(empty($_SESSION["id_user"]) == "") {
//   header("Location: ../index.php");
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
  <p>Nama: <?php echo htmlspecialchars($_SESSION["user"]["name"]); ?></p>
   <p>Email: <?php echo htmlspecialchars($_SESSION["user"]["email"]); ?></p>
  </a>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      <a href="../logout.php" class="btn btn-primary">Logout</a>
      </li>
      <li class="nav-item">
      </li>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0 px-20">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
</nav>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
<body>

<!-- component -->
<div class="w-2/3 mx-auto">
  
  <div class="bg-white shadow-md rounded my-6">
    <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
      <thead>
        <tr>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">No</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Foto</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">name</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Bio</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
        include('dbconnection.php');
        $ret=mysqli_query($con,"select * from users");
        $cnt=1;
        $row=mysqli_num_rows($ret);
        if($row>0){
        while ($row=mysqli_fetch_array($ret)) {
        
        ?>
        <tr class="hover:bg-grey-lighter">
        <td class="py-4 px-6 border-b border-grey-light"><?php echo $cnt;?></td>
        <td class="py-4 px-6 border-b border-grey-light"><img src="profilepics/<?php  echo $row['profilepic'];?>" width="80" height="80"></td>
        <td class="py-4 px-6 border-b border-grey-light"><?php  echo $row['first_name'];?> <?php  echo $row['last_name'];?></td>
        <td class="py-4 px-6 border-b border-grey-light"><?php  echo $row['email'];?></td>                        
        <!-- <td><?php  echo $row['bio'];?></td> -->
          <td class="py-4 px-6 border-b border-grey-light">
            <a href="read.php?viewid=<?php echo htmlentities ($row['id']);?>" class="view text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
            
            <a href="edit.php?editid=<?php echo htmlentities ($row['id']);?>" class="edit text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>

            <a href="index.php?delid=<?php echo  ($row['id']);?>&&ppic=<?php echo $row['profilepic'];?>" class="delete text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark" title="Delete" data-toggle="tooltip" onclick="return confirm('Do you really want to Delete ?');"><i class="material-icons">&#xE872;</i></a>
          </td>
        </tr>
        <?php 
        $cnt=$cnt+1;
        } } else {?>
        <tr>
        <th style="text-align:center; color:red;" colspan="6">No Record Found</th>
        </tr>
        <?php } ?>   
      </tbody>
    </table>
  </div>
  <div class="col-sm-7" align="right">
                        <a href="insert.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-decoration:none"><span class="font-medium text-white pb-3">Add New User</span></a>     
                    </div>
</div>


</body>
</html>


<script type="module" src="">
  // Initialization for ES Users
import {
  Collapse,
  Ripple,
  initTE,
} from "tw-elements";

initTE({ Collapse, Ripple });
</script>