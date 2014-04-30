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
          <script>
            $(document).ready(function () {
              
              $('#save').click(function(){
                  $("#editContact").submit();
              });
              
            });
          </script>
			<div class="row-fluid">
			    <div>
				<div class="border imageBox">
				    <div class="imageContainer">
					<img src="../_upload/photo 1.JPG" />
				    </div>
				</div>
                              </div>
                            <form id="editContact" method="POST" action='aj.php?action=addContact' enctype="multipart/form-data">
				<input id="imageUpload" name="image" type="file" class="form-control">
					<div>
					    <div>
						<span>Name:</span>
					    </div>
						<input name="fname" type="text" class="form-control" placeholder="First Name" required autofocus>
						<input name="mi" type="text" class="form-control" placeholder="Middle Initial">
						<input name="lname" type="text" class="form-control" placeholder="Last Name">
					</div>
					    <div>
						<span>Phone:</span>
						<button id="addPhone">+</button>
					    </div>
					    <div class="detailBox">
						<input name="phone" type="text" class="form-control" placeholder="Phone">
					    </div>
					</div>
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

