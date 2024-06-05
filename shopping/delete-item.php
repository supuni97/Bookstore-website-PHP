<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location: http://localhost:3000/bookstore'));
}
?>

<?php

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $delete = $conn->prepare("DELETE FROM cart WHERE id='$id'");
    $delete->execute();
}


if (isset($_SESSION['username'])) {
  header("location:".APPURL."");
}

?>

<?php require "../includes/footer.php"; ?>
