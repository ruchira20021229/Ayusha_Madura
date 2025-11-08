<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/herbal.jpg" alt="">
      </div>

      <div class="content">
         <h3>About Us</h3>
         <p>Begin your transformative and restorative journey at Aayusha Madura Ayurveda. We are dedicated to providing you with a completely personalised and immersive healing experience that is best suited to your individual needs.</p>
         <p>By combining the ancient science of Ayurveda with traditional Sri Lankan medicine of Hela Wedakama, we offer a effective treatment programme that will rebalance and rejuvenate mind and body.  </p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/Kalam.jpg" alt="">
         <p>“Dr. Kalam believed that when you make it a daily habit to dream big, and uplift others with kindness, your life becomes a shining light of purpose that even time cannot dim.”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3> Dr. Kalam </h3>
      </div>

      <div class="box">
         <img src="images/mother teresa.jpg" alt="">
         <p>“Even in the poorest corners of the world, she showed that inner peace, emotional health, and daily compassion can sustain a person more than wealth or comfort ever could.”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3> Mother Teresa </h3>
      </div>

      <div class="box">
         <img src="images/paul farmer.jpeg" alt="">
         <p>“A healthy life begins when we not only take care of our own well-being but also make it a habit to bring healing to this was the lifelong commitment that strong in both heart and spirit”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3> Dr. Paul Farmer </h3>
      </div>

      <div class="box">
         <img src="images/mahatma gandi.jpeg" alt="">
         <p>“When you build your life on habits of nonviolence, truth, simplicity, and daily discipline—like Gandhi—you create not just peace around you, transforming your life into a journey of meaning, change, and lasting respect.”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3> Mahatma Gandhi </h3>
      </div>

      <div class="box">
         <img src="images/florence.jpg" alt="">
         <p>“The habit of serving others in silence, even in the darkest hours, turns an ordinary life into an extraordinary legacy—as Florence Nightingale to the care of the suffering, showing that kindness and courage can heal both wounds and history.”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3> Florence Nightingale </h3>
      </div>

      <div class="box">
         <img src="images/nelson.jpg" alt="">
         <p>“In prison, Mandela kept his health by exercising every morning, reading every day, and holding on to hope—his life teaches us that mental and physical strength grow from consistent good habits, even in hard times.”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3> Nelson Mandela </h3>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title"> Our Doctors</h1>
   <p class="para"> Our team of highly specialised doctors will be at the centre of your stay with us. Ayurveda, which roughly translates to ‘the Science of Life’, is a holistic medical practice that aims to bring a sense of balance to your life.</p>
   <br><br>
   <div class="box-container">

      <div class="box">
         <img src="images/kasun gunawardhana.jpeg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Dr. Kasun Gunawardhana</h3>
      </div>

      <div class="box">
         <img src="images/DR Gayani.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Dr. Gayani</h3>
      </div>

      <div class="box">
         <img src="images/image2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Dr. Vishwabandhu Sharma</h3>
      </div>

      <div class="box">
         <img src="images/image3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Dr. Shantha Senevirathna</h3>
      </div>

      <div class="box">
         <img src="images/image4.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Dr. Chathuri Mihirani</h3>
      </div>

      <div class="box">
         <img src="images/image6.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Dr. S.S Gunawardhana</h3>
      </div>

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>


