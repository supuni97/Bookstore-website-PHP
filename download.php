<?php
require "includes/header.php";
require "config/config.php";

// Start the session to use session variables
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

try {
    // Fetch all products in the user's cart
    $select = $conn->prepare("SELECT * FROM CART WHERE user_id = :user_id");
    $select->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $select->execute();
    $allProducts = $select->fetchAll(PDO::FETCH_OBJ);
    
    if (empty($allProducts)) {
        die("No products found in cart");
    }
    
    // Create a zip file
    $zipname = 'bookstore.zip';
    $zip = new ZipArchive;
    
    if ($zip->open($zipname, ZipArchive::CREATE) !== TRUE) {
        die("Could not create zip file");
    }
    
    // Add each product file to the zip
    foreach ($allProducts as $product) {
        $filePath = "books/".$product->pro_file;
        if (file_exists($filePath)) {
            $zip->addFile($filePath, basename($filePath));
        } else {
            // Handle the case where the file does not exist
            error_log("File not found: " . $filePath);
        }
    }
    
    // Close the zip archive
    $zip->close();
    
    // Set headers to initiate file download
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $zipname . '"');
    header('Content-Length: ' . filesize($zipname));
    
    // Clear output buffer before reading the file
    ob_clean();
    flush();
    readfile($zipname);
    
    // Optionally delete the zip file after download
    unlink($zipname);
} catch (Exception $e) {
    // Handle any exceptions
    die("Error: " . $e->getMessage());
}
?>
