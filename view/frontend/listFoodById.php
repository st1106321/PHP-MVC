<!-- Descriptive page for a specific item -->

<?php $title = 'My home page'; ?>
<?php ob_start(); ?>

<h3>Description</h3>
<?php
    if ($foodById->num_rows > 0) {
        if ( $data = $foodById->fetch_assoc() ) {
?>
<div>
    <em>The <b><?= $data['name'] ?></b> has </em>
    <?= nl2br(htmlspecialchars($data['kcal'])) ?> Kcal.
</div>
<?php
        }
    }
    $foodById->close();
?>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>