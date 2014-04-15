<?php
    require_once('inc/config.php');
    
    if(isset($_POST['action']) or isset($_GET['action']))
    {
	if(isset($_POST['action']))
	    $action = $_POST['action'];
	else
	    $action = $_GET['action'];
	
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
	elseif($action == "getContacts")
	{

	}
	elseif($action == "addContact")
	{

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
	else{
	    echo "Uh Oh! Something went wrong. Please return to the <a href='index.php'>home page</a>..";
	}
    }
    else
    {
	echo "Uh Oh! Something went wrong. Please return to the <a href='index.php'>home page</a>.";
    }
	
?>

