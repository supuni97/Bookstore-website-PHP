<?php
require "../includes/header.php";
require "../config/config.php";
require "../vendor/autoload.php";

// Ensure the session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['stripeToken']) && isset($_SESSION['price'])) {
    // Set the secret key securely
    \Stripe\Stripe::setApiKey($secret_key);

    try {
        // Create the charge
        $charge = \Stripe\Charge::create([
            'source' => $_POST['stripeToken'],
            'currency' => 'usd',
            'amount' => $_SESSION['price'] * 100, // Ensure price is in the session and multiplied by 100 for cents
        ]);

        // Successful charge
        echo "paid";
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Handle the error
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Error: Stripe token or session price not set.';
}
?>
