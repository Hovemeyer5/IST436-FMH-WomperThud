<?php
    require_once('inc/config.php');
    
    if(isset($_POST['action']) or isset($_GET['action']))
    {
	if(isset($_POST['action']))
	    $action = $_POST['action'];
	else
	    $action = trim($_GET['action']);
	if($action == "lgn" && isset($_POST['username']) && isset($_POST['psw']))
	{
	    $loginFailed ="";
	    $result = "";
	    $results = $db->select("user", "u_s", "u_username = '". $_POST['username']."'");
	    if($results == "")
	    {	
		//logined failed message = e 7
		$loginFailed = "?e=7";
	    }
	    else
	    {
		    $testPW = hash("ripemd160", $_POST['psw'] . $results[0]['u_s']);
		    $result = $db->select("user", "u_id", 
		    "u_username = '". htmlspecialchars($_POST['username']) . "' AND u_pw = '" . $testPW . "'"); 
		    if($result == "") 				
		    {
			//logined failed e =7
			$loginFailed = "?e=7";			
		    } 				
		    else 				
		    { 
			$_SESSION['user'] = $result[0]['u_id'];
		    } 
	    }
	    header("location:" . 'index.php'. $loginFailed);
	}
	elseif($action == "lgout")
	{
	    //logout
	    session_destroy();
	    //back to home
	    header("location: index.php");
	}
	elseif($action == "signup" and isset($_POST['fname']) and isset($_POST['lname'])and isset($_POST['psw'])and isset($_POST['cpsw'])and isset($_POST['username']))
	{
	    //all general informatin was sent
	    //check if student or business informatin was sent
	    $break = true;
	    
	    //trim data
	    $fname = trim($_POST['fname']);
	    $lname = trim($_POST['lname']);
	    $username= trim($_POST['username']);
	    $psw = trim($_POST['psw']);
	    $cpsw = trim($_POST['cpsw']);
	    
	    $result = $db->select("user", "u_id", "u_username = '". $username ."'"); 
	    
	    if($fname == "" or $lname == "" or $psw == "" or $cpsw == "" or $username == "")
	    {
		//error one = required info not sent
		header("location:" . $_SERVER['HTTP_REFERER'] . '?r=1');
	    }
	    elseif($result !== "")
	    {
		//error two = username already taken
		header("location:" . $_SERVER['HTTP_REFERER']. '?r=2');
	    }
	    elseif($psw != $cpsw)
	    {
		//error 5 = passwords don't match
		header("location:" . $_SERVER['HTTP_REFERER']. '?r=5');
	    }
	    else
	    {    
		$salt = hash("ripemd160", mcrypt_create_iv(40));
		$passw = hash("ripemd160", $psw . $salt);
		$userid = $db->insert("user",
			    "'".$db->escape($fname)."','".$db->escape($lname)."','".$db->escape($username)."','".$passw."', '".$salt."'" ,
			    "u_fname, u_lname, u_username, u_pw, u_s");
		//set user logged in
		$_SESSION['user'] = $userid;
		header("location:" . 'index.php'.$studentsuccess);
	    }  
	}
	elseif($action == "checkUName")
	{
	    $checkUN = $db->select("user", "u_id", "u_username = '". $_POST['username'] ."'");
	    if($checkUN == "")
		echo "true";
	    else
		echo "false";
	}
	elseif($action == "iUpload")
	{
	}
	elseif($action == "getContacts")
	{

	}
	elseif($action == 'addContact')
	{
	    $fname = trim($_POST['fname']);
	    //first name is required
	    if($fname == "")
	    {
		header("location:" . 'index.php?e=1');
	    }
	    else
	    {
		$mi = trim($_POST['mi']);
		$lname = trim($_POST['fname']);
		$phoneNumbers = [];
		
		print_r($_POST);
		foreach($_POST as $key=>$entry)
		{
		    if (strpos($key,'phoneType') !== false) {
			$num = ltrim ($key , 'phoneType');
			echo $num;
			$tempPhone[0] = $entry;
			$tempPhone[1] = $_POST['phone' . $num];
			array_push($phoneNumbers, $tempPhone);
		    }
		}
		echo "<pre>";
		print_r($phoneNumbers);
		echo "</pre>";
		////Now you can start creating a contact.
		//$uploadsDirectory = "..\\_upload\\";
		//    
		////make its own name
		//$now =time(); 
		//$uploadFilename = $now.'-'.preg_replace('/\s+/', '', $_FILES['image']['name']);
		//
		////Move the uplaoded file to destination
		//move_uploaded_file($_FILES["image"]["tmp_name"], $uploadsDirectory . $uploadFilename);
		//
	    }

	    
	}
	elseif($action == "deleteContact")
	{

	}
	elseif($action == "addGroup")
	{

	}
	elseif($action == "deleteGroup")
	{

	}
	elseif($action == "addContactToGroup")
	{

	}
	elseif($action == "deleteContactFromGroup")
	{

	}
	elseif($action == "searchInput")
	{	
		global $contacts;
		$allContactsGroup = $contacts->getContactsGroups($_POST['search']);
		foreach($allContactsGroup as $key=>$value)
			{
				echo "<ul><li><a href='viewContact.php?id=".$value[c_id]."'>".$value[name]."</a></li></ul>";	
			}

	}
	else{
	    echo "Uh Oh! Something went wrong. Please return to the <a href='index.php'>home page</a>..";
	}
    }
    else
    {
	echo "Uh Oh! Something went wrong. Please return to the <a href='index.php'>home page</a>.";
    }
	
?>

