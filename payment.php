<?php
require_once('vendor/autoload.php');
// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys

$stripe = new \Stripe\StripeClient('sk_test_51MO02lEv2IUHcm73shBu9NxFdlmn2Dt952yHqzabXU8MufsmFnPWi4gQvweMIiDknNXzT6Snw1loZULqiQwlwsiZ00pQcSJfFB');

$paymentIntent = $stripe->paymentIntents->create(
   [
      'amount' => 1000,
      'currency' => 'myr',
      'automatic_payment_methods' => ['enabled' => true],
   ]
);

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Double Hilton Hotel</title>

   <!-- bootstrap css link  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="css/style.css"> -->
   <link rel="stylesheet" href="css/style1.css?v=<?php echo time(); ?>">

</head>

<body>

   <!-- header section starts  -->
   <section class="header">

      <a href="home.php" class="logo">Double Hilton Hotel</a>

      <nav class="navbar">
         <ul>
            <li><a href="package.php">Rooms</a></li>
            <li><a href="book.php">Reservation</a></li>
            <li><a href="reservationdetails.php">Reservation Details</a></li>
         </ul>
      </nav>

      <div id="menu-btn" class="fas fa-bars"></div>

   </section>

   <!-- header section ends -->

   <div class="heading" style="background:url(images/resort-night1.jpg) no-repeat">
      <h1>ROOMS</h1>
   </div>


   <!-- Payment section starts -->
   <section class="payment">

      <form id="payment-form" data-secret="<?= $paymentIntent->client_secret ?>">
         <div id="payment-element">
            <!-- Elements will create form elements here -->
         </div>

         <button id="submit">
            <div class="spinner hidden" id="spinner"></div>
            <span id="button-text">Pay now</span>
         </button>
         <div id="error-messages"></div>
      </form>

   </section>



   <!-- Payment section ends -->












   <!-- footer section starts  -->

   <section class="footer">

      <!-- <div class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
         <a href="book.php"> <i class="fas fa-angle-right"></i> book</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
         <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
         <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
         <a href="#"> <i class="fas fa-phone"></i> +111-222-3333 </a>
         <a href="#"> <i class="fas fa-envelope"></i> shaikhanas@gmail.com </a>
         <a href="#"> <i class="fas fa-map"></i> mumbai, india - 400104 </a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div> -->

      <div class="footer-name">
         <h1>Double Hilton Hotel</h1>
      </div>

      <div class="credit"> Copyright 2023 <span> Double Hilton Hotel </span> | All rights reserved! </div>

   </section>

   <!-- footer section ends -->








   <!-- JQUERY File -->
   <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script>
      // Set your publishable key: remember to change this to your live publishable key in production
      // See your keys here: https://dashboard.stripe.com/apikeys
      const stripe = Stripe('pk_test_51MO02lEv2IUHcm73UAtBpWL4HYNrJxatGw5p2mWM8nrQC69BmGaXiTxU6f30IjNwPf9aqaLmk0lQR63go0NkCPgL00yGGdhj9q');
      // const options = {
      //     clientSecret: '{{CLIENT_SECRET}}',
      // };

      // const appearance = {
      //     theme: 'stripe',

      //     variables: {
      //         colorPrimary: '#0570de',
      //         colorBackground: '#ffffff',
      //         colorText: '#30313d',
      //         colorDanger: '#df1b41',
      //         fontFamily: 'Ideal Sans, system-ui, sans-serif',
      //         spacingUnit: '2px',
      //         borderRadius: '4px',
      //         // See all possible variables below
      //     }
      // };
      // // Set up Stripe.js and Elements to use in checkout form, passing the client secret obtained in step 3
      // const elements = stripe.elements(options, appearance);

      // // Create and mount the Payment Element
      // const paymentElement = elements.create('payment');
      // paymentElement.mount('#payment-element');



      const elements = stripe.elements({
         clientSecret: '<?= $paymentIntent->client_secret ?>'
      });


      // Create an instance of the card Element
      const paymentElement = elements.create('payment', {
         layout: {
            type: 'tabs',
            defaultCollapsed: false,
         }
      })
      // Add an instance of the card Element into the `card-element` <div>
      paymentElement.mount('#payment-element');

      const form = document.getElementById('payment-form')
      form.addEventListener('submit', async (e) => {
         e.preventDefault();

         const {
            error
         } = await stripe.confirmPayment({
            elements,
            confirmParams: {
               return_url: "http://localhost/Web%20App%20Project/complete.php?"
            }
         })
         if (error) {
            const messages = document.getElementById('error-messages')
            messages.innerText = error.message;
         }
      })
   </script>


   <!-- swiper js link  -->
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

   <!-- custom js file link  -->
   <script src="js/script.js?v=<?php echo time(); ?>"></script>

   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>