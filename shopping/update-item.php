<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location: http://localhost:3000/bookstore'));
}
?>

<?php

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $pro_amount = $_POST['pro_amount'];

    $update = $conn->prepare("UPDATE cart SET pro_amount='$pro_amount' WHERE id='$id' ");
    $update->execute();
}

?>

<?php require "../includes/footer.php"; ?>
