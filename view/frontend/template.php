
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
    </body>
</html>
