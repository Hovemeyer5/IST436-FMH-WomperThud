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
		header("location:" . 'editContact.php?e=1');
	    }
	    else
	    {
		$thisContact = "";

		//check if update vrs. add.
		if($_POST['ContactID'] != "")
		{
		    //update contact
		    $thisContact = $_POST['ContactID'];  
		}
		else
		{
		    //add contact
		    
		    //if exists, upload contacts image.
		    $imagePath = "";
		    $field = 'image';
		    if(file_exists($_FILES[$field ]['tmp_name']) || is_uploaded_file($_FILES[$field ]['tmp_name']))
		    {
			
			//make sure it is an image - example from w3schools.
			//checks against mime type and make sure that file is small
			// < 25mb (edited to reflect like file upload in emails.)
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$ext = strtolower(end(explode(".", $_FILES[$field ]["name"])));
			
			if ((($_FILES[$field ]["type"] == "image/gif")
			|| ($_FILES[$field]["type"] == "image/jpeg")
			|| ($_FILES[$field]["type"] == "image/jpg")
			|| ($_FILES[$field]["type"] == "image/pjpeg")
			|| ($_FILES[$field]["type"] == "image/x-png")
			|| ($_FILES[$field]["type"] == "image/png"))
			&& ($_FILES[$field]["size"] < (25*1024*1024))
			&& in_array($ext, $allowedExts))
			{
			    //good to go, it's a relatively small image.
			    
			    //the upload directory
			    $uploadsDirectory = "..\\_upload\\";
				
			    //make its own name
			    $now =time(); 
			    $uploadFilename = $now.'-'.preg_replace('/\s+/', '', $_FILES[$field]['name']);
			    
			    //Move the uplaoded file to destination
			    if(move_uploaded_file($_FILES[$field]["tmp_name"], $uploadsDirectory . $uploadFilename))
			    {
				//set image path for database
				 $imagePath = "../_upload/". $uploadFilename;
				 
			    }
			    else
			    {
				//just don't throw an error
			    }
			}
			else
			{
			  //don't upload an image....Image is not required for contact to be added. 
			}
		    }
		     
		    
		    //now, you can add a contact!!!
		    $mi = trim($_POST['mi']);
		    $lname = trim($_POST['lname']);
		    
		    //insert contact into database.
		    $thisContact = $db->insert('contact', "'".$fname."',
					       '".$lname."',
					       '".$mi."',
					       ".$_SESSION['user'].",
					       '".$imagePath."'",
					       "c_fname, c_lname, c_mi, c_u_id, c_image");
		}
		
		//array declarations
		$phoneNumbers = [];
		$addresses = [];
		$emails = [];
		$urls = [];
		
		//print_r($_POST);
		//loop through post to get info into nice arrays
		//are there any phones?
		if(isset($_POST['phone']))
		{
		    foreach($_POST['phone'] as $key=>$phone)
		    {
			//get phones
			$temp[0] = $_POST['phoneType'][$key];
			$temp[1] = preg_replace("/[^0-9.]/", '', $phone);
			$temp[2] = $_POST['phoneID'][$key];
			array_push($phoneNumbers, $temp);
		    }
		}
		//are there any addresses?
		if(isset($_POST['addType']))
		{
		    foreach($_POST['addType'] as $key=>$addType)
		    {
			//get address
			$temp[0] = $addType;
			$temp[1] = $_POST['street'][$key];
			$temp[2] = $_POST['city'][$key];
			$temp[3] = $_POST['state'][$key];
			$temp[4] = $_POST['zipcode'][$key];
			$temp[5] = $_POST['addID'][$key];
			array_push($addresses, $temp);
		    }
		}
		
		
		//are there any emails
		if(isset($_POST['email']))
		{

		    foreach($_POST['email'] as $key=>$email)
		    {
			//get emails
			$temp[0] = $_POST['emailType'][$key];
			$temp[1] = $email;
			$temp[2] = $_POST['emailID'][$key];
			array_push($emails, $temp);
		    }
		    
		}
		//are there any urls?
		if(isset($_POST['url']))
		{
		    foreach($_POST['url'] as $key=>$url)
		    {
			//get urls
			$temp[0] = $_POST['urlType'][$key];
			$temp[1] = $url;
			$temp[2] = $_POST['urlID'][$key];
			array_push($urls, $temp);
		    }
		    
		}

		//now add/update/delete contacts details to database
		//edit phone numbers
		foreach($phoneNumbers as $phoneNumber)
		{
		    if(trim($phoneNumber[1]) != "") //make sure there is an email
		    {
			//check if updating or inserting
			if($phoneNumber[2] == "")
			{
			    //no existing id - add new one
			    $db->insert('phone', "'".$phoneNumber[1]."',
						   ".$phoneNumber[0].",
						   ".$thisContact,
						   "p_number, p_type, c_id");
			}
			else
			{
			    //delete or update
			    if(strpos($phoneNumber[2],'X') !== false)
			    {
				$phoneNumber[2] = rtrim ($phoneNumber[2] , 'X');
				if($phoneNumber[2] != "")
				{
				    //marked for deletion - so delete
				    $db->delete('phone', 'p_id = '. $phoneNumber[2]);
				}
			    }
			    else
			    {
				//has an id - update
				$db->update('phone', 'p_number = "'.$phoneNumber[1].'", p_type = '.$phoneNumber[0], 'p_id = '. $phoneNumber[2]);
			    }
			    
			}
		    }
		}
		//edit emails
		foreach($emails as $email)
		{
		    if(trim($email[1]) != "") //make sure there is an email
		    {
			//check if updating or inserting
			if($email[2] == "")
			{
			    //no existing id - add new one
			    $db->insert('email', "'".$email[1]."',
						   ".$email[0].",
						   ".$thisContact,
						   "e_email, e_type, c_id");
			}
			else
			{
			    //delete or update
			    if(strpos($email[2],'X') !== false)
			    {
				$email[2] = rtrim ($email[2] , 'X');
				if($email[2] != "")
				{
				    //marked for deletion - so delete
				    $db->delete('email', 'e_id = '. $email[2]);
				}
			    }
			    else
			    {
				//has an id - update
				$db->update('email', 'e_email = "'.$email[1].'", e_type = '.$email[0], 'e_id = '. $email[2]);
			    }  
			}
		    }
		}

		//edit url
		foreach($urls as $url)
		{
		    if(trim($url[1]) != "")//make sure there is a url
		    {
			//check if updating or inserting
			if($url[2] == "")
			{
			    //no existing id - add new one
			    $db->insert('url', "'".$url[1]."',
						   ".$url[0].",
						   ".$thisContact,
						   "url_url, url_type, c_id");
			}
			else
			{
			    //delete or update
			    if(strpos($url[2],'X') !== false)
			    {
				$url[2] = rtrim ($url[2] , 'X');
				if($url[2] != "")
				{
				    //marked for deletion - so delete
				    $db->delete('url', 'url_id = '. $url[2]);
				}
			    }
			    else
			    {
				//has an id - update
				$db->update('url', 'url_url = "'.$url[1].'", url_type = '.$url[0], 'url_id = '. $url[2]);
			    }
			    
			}
		    }
		}
		//edit address.
		foreach($addresses as $add)
		{
		    if(trim($add[1]) != "" && trim($add[2]) != "" && trim($add[3]) != "" && trim($add[4]) != "") //make sure there is an address
		    {
			//check if updating or inserting
			if($add[5] == "")
			{
			    //no existing id - add new one
			    $db->insert('address', "'".$add[1]."', 
						   '".$add[2]."',
						   '".$add[3]."',
						   ".$add[4].",
						   ".$add[0].",
						   ".$thisContact,
						   "a_street, a_city, a_state, a_zip, a_type, c_id");
			}
			else
			{
			    //delete or update
			    if(strpos($add[5],'X') !== false)
			    {
				$add[5] = rtrim ($add[5] , 'X');
				if($add[5] != "") //make sure there is an id sent
				{
				    //marked for deletion - so delete
				    $db->delete('address', 'a_id = '. $add[5]);
				}
			    }
			    else
			    {
				//has an id - update
				$db->update('address', 'a_street = "'.$add[1].'",
						a_city = "'.$add[2].'",
						a_state = "'.$add[3].'",
						a_zip = '.$add[4].',
						a_type = '.$add[0], 'a_id = '. $add[5]);
			    }
			    
			}
		    }
		}
		
		header("location:" . 'viewContact.php?id='.$thisContact);
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

