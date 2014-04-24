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
          <div class="header editHeader">
			<h3 class="text-muted pull-left">Add Contact</h3>
            <ul class="nav nav-pills pull-right">
              <li><a href="<?=$_SERVER['PHP_SELF']?>">Cancel</a></li>
              <li><a id="save" href="#">Save</a></li>
            </ul> 
          </div>
    
			<div class="row-fluid  contactImage">
			    <div>
				<div class="border imageBox">
				    <div class="imageContainer">
					<img src="i/dummy_image.jpg" />
				    </div>
				</div>
				<input name="lname" type="file" class="form-control">
			    </div>
			</div>
			<div class="row-fluid contactName">
			    <div>
				<form>
					<div>
					    <div>
						<span>Name:</span>
						<button>+</button>
					    </div>
						<input name="fname" type="text" class="form-control" placeholder="First Name" required autofocus>
						<input name="mi" type="text" class="form-control" placeholder="Middle Initial">
						<input name="lname" type="text" class="form-control" placeholder="Last Name">
					</div>
				</form>
			    </div>
			</div>
			<div class="row-fluid contactDetails">
				<div>
				    <form>
					<div>
					    <div>
						<span>Phone:</span>
						<button id="addPhone">+</button>
					    </div>
					    <div class="detailBox">
						<input name="phone" type="text" class="form-control" placeholder="Phone">
					    </div>
					</div>
					<form>
					    <div>
						<span>Address:</span>
						<button id="addAddress">+</button>
					    </div>
					    <div class="detailBox">
						<input name="street" type="text" class="form-control" placeholder="Street">
						<input name="city" type="text" class="form-control" placeholder="City">
						<input name="state" type="text" class="form-control" placeholder="State">
						<input name="zipcode" type="text" class="form-control" placeholder="Zipcode">
					    </div>
					</form>
					<div>
					    <div>
						<span>Email:</span>
						<button id="addEmail">+</button>
					    </div>
					    <div class="detailBox">
						<input name="email" type="text" class="form-control" placeholder="Email">
					    </div>
					</div>
					
					<div>
					     <div>
						<span>URL:</span>
						<button id="addURL">+</button>
					    </div>
					    <div class="detailBox">
						<input name="url" type="text" class="form-control" placeholder="URL">
					    </div>
					</div>
				    </form>
				</div>
			 </div>
    
        <?
      }
?>
      
<?
  require_once('inc/footer.php');
?>

