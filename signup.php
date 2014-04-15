<?
    require_once('inc/config.php');
    
    require_once('inc/header.php');
 ?>
            <form class="form-signin" role="form" action="aj.php?action=signup" method="post">
                    <h2 class="form-signin-heading">Please Sign Up</h2>
                    <input name="fname"     type="text" class="form-control" placeholder="First Name" required autofocus>
                    <input name="lname"     type="text" class="form-control" placeholder="Last Name" required>
                    <input name="username"  type="text" class="form-control" placeholder="Username" required>
                    <input name="psw"       type="password" class="form-control" placeholder="Password" required>
                    <input name="cpsw"      type="password" class="form-control" placeholder="Confirm Password" required>
                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
            </form>
<?
  require_once('inc/footer.php');
?>

