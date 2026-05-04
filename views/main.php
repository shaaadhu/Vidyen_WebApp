<?php include 'header.php'; ?>

<main>
    <?php 
    if (file_exists($file)) {
        require_once $file;
    }
    ?>
</main>

<?php include 'footer.php'; ?>





