<!-- Adaptive login reform can be used to login and register depending on the values sent by the controller  -->

<?php $title = $loginValues["formHeader"]; ?>
<?php ob_start(); ?>

<div class="card">
    <h2><?=$loginValues["formHeader"]?></h2>
    <form action="index.php?action=<?=$loginValues["formAction"]?>" method="post">
        <div class="form-group">
            <div>
                <label for="userEmail">Email:</label><br />
                <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder='email' required/>
            </div>
            <div>
                <label for="userPswd">Password:</label><br />
                <input type="password" class="form-control" id="foodKcal" name="userPswd" placeholder='password' required/>
            </div>
        </div>
        <div>
            <input type="submit" class="btn btn-outline-success" value="<?=$loginValues["formHeader"]?>"/>
            <?php if ($loginValues["formHeader"] == "Login"): ?>
                <a class="btn btn-outline-secondary" href="index.php?action=userRegisterForm">Register</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>