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
    <title>Stripe Custom Payment Flow</title>

</head>

<body>

    <form id="payment-form" data-secret="<?= $paymentIntent->client_secret ?>">
        <div id="link-authentication-element">
            <!--Stripe.js injects the Link Authentication Element-->
        </div>
        <div id="payment-element">
            <!-- Elements will create form elements here -->
        </div>

        <button id="submit">Pay</button>
    </form>



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

        //Create an instance of linkelement
        const linkAuthenticationElement = elements.create("linkAuthentication");
        linkAuthenticationElement.mount("#link-authentication-element");

        // Create an instance of the card Element
        const paymentElement = elements.create('payment', {
            layout: {
                type: 'tabs',
                defaultCollapsed: false,
            }
        })
        // Add an instance of the card Element into the `card-element` <div>
        paymentElement.mount('#payment-element');
    </script>

</body>

</html>