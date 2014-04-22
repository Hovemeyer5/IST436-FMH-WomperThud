<?
    require_once('inc/config.php');
    
    require_once('inc/header.php');
?>
        <h2>To Retrieve Contacts/Groups with their ID and Name</h2>
        <p>
        $contactsGroups = $contacts->getContactsGroups(); <br>
        print_r($contactsGroups); <br><br>
        $search = "Y"; <br>
        $contactsGroups = $contacts->getContactsGroups($search); <br>
        print_r($contactsGroups); <br>
        </p>
        <?
        $search = "Y";
        echo "<pre>";
        print_r($contacts->getContactsGroups());
        echo "</pre>";
        $contactsListing = $contacts->getContactsGroups();
		
		echo $contactsListing[0]['name'];
        echo "<pre>";
        print_r($contacts->getContactsGroups($search));
        echo "</pre>";
        ?>
        
        
        <h2>To get a single Contact</h2>
        $id = 1<br>
        $contacts->getContactById($id);
        <?
        $id = 1;
        echo "<pre>";
        print_r($contacts->getContactById(1));
        echo "</pre>";
        ?>
        
        <h1>To Get a single Group and it's members</h1>
        $id = 1<br>
        $contacts->getGroupById(1);
        <?
         $id = 1;
        echo "<pre>";
        print_r($contacts->getGroupById(1));
        echo "</pre>";
        ?>
<?
  require_once('inc/footer.php');
?>

