<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title">user accounts</h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         if(mysqli_num_rows($select_users) > 0){
            while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <div class="user-header">
            <div class="user-avatar">
               <i class="fas fa-user-circle"></i>
            </div>
            <div class="user-type-badge <?php echo $fetch_users['user_type']; ?>">
               <?php 
               if($fetch_users['user_type'] == 'admin'){
                  echo '<i class="fas fa-shield-alt"></i> Admin';
               } else {
                  echo '<i class="fas fa-user"></i> User';
               }
               ?>
            </div>
         </div>
         
         <div class="user-content">
            <div class="info-row">
               <div class="info-label">
                  <i class="fas fa-id-badge"></i>
                  User ID
               </div>
               <div class="info-value"><?php echo $fetch_users['id']; ?></div>
            </div>
            
            <div class="info-row">
               <div class="info-label">
                  <i class="fas fa-user"></i>
                  Username
               </div>
               <div class="info-value"><?php echo $fetch_users['name']; ?></div>
            </div>
            
            <div class="info-row">
               <div class="info-label">
                  <i class="fas fa-envelope"></i>
                  Email
               </div>
               <div class="info-value"><?php echo $fetch_users['email']; ?></div>
            </div>
         </div>
         
         <div class="user-actions">
            <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">
               <i class="fas fa-trash"></i> delete user
            </a>
         </div>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">no users found!</p>';
         }
      ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>