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

			<div class="row-fluid">
			    <div>
				<div class=" imageBox">
				    <div class="imageContainer">
					<img src="../_upload/photo 1.JPG" />
				    </div>
				</div>
                              </div>
                            <form id="editContact" method="POST" action='aj.php?action=addContact' enctype="multipart/form-data">
                                        <input class="hide" name="ContactID" value="">
                                        <input id="imageUpload" name="image" type="file" class="form-control">
					<div>
					    <div class="formLabel">
						<span >Name:</span>
					    </div>
						<input name="fname" type="text" class="form-control" placeholder="First Name" required autofocus>
						<input name="mi" type="text" class="form-control" placeholder="Middle Initial">
						<input name="lname" type="text" class="form-control" placeholder="Last Name">
					</div>
                                        <div>
                                            <div class="formLabel">
                                                <span >Phone:</span>
                                                <button data-type="phone" class="add" id="addPhone">+</button>
                                            </div>
                                            <div id="phones">
                                              <div class="detailBox">
                                                  <select name="phoneType[]">
                                                    <option value="1">Home</option>
                                                    <option value="2">Work</option>
                                                    <option value="3">Other</option>
                                                  </select>
                                                    <input name="phone[]" type="text" class="form-control" placeholder="Phone">
                                                    <button data-type="phone" class="remove" onclick='removeDetailBox(this, event)'>Remove</button>
                                                    <input class="hide" name="phoneID[]" value="">
                                              </div>
                                            </div>
                                        </div>
                                        <div>
					    <div class="formLabel">
						<span >Address:</span>
						<button data-type="address" class="add" id="addAddress">+</button>
					    </div>
                                            <div id="addresss">
                                              <div class="detailBox">
                                                  <select name="addType[]">
                                                    <option value="1">Home</option>
                                                    <option value="2">Work</option>
                                                    <option value="3">Other</option>
                                                  </select>
                                                  <input name="street[]" type="text" class="form-control" placeholder="Street">
                                                  <input name="city[]" type="text" class="form-control" placeholder="City">
                                                  <input name="state[]" type="text" class="form-control" placeholder="State">
                                                  <input name="zipcode[]" type="text" class="form-control" placeholder="Zipcode">
						  <button onclick='removeDetailBox(this, event)'>Remove</button>
                                                  <input class="hide" name="addID[]" value="">
                                              </div>
                                            </div>
                                        </div>
					<div>
					    <div class="formLabel">
						<span >Email:</span>
						<button data-type="email" class="add" id="addEmail">+</button>
					    </div>
                                            <div id="emails">
                                              <div class="detailBox">
                                                  <select name="emailType[]">
                                                    <option value="1">Home</option>
                                                    <option value="2">Work</option>
                                                    <option value="3">Other</option>
                                                  </select>
                                                  <input name="email[]" type="text" class="form-control" placeholder="Email">
						  <button onclick='removeDetailBox(this, event)'>Remove</button>
                                                  <input class="hide" name="emailID[]" value="">
                                              </div>
                                            </div>
					</div>
					
					<div>
					    <div class="formLabel">
						<span >URL:</span>
						<button data-type="url" class="add" id="addURL">+</button>
					    </div>
                                            <div  id="urls">
                                              <div class="detailBox">
                                                  <select name="urlType[]">
                                                    <option value="1">Home</option>
                                                    <option value="2">Work</option>
                                                    <option value="3">Other</option>
                                                  </select>
                                                  <input name="url[]" type="text" class="form-control" placeholder="URL">
						  <button onclick='removeDetailBox(this, event)'>Remove</button>
                                                  <input class="hide" name="urlID[]" value="">
                                              </div>
                                            </div>
					</div>
				    </form>
				</div>
			 </div>
<script src="js/addContact.js"></script>
    
        <?
      }
?>
      
<?
  require_once('inc/footer.php');
?>

