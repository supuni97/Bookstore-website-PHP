<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php require "../vendor/autoload.php"; ?>

<?php session_start(); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location: http://localhost:3000/bookstore'));
}

if (isset($_SESSION['username'])) {
    header("location:" .APPURL. "");
}

if (isset($_POST['email'])) {

    \Stripe\Stripe::setApiKey($secret_key);

    $charge = \Stripe\Charge::create([

        'source' => $_POST['stripeToken'],
        'amount' => $_SESSION['price'] * 100,
        'currency' => 'usd',

    ]);

    echo "paid";

    if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['fname']) || empty($_POST['lname'])) {

        echo "<script>alert('One or more inputs are empty');</script>";
    } else {

        $email = $_POST['email'];
        $username = $_POST['username'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $price = $_SESSION['price'];
        $token = $_POST['stripeToken'];
        $user_id = $_SESSION['user_id'];

        $insert = $conn->prepare("INSERT INTO orders (email, username, fname, lname, token, price, user_id) VALUES (:email, :username, :fname, :lname, :token, :price, :user_id)");
        $insert->execute([
            'email' => $email,
            'username' => $username,
            'fname' => $fname,
            'lname' => $lname,
            'token' => $token,
            'price' => $price,
            'user_id' => $user_id,
        ]);

        header("location: http://localhost:3000/download.php");
    }
}
?>
