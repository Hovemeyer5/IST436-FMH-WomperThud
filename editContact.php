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
					    <div class="formLabel">
						<span >Phone:</span>
						<button data-type="phone" class="add" id="addPhone">+</button>
					    </div>
                                            <div data-count="1" id="phones">
                                              <div class="detailBox">
                                                  <select name="phoneType1">
                                                    <option value="1">Home</option>
                                                    <option value="2">Work</option>
                                                    <option value="3">Other</option>
                                                  </select>
                                                    <input name="phone1" type="text" class="form-control" placeholder="Phone">
                                                    <button data-type="phone" class="remove">Remove</button>
                                                    <input class="hide" name="phoneID1" value="">
                                              </div>
                                            </div>
					</div>
					    <div class="formLabel">
						<span >Address:</span>
						<button data-type="address" class="add" id="addAddress">+</button>
					    </div>
                                            <div data-count="1" id="addresss">
                                              <div class="detailBox">
                                                  <select name="addType1">
                                                    <option value="1">Home</option>
                                                    <option value="2">Work</option>
                                                    <option value="3">Other</option>
                                                  </select>
                                                  <input name="street1" type="text" class="form-control" placeholder="Street">
                                                  <input name="city1" type="text" class="form-control" placeholder="City">
                                                  <input name="state1" type="text" class="form-control" placeholder="State">
                                                  <input name="zipcode1" type="text" class="form-control" placeholder="Zipcode">
                                                  <input class="hide" name="addID1" value="">
                                              </div>
                                            </div>
					<div>
					    <div class="formLabel">
						<span >Email:</span>
						<button data-type="email" class="add" id="addEmail">+</button>
					    </div>
                                            <div data-count="1" id="emails">
                                              <div class="detailBox">
                                                  <select name="emailType1">
                                                    <option value="1">Home</option>
                                                    <option value="2">Work</option>
                                                    <option value="3">Other</option>
                                                  </select>
                                                  <input name="email1" type="text" class="form-control" placeholder="Email">
                                                  <input class="hide" name="emailID1" value="">
                                              </div>
                                            </div>
					</div>
					
					<div>
					     <div class="formLabel">
						<span >URL:</span>
						<button data-type="url" class="add" id="addURL">+</button>
					    </div>
                                            <div data-count="1" id="urls">
                                              <div class="detailBox">
                                                  <select name="urlType1">
                                                    <option value="1">Home</option>
                                                    <option value="2">Work</option>
                                                    <option value="3">Other</option>
                                                  </select>
                                                  <input name="url1" type="text" class="form-control" placeholder="URL">
                                                  <input class="hide" name="urlID1" value="">
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

