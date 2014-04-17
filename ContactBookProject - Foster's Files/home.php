<?php
/*
!!pseudo code!!
	if (login != true)
	{
		header("location:login.php");	
	}
*/

	/*this needs to be changed to SQL commands, but for basic usage, this should work*/
	
	$file_handle = fopen("sample.txt", "r");
	
		$fname = fgets($file_handle);
		$mi = fgets($file_handle);
		$lname = fgets($file_handle);
		$address = fgets($file_handle);
		$phoneNumber = fgets($file_handle);
		$phoneNum2 = fgets($file_handle);
		$email1 = fgets($file_handle);
		/*
   		echo "$dateString <br>";
   		echo "$oldBalance <br>";
   		echo "$balanceOld <br>";
   		echo "$newBalance <br>";
   		echo "$balanceNew <br>";
   		echo "<br>";
		*/

	
	$file_handle = fclose($file_handle);
	
?>
<!DOCTYPE html PUBLIC>
<head>
<meta name="viewport" content="width=device-width", initial-scale="1">
<link rel="stylesheet" href="CSS/NerdLair2.css" />
<script type="text/javascript">
function displayDate()
{
	
	var d = new Date();
	var x = document.getElementById("copyrighthere");
	//document.write("Copyright &#169;");
	//x.innerHTML=d.getFullYear();
	
	if (d == 2014)
	{
		document.write("Site &#169; Group FMH 2014.");
	}
	else if (d != 2014)
	{
		//document.write("Site &#169; McCallister, Hovemeyer, and Foster 2014 - ");
		x.innerHTML="Site &#169; Group FMH 2014." + d.getFullYear();
		//document.write("Site &#169; McCallister, Hovemeyer, and Foster 2014 - ");
	}
}
</script>
<!--This simply dynamically changes the title of the page to the first name-->
<?php
echo "<title>$fname $mi $lname</title>";
?>
<!--<title>Home</title>-->
</head>

<body>
<h1>
<center>
<!--This displays the contacts name at the center and top of the page-->
<?php
echo $fname;
echo $mi;
echo $lname;

/*This is a place to display a photo*/
//echo "<img src=''";
?>
</center></h1>
<hr>
<p id="boldstuff">
Address:
<?php
echo $address;
?>
<br/>
<hr>
 <!--the different categories of numbers-->
Phone numbers<br/>
<?php

/*
Purpose: To check if there is a null secondary number, and if not, display it
*/
if ($phoneNum2 == 'null' || $phoneNum2 == "\n")
{
	echo "Primary: $phoneNumber";
}
else if ($phoneNum2 != 'null')
{
	echo "<br>";
	echo "Phone number [secondary]: $phoneNum2";
}
?>
<hr>
Email addresses<br/>
<?php
/*I don't know if we want to do this or not, but make the emails go open in a mail client?*/
echo "Primary <a href='mailto:SESSION.START.andrewmfoster@gmail.com'> $email1 </a>";
?>
<br/>
<hr>
<span id="copyrighthere">
<script type="text/javascript">
//calls the function to display the year
displayDate();
</script>
<br/>
</span>
</body>
</html>