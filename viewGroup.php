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
		  echo "<pre>";
		  print_r($gname);
		  echo "</pre>";
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
			  echo "<div><a href='viewContact.php?id=".$value[c_id]."'>".$value[$c_name]."</a>$member[c_name].</div>";
            //echo $member[c_name]. "<br>";
          }
		  foreach ($gname['members'] as $member)
		  {

		  	$street = $member[address][a_street];
        	$city = $member[address][a_city];
        	$state = $member[address][a_state];
        	$zip = $member[address][a_zip];
			if($street != "")
			{
				$streetarray = explode(" ", $street);
				
				$newstreet = "";
				foreach($streetarray as $key=>$val)
				{
					if($key > 0)
					{
						$newstreet += "+" . $val;
					}
					else
					{
						//val isn't set to anything
						$newstreet = $val;
					}
					
				}
				echo $newstreet;
				//debug purposes only
				echo "<br/>";
				
				//for some reason, doing $mapstring += didn't work
				$mapstring = $mapstring . "&markers=color:red%7C" . $newstreet ."+".$city."+".$state;
		  	}
		  }
			//$mapAddress = $street."+".$city.",".$state;

          //for ($k = 0; $k < $i; $k++)
		  //echo "$addressArray[$k]";
		  //time to do the map
          echo "<img border='0'  alt='' src='http://maps.googleapis.com/maps/api/staticmap?key=AIzaSyA-d9p8eSmHByP_0emwNUJzgSaYal9abA4&center=1+John+Marshall+Drive+Huntington+WV&zoom=12
&size=400x400&$mapstring&sensor=false,' />";
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

