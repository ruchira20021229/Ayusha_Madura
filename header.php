<?php

include 'config.php';

$user_id = 0;
$user_name = '';
$user_email = '';

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    // Fetch current user data from database
    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($select_user) > 0){
        $row = mysqli_fetch_assoc($select_user);
        $user_name = $row['name'];
        $user_email = $row['email'];
        $_SESSION['user_name'] = $user_name; // Update session with current values
        $_SESSION['user_email'] = $user_email;
    }
}

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="https://www.facebook.com/100076641789742/videos/dilrukshi-ayurgha-wedamedura-ampegama-road-ethkandure-call-for-appointments-0764/990237876394225/" target="_blank" class="fab fa-facebook-f"></a>
            <a href="https://indianvaidyas.com/news" target="_blank" class="fab fa-twitter"></a>
            <a href="https://ayushcare.in/?srsltid=AfmBOorn7dstoz2wxTSh0389zIjjdeAg4j9iMBN0vnN-LV6o3iIX6YoH" target="_blank" class="fab fa-instagram"></a>
            <a href="https://in.linkedin.com/in/sujal-parekh-13957961" target="_blank" class="fab fa-linkedin"></a>
         </div>
         <!--<p> new <a href="login.php">login</a> | <a href="register.php">register</a> </p>-->
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <img src="images/logohead4.png" alt="Your Brand Logo" height =60 , width = 60 >
         <a href="home.php" class="logo">Aayusa Madura</a>

         <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="shop.php">Shop</a>
            <a href="contact.php">Contact</a>
            <a href="orders.php">Orders</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>username : <span><?php echo $user_name; ?></span></p>
            <p>email : <span><?php echo $user_email; ?></span></p>
            <a href="change_username.php" class="btn">Change Username</a>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
      </div>
   </div>

</header>