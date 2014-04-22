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
            <ul class="nav nav-pills pull-right">
              <li class="active"><a href="index.php">Cancel</a></li>
            </ul>
            <h3 class="text-muted">Add New</h3>
          </div>
    
          <div class="row marketing">
            <div class="col-lg-6">
              <a href="editContact.php?a=n"><h4>New Contact ></h4></a>
			  <a href="editGroup.php?a=n"><h4>New Group ></h4></a>
            </div>
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

