
<!-- template page including different content depending on the called controller -->

<?php if(session_status() != PHP_SESSION_ACTIVE) session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="vendor/bootstrap.min.css" rel="stylesheet" />
        </head>
        
    <body>
        <?php if (isset($_SESSION['userInfo']['id'])) include 'view/frontend/navBar.php'; ?>
        <div><br><br></div>
        <div class="container"><?= $content ?></div>
        <script src="vendor/bootstrap.min.js"></script>
        <script src="vendor/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    </body>
</html>
