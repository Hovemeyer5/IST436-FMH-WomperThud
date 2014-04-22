<?
    require_once('inc/config.php');
    
    require_once('inc/header.php');
      if(!isset($_SESSION['user']) || $_SESSION['user'] == "")
      {
        require_once('inc/login.php');
      }
      else
      {
          $theID = $_GET[id];
          //this can be removed for when we go live
          $theID = 1;
          $something = $contacts->getContactById($theID);
          $fname = $something[c_fname];
		$mi = $something[c_mi];
		$lname = $something[c_lname];
		//$address = $something[c_address];
		//$phoneNumber = $something[c_phoneNum];
		//$email1 = $something[c_email];
		$image = $something[c_image]
		
        ?>

          <div class="header">
            <ul class="nav nav-pills pull-right">
              <li class="active"><a href="index.php">Home</a></li>
              </ul>
            <h3 class="text-muted"><?=$fname.$mi.$lname?></h3>
          </div>
          <?php
          //this begins the body output
          ?>
          Address:
            <?php
                //echo $address;
            ?>
            <br/>
            <hr>
 <!--the different categories of numbers-->
Phone numbers<br/>
<?php
/*
Purpose: To check if there is a null secondary number, and if not, display it
*/
if ($phoneNum2 == 'null' || $phoneNum2 == "\n")
{
	//echo "Primary: $phoneNumber";
}
else if ($phoneNum2 != 'null')
{
	//echo "<br>";
	//echo "Phone number [secondary]: $phoneNum2";
}
?>
<hr>
Email addresses<br/>
<?php
/*I don't know if we want to do this or not, but make the emails go open in a mail client?*/
//echo "Primary <a href='mailto:SESSION.START.andrewmfoster@gmail.com'> $email </a>";
?>
          
          //end of the body
          ?>
          
    
          <div class="footer">
            <p>&copy; Company 2014</p>
          </div>
        <?
      }
?>
      
<?
  require_once('inc/footer.php');
?>

