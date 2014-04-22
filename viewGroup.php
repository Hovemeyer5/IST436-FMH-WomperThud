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
            <h3 class="text-muted"><?=$gname[name]?></h3>
          </div>
    
          <?php
          echo $gname[name] . "<br>";
          foreach($gname[member] as $member)
          {
            echo member[name]. "<br>";
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

