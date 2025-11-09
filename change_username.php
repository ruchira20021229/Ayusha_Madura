<?php
include 'config.php';
session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$current_username = '';

// Fetch current username
$result = mysqli_query($conn, "SELECT name FROM `users` WHERE id = '$user_id'") or die('query failed');
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $current_username = $row['name'];
}

if(isset($_POST['submit'])){
    $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);
    
    // Check if new username already exists
    $check_username = mysqli_query($conn, "SELECT * FROM `users` WHERE name = '$new_username' AND id != '$user_id'") or die('query failed');
    
    if(mysqli_num_rows($check_username) > 0){
        $message[] = 'Username already exists!';
    }else{
        // Update username
        mysqli_query($conn, "UPDATE `users` SET name = '$new_username' WHERE id = '$user_id'") or die('query failed');
        $_SESSION['user_name'] = $new_username;
        $message[] = 'Username updated successfully!';
        header('location:change_username.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Change Username</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="form-container">
   <form action="" method="post">
      <h3>Change Username</h3>
      <div class="current-username">
         <p>Current Username: <strong><?php echo $current_username; ?></strong></p>
      </div>
      <input type="text" name="new_username" placeholder="Enter new username" required class="box">
      <input type="submit" name="submit" value="Update Username" class="btn">
      <a href="home.php" class="option-btn">Go Back</a>
   </form>
</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>