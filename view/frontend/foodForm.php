<!-- Form used to updated or create a new item -->

<?php 
    if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
    ob_start(); 
    $title = $formValues["formHeader"];
?>

<h2><?=$formValues["formHeader"]?></h2>
<form action="index.php?action=<?=$formValues["formAction"]?>" method="post">
    <div class="form-group">
        <?php
            foreach ( $data as $key => $value ) {
                echo "<div><label for={$key}>Aliment {$key}</label><br />";
                echo ($key === "name") ? "<input type=\"text\"" : "<input type=\"number\" class=\"form-control\" step=\"any\" min=0.01 max=500";
                echo "class=\"form-control\" id={$key} name={$key} value={$value} required/></div> ";
            }
        ?>
        <div hidden><input type="number" value=<?=$formValues["itemId"]?> name="foodId"></div>
    </div>
    <div>
        <a class="btn btn-outline-danger" href="./">Cancel</a>
        <input type="submit" class="btn btn-outline-success" value="Confirm"/>
    </div>
</form>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>