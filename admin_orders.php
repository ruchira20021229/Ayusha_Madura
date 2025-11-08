<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">placed orders</h1>

   <?php
   // Calculate statistics
   $total_orders = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `orders`"));
   $pending_orders = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'pending'"));
   $completed_orders = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'completed'"));
   ?>

   <div class="orders-stats">
      <div class="stat-card">
         <div class="stat-number"><?php echo $total_orders; ?></div>
         <div class="stat-label">Total Orders</div>
      </div>
      <div class="stat-card">
         <div class="stat-number stat-pending"><?php echo $pending_orders; ?></div>
         <div class="stat-label">Pending</div>
      </div>
      <div class="stat-card">
         <div class="stat-number stat-completed"><?php echo $completed_orders; ?></div>
         <div class="stat-label">Completed</div>
      </div>
   </div>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY id DESC") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <div class="order-header">
            <div class="order-id">
               <i class="fas fa-receipt"></i>
               Order #<?php echo $fetch_orders['id']; ?>
            </div>
            <div class="order-date">
               <i class="far fa-calendar"></i>
               <?php echo date('M d, Y', strtotime($fetch_orders['placed_on'])); ?>
            </div>
         </div>
         
         <div class="order-content">
            <!-- Customer Information -->
            <div class="info-section">
               <div class="section-title">
                  <i class="fas fa-user-circle"></i>
                  Customer Details
               </div>
               <div class="info-row">
                  <div class="info-label">
                     <i class="fas fa-user"></i>
                     Name
                  </div>
                  <div class="info-value"><?php echo $fetch_orders['name']; ?></div>
               </div>
               <div class="info-row">
                  <div class="info-label">
                     <i class="fas fa-phone"></i>
                     Phone
                  </div>
                  <div class="info-value"><?php echo $fetch_orders['number']; ?></div>
               </div>
               <div class="info-row">
                  <div class="info-label">
                     <i class="fas fa-envelope"></i>
                     Email
                  </div>
                  <div class="info-value"><?php echo $fetch_orders['email']; ?></div>
               </div>
               <div class="info-row">
                  <div class="info-label">
                     <i class="fas fa-map-marker-alt"></i>
                     Address
                  </div>
                  <div class="info-value"><?php echo $fetch_orders['address']; ?></div>
               </div>
            </div>

            <!-- Order Information -->
            <div class="info-section">
               <div class="section-title">
                  <i class="fas fa-shopping-cart"></i>
                  Order Information
               </div>
               <div class="info-row">
                  <div class="info-label">
                     <i class="fas fa-box"></i>
                     Products
                  </div>
                  <div class="info-value products-list"><?php echo $fetch_orders['total_products']; ?></div>
               </div>
               <div class="info-row">
                  <div class="info-label">
                     <i class="fas fa-dollar-sign"></i>
                     Total Price
                  </div>
                  <div class="info-value price-highlight">$<?php echo number_format($fetch_orders['total_price'], 2); ?></div>
               </div>
            </div>

            <!-- Payment Information -->
            <div class="info-section">
               <div class="section-title">
                  <i class="fas fa-credit-card"></i>
                  Payment Details
               </div>
               <div class="info-row">
                  <div class="info-label">
                     <i class="fas fa-wallet"></i>
                     Method
                  </div>
                  <div class="info-value">
                     <span class="payment-method-badge">
                        <i class="fas fa-money-check-alt"></i>
                        <?php echo ucfirst($fetch_orders['method']); ?>
                     </span>
                  </div>
               </div>
               <div class="info-row">
                  <div class="info-label">
                     <i class="fas fa-info-circle"></i>
                     Status
                  </div>
                  <div class="info-value">
                     <span class="payment-badge <?php echo $fetch_orders['payment_status']; ?>">
                        <?php 
                        if($fetch_orders['payment_status'] == 'pending') {
                           echo '<i class="fas fa-clock"></i> ';
                        } else {
                           echo '<i class="fas fa-check-circle"></i> ';
                        }
                        echo ucfirst($fetch_orders['payment_status']); 
                        ?>
                     </span>
                  </div>
               </div>
            </div>
         </div>
         
         <div class="order-actions">
            <form action="" method="post">
               <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
               <label class="action-label">
                  <i class="fas fa-edit"></i> Update Payment Status
               </label>
               <select name="update_payment" class="status-select <?php echo $fetch_orders['payment_status']; ?>">
                  <option value="" selected disabled>Choose Status</option>
                  <option value="pending">⏳ Pending</option>
                  <option value="completed">✓ Completed</option>
               </select>
               <div class="button-group">
                  <input type="submit" value="update" name="update_order" class="option-btn">
                  <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
               </div>
            </form>
         </div>
      </div>
      <?php
         }
      }else{
         echo '<div class="empty-orders"><i class="fas fa-box-open"></i><p>no orders placed yet!</p></div>';
      }
      ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

<script>
// Enhanced select styling based on value
document.querySelectorAll('select[name="update_payment"]').forEach(function(select) {
    function updateSelectStyle() {
        select.classList.remove('pending', 'completed');
        if (select.value === "pending") {
            select.classList.add('pending');
        } else if (select.value === "completed") {
            select.classList.add('completed');
        }
    }
    
    updateSelectStyle();
    select.addEventListener('change', updateSelectStyle);
});
</script>

</body>
</html>