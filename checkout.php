<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         // Reduce product quantity in stock
         $cart_query2 = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         while($cart_item2 = mysqli_fetch_assoc($cart_query2)){
            $product_name = $cart_item2['name'];
            $product_quantity = $cart_item2['quantity'];
            mysqli_query($conn, "UPDATE `products` SET quantity = quantity - $product_quantity WHERE name = '$product_name'") or die('query failed');
         }
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">home</a> / checkout </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo 'RS. '.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span>RS. <?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required pattern="[0-9]{10}" maxlength="10"  required placeholder="enter your phone number"  inputmode="numeric"
         oninput="this.value = this.value.replace(/\D/g, '').slice(0,10);">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>Province :</span>
            <input type="text" name="street" required placeholder="e.g. Western">
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. Horana">
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" required placeholder="e.g. Gonapala">
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" required placeholder="e.g. Srilanka">
         </div>
         <div class="inputBox">
            <span>postal code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>
/*
  Save/load checkout form values to localStorage per user account.
  Key used: "checkout_<user_id>"
*/
(function(){
  const userId = <?php echo json_encode($user_id); ?>;
  if(!userId) return;
  const storageKey = 'checkout_' + userId;
  const form = document.querySelector('section.checkout form');
  if(!form) return;

  const fields = ['name','number','email','method','flat','street','city','state','country','pin_code'];

  // Load saved values (if any)
  try{
    const saved = JSON.parse(localStorage.getItem(storageKey) || '{}');
    fields.forEach(name=>{
      const el = form.querySelector('[name="'+name+'"]');
      if(el && saved[name] !== undefined && saved[name] !== null) el.value = saved[name];
    });
  }catch(e){
    console.warn('checkout localStorage read error', e);
  }

  // Save helper (debounced)
  let timer;
  function save(){
    const data = {};
    fields.forEach(name=>{
      const el = form.querySelector('[name="'+name+'"]');
      if(el) data[name] = el.value;
    });
    try{
      localStorage.setItem(storageKey, JSON.stringify(data));
    }catch(e){
      console.warn('checkout localStorage write error', e);
    }
  }
  function scheduleSave(){
    clearTimeout(timer);
    timer = setTimeout(save, 250);
  }

  // Add listeners to inputs/selects to auto-save
  fields.forEach(name=>{
    const el = form.querySelector('[name="'+name+'"]');
    if(!el) return;
    el.addEventListener('input', scheduleSave);
    el.addEventListener('change', scheduleSave);
  });

  // Ensure we save on submit as well (before navigation)
  form.addEventListener('submit', function(){
    save();
    // do not clear storage here so values persist for future orders;
    // if you want to clear after a successful order, backend redirect page can trigger clearing.
  });
})();
</script>

</body>
</html>