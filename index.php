<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<?php

$rows = $conn->query("SELECT * FROM products WHERE status = 1 ");
$rows->execute();

$allRows = $rows->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Listing</title>
    <script type="text/javascript">
        function startDownload() {
            // Start the download in a hidden iframe
            var iframe = document.createElement("iframe");
            iframe.style.display = "none";
            iframe.src = "download.php"; // URL to the PHP script handling the zip download
            document.body.appendChild(iframe);

            // Redirect after a short delay
            setTimeout(function() {
                window.location.href = "index.php";
            }, 3000); // 3-second delay to allow download to start
        }
    </script>
</head>
<body>
    <div class="row mt-5">
        <?php foreach ($allRows as $product) : ?>
            <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1">
                <div class="card">
                    <img height="213px" class="card-img-top" src="images/<?php echo $product->image; ?>">
                    <div class="card-body">
                        <h5 class="d-inline"><b><?php echo $product->name; ?></b></h5>
                        <h5 class="d-inline">
                            <div class="text-muted d-inline">($<?php echo $product->price; ?>/item)</div>
                        </h5>
                        <p><?php echo substr($product->description, 0, 120) ?> </p>
                        <a href="http://localhost:3000/shopping/single.php?id=<?php echo $product->id; ?>" class="btn btn-primary w-100 rounded my-2"> More<i class="fas fa-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
            <br>
        <?php endforeach; ?>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <button onclick="startDownload()" class="btn btn-success">Download All Products</button>
        </div>
    </div>
</body>
</html>

<?php require "includes/footer.php"; ?>
