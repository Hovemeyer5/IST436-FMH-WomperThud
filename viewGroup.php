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
          $gname = $contacts->getGroupById($theID);
          [g_id] => 1
        $gname = [g_name] => TestGroup
        [members] => Array
        (
            [0] => Array
                (
                    [c_id] => 1
                    [c_name] => Miss L America
                )

            [1] => Array
                (
                    [c_id] => 2
                    [c_name] => Rebecca R Hovemeyer
                )

        )
        ?>
          <div class="header">
            <ul class="nav nav-pills pull-right">
              <li class="active"><a href="index.php">Home</a></li>
            </ul>
            <h3 class="text-muted"><?=$gname?></h3>
          </div>
    
          <?php
          /*
          for (each member in the array)
          {
            echo "[c_name]";
          }
          
          */
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

