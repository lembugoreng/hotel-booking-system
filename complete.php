<?php
require_once('vendor/autoload.php');
// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys

$stripe = new \Stripe\StripeClient('sk_test_51MO02lEv2IUHcm73shBu9NxFdlmn2Dt952yHqzabXU8MufsmFnPWi4gQvweMIiDknNXzT6Snw1loZULqiQwlwsiZ00pQcSJfFB');
$paymentIntent = $stripe->paymentIntents->retrieve($_GET["payment_intent"]);
$custId =  $paymentIntent->id;
$custAmount = $paymentIntent->amount;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Sample</title>
</head>
<body>
    <main>
        <h1>Complete</h1>

        <pre><?= json_encode($paymentIntent,JSON_PRETTY_PRINT)?></pre>
        <p><?php echo $custId; echo $custAmount     ?></p>
    </main>
</body>
</html>