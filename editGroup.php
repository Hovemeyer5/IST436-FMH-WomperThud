<?
    require_once('inc/config.php');
    
    require_once('inc/header.php');
      if(!isset($_SESSION['user']) || $_SESSION['user'] == "")
      {
        require_once('inc/login.php');
      }
      else
      {
        //see if it is to update or add new
        if(!empty($_GET['id']) and is_numeric($_GET['id']) and $contacts->isValidGroupId($_GET['id']))
        {
          //update  - get the contacts info to populate form fields
          $gDetails = $contacts->getGroupById($_GET['id']);
          echo "<pre>";
          print_r($gDetails);
          echo "</pre>";
          //populate form fields
            ?>
                <div class="header editHeader">
                              <h3 class="text-muted pull-left">Edit Group</h3>
                  <ul class="nav nav-pills pull-right">
                    <li><a class="btn btn-danger" href="<?=$_SERVER['PHP_SELF']?>">Cancel</a></li>
                    <li><a class="btn btn-success"id="save" href="#"><span class="glyphicon glyphicon-ok"></span> Save</a></li>
                  </ul> 
                </div>
  
                <div class="row-fluid eG">
                    <form id="editGroup" method="POST" action='aj.php?action=addGroup' enctype="multipart/form-data">
                                <div>
                                    <input class="hide" name="ContactID" value="<?=$gDetails['g_id']?>">
                                    <div class="formLabel">
                                        <span >Name:</span>
                                    </div>
                                    <input name="fname" type="text" class="form-control" placeholder="First Name" required autofocus value="<?=($gDetails['g_name'] != "" ? $gDetails['g_name'] : "")?>">
                                </div>
                                <div>
                                    <div class="formLabel">
                                        <span >Members:</span>
                                    </div>
                                    <div id="members">
                                      <ul>
                                        <?
                                        foreach($gDetails['members'] as $member)
                                        {
                                        ?>
                                            <li><span><?=$member['c_name']?></span><input class="hide" name="memberID[]" value="<?=$member['c_id']?>"><span class="glyphicon glyphicon-remove"></span></li>
                                         <?
                                        }
                                        ?>
                                      </ul>
                                    </div>
                                </div>
                                
                      </form>
                    <div id="deleteForm">
                      <form action="aj.php?action=deleteGroup" method="post">
                        <input class="hide" name="GroupID" value="<?=$gDetails['g_id']?>">
                        <input class="btn btg-lg btn-danger btn-block" type="submit" value="Delete">
                      </form>
                    </div>
                    
                </div>
                 
          <?  
          }
          else
          {
          ?>
            <div class="header editHeader">
                          <h3 class="text-muted pull-left">Add Group</h3>
              <ul class="nav nav-pills pull-right">
                <li><a class="btn btn-danger" href="<?=$_SERVER['PHP_SELF']?>">Cancel</a></li>
                <li><a class="btn btn-success"id="save" href="#"><span class="glyphicon glyphicon-ok"></span> Save</a></li>
              </ul> 
            </div>
             <div class="row-fluid eG">
                    <form id="editGroup" method="POST" action='aj.php?action=addGroup' enctype="multipart/form-data">
                          <input class="hide" name="groupID" value="">
                          <div>
                              <div class="formLabel">
                                  <span >Name:</span>
                              </div>
                              <input name="gname" type="text" class="form-control" placeholder="Group Name" required autofocus>
                          </div>
                          <div>
                              <div class="formLabel">
                                  <span >Members:</span>
                              </div>
                              <div id="members">
                                <ul>
                                      <li><span>Select A Member Below</span><input class="hide" name="memberID[]" value=""></li>
                                </ul>
                              </div>
                          </div>
                    </form>                
            </div>        
        <?
        }
        ?>
          <div id="selectMember">
            <div class="formLabel">
                <span>Select a Member:</span>
            </div>
            <div>
              <p>Search for a member and then tap/click their name to add them to your group's member list.</p>
            </div>
	    <input id="search" class="form-control" type="text" size="50" placeholder="Search"/>
		<div id="contactListing">
                  <ul>
                    <?
                      $allContacts = $contacts->getContacts();
                      if($allContacts != "")
                      {
                        foreach($allContacts as $key=>$value)
                        {
                        ?>
                          <li onclick="addMember(this)"><span><?=$value[name]?></span><input class="hide" name="memberID[]" value="<?=$value[c_id]?>"></li>
                        <?
                        }
                      }
                      else
                      {
                        ?>
                        <li>You have no contacts to add. <a href="editContact.php">Add Contacts Here</a></li>
                        <?
                      }
                    ?>
                  </ul>
		</div>	 
          </div>
        </div>
<script src="js/addGroup.js"></script>
    
        <?
      }
?>
      
<?
  require_once('inc/footer.php');
?>

