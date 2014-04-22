<?
    require_once('inc/config.php');
    
    require_once('inc/header.php');
      if(!isset($_SESSION['user']) || $_SESSION['user'] == "")
      {
        require_once('inc/login.php');
      }
      else
      {
          //this is supposed to get group member information [question mark]
          //ask Rebecca and have her correct me as I'm more than likely doing something wrong
          $theID = 1;
          $gname = $contacts->getGroupById($theID);
        ?>
          <div class="header">
            <ul class="nav nav-pills pull-right">
              <li class="active"><a href="index.php">Home</a></li>
            </ul>
            <h3 class="text-muted"><?=$gname['g_name']?></h3>
          </div>
    
          <?php
          echo $gname['g_name'] . "<br>";
          foreach($gname['members'] as $member)
          {
            echo $member[c_name]. "<br>";
          }
          
          
          ?>
    
          <div class="footer">
            <p>&copy; FMH 2014</p>
          </div>
        <?
      }
?>
      
<?
  require_once('inc/footer.php');
?>

