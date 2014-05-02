<?
		require_once('inc/config.php');

		require_once('inc/header.php');
		  if(!isset($_SESSION['user']) || $_SESSION['user'] == "")
		  {
			require_once('inc/login.php');
		  }
		  else
		  {
			$PAGINATION = 2;
			$allContactsGroup = $contacts->getContactsGroups();

	?>
	
			<div class="header">
            <ul class="nav nav-pills pull-right">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="addChoose.php">Add</a></li>
			  <li><a href="download.php">Download</a></li>
			  <li><a href="aj.php?action=lgout">Logout</a></li>
            </ul>
			
			<h3 class="text-muted">PHP Application</h3>
        </div>
		
		<form method="post" name="searchInput">
			<input id="search" type="text" size="50" placeholder="Search"/>
				<script src="js/search.js"></script>
        </form>
		<br/>
		
		<div id="contactListing">
			<?
				foreach($allContactsGroup as $key=>$value)
				{
					echo "<ul><li><a href='viewContact.php?id=".$value[c_id]."'>".$value[name]."</a></li></ul>";
				}
		  }
			?>
		</div>	 
		
	<?
	  require_once('inc/footer.php');
	?>
