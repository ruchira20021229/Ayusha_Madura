<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">Feedbacks</h1>

   <div class="box-container">
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message` ORDER BY id DESC") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
   ?>
   <div class="box">
      <div class="message-header">
         <div class="message-icon">
            <i class="fas fa-envelope"></i>
         </div>
         <div class="message-id">Feedback #<?php echo $fetch_message['id']; ?></div>
      </div>
      
      <div class="message-content">
         <div class="info-row">
            <div class="info-label">
               <i class="fas fa-id-badge"></i>
               User ID
            </div>
            <div class="info-value"><?php echo $fetch_message['user_id']; ?></div>
         </div>
         
         <div class="info-row">
            <div class="info-label">
               <i class="fas fa-user"></i>
               Name
            </div>
            <div class="info-value"><?php echo $fetch_message['name']; ?></div>
         </div>
         
         <div class="info-row">
            <div class="info-label">
               <i class="fas fa-phone"></i>
                Tell Number
            </div>
            <div class="info-value"><?php echo $fetch_message['number']; ?></div>
         </div>
         
         <div class="info-row">
            <div class="info-label">
               <i class="fas fa-envelope"></i>
               Email
            </div>
            <div class="info-value"><?php echo $fetch_message['email']; ?></div>
         </div>
         
         <div class="message-text">
            <div class="message-text-label">
               <i class="fas fa-comment-dots"></i>
               Feedback
            </div>
            <div class="message-text-content"><?php echo $fetch_message['message']; ?></div>
         </div>
      </div>
      
      <!-- <div class="message-actions">
         <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">
            <i class="fas fa-trash"></i> delete message
         </a>
      </div> -->
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">you have no messages!</p>';
   }
   ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>