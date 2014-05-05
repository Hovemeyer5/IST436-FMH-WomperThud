<?
    require_once('inc/config.php');
    
    require_once('inc/header.php');
      if(!isset($_SESSION['user']) || $_SESSION['user'] == "")
      {
        require_once('inc/login.php');
      }
      else
      {
          //$theID = $_GET[id];
          //this can be removed for when we go live
          $theID = 1;
          $something = $contacts->getContactById($theID);
		  print_r($something);
          $fname = $something[c_fname];
		$mi = $something[c_mi];
		$lname = $something[c_lname];
		$street = $something[adds][0][a_street];
        $city = $something[adds][0][a_city];
        $state = $something[adds][0][a_state];
		//$zip = $something[add][0][a_zip];
        $zip = $something[adds][0][a_zip];
        $type = $something[a_type];
        //[t_name] => Home
		//$address = $something[c_address];
		$phoneNumber = $something[phones][0][p_number];
		$email1 = $something[emails][0][e_email];
		$image = $something[c_image];
		//1012+Rustling+Road+South+Charleston,WV
		$mapAddress = $street."+".$city.",".$state;
		//$mapAddress = "1012+Rustling+Road+South+Charleston,WV";
		
        ?>
			<?php 
			echo "<title>$fname.$mi.$lname</title>";
			?>
          <div class="header">
            <ul class="nav nav-pills pull-right">
              <li class="active"><a href="index.php">Home</a></li>
              </ul>
            <h3 class="text-muted"><?=$fname.$mi.$lname?></h3>
            <!--This is for the image-->
            <div>
            <?php
			/*didn't include height or width as I think Rebecca has the database set to resize? The alt tag is the contact's name*/
				echo "<img src='$image' alt='$fname.$mi.$lname'>";
			?>
            <!--end of the image div-->
            </div>
          </div>
          <?php
          //this begins the body output
          ?>
            <br/>
            <hr>
 <!--the different categories of numbers-->
 
 <!--This begins the phone numbers div-->
 <div>
Phone numbers:<br/>
<?php
/*
Purpose: To check if there is a null secondary number, and if not, display it
*/
if ($phoneNumber != 'null' || $phoneNumber != "\n")
{
	echo "Primary: <a href='tel:$phoneNumber'>$phoneNumber</a>";
}
else if ($phoneNum2 != 'null')
{
	//echo "<br>";
	//echo "Phone number [secondary]: $phoneNum2";
}
?>
</div>
<!--The above div ends the phone numbers div-->
<hr>
 <!--This begins the email div-->
<div>
Email addresses:<br/>
<?php
/*I don't know if we want to do this or not, but make the emails go open in a mail client?*/
echo "Primary: <a href='mailto:$email1'> $email1 </a>";
?>
</div>
<!--The above div ends the email div-->
<!--This begins the address div-->
          <div>
          Address:<br/>
            <?php
			//echos out an image of the user's location
			
			echo "Home: ";	
			echo $street . ", ";
        	echo $city . ", ";
        	echo $state . ". ";
        	echo $zip;
			echo "<br/>";
			echo "<img border='0'  alt='' src='http://maps.googleapis.com/maps/api/staticmap?key=AIzaSyA-d9p8eSmHByP_0emwNUJzgSaYal9abA4&center=$mapAddress&zoom=18
&size=400x400&markers=color:blue%7C$mapAddress&sensor=false,' />";
                //echo $address;
            ?>
            </div>
            <!--The above div ends the address div-->

          <div class="footer">
            <p>&copy; FMH 2014</p>
          </div>
        <?
      }
?>
      
<?
  require_once('inc/footer.php');
?>

