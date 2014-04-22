<?
    require_once('inc/config.php');
    
    require_once('inc/header.php');
      if(!isset($_SESSION['user']) || $_SESSION['user'] == "")
      {
        require_once('inc/login.php');
      }
      else
      {
        ?>
          <div class="header">
			<h3 class="text-muted pull-left">Add Contact</h3>
            <ul class="nav nav-pills pull-right">
              <li><a href="#">Cancel</a></li>
              <li><a id="save" href="#">Save</a></li>
            </ul> 
          </div>
    
			<div class="row marketing">
				<form>
					<div>
					Image:
					</div>
					<div>
					Fname:
					MI:
					Lname:
					</div>
					<div>
					Phone:
					</div>
					<div>
					Email:
					</div>
					<div>
					Address:
					</div>
					<div>
					URL:
					</div>
				</form>
			 </div>
    
          <div class="footer">
            <p>&copy; Company 2014</p>
          </div>
        <?
      }
?>
      
<?
  require_once('inc/footer.php');
?>

