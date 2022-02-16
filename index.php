<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
session_start();
include("include/functions.php");
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Piešinių konkursas</title>
        <link href="styles.css" rel="stylesheet" type="text/css" >
    </head>
	
    <body>      
<?php
    if (!empty($_SESSION['user']))    	//Jei vartotojas prisijungęs
    {                                   //$_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
		inisession("part");   			//pavalom prisijungimo etapo kintamuosius
		$_SESSION['prev']="index"; 
        include("include/meniu.php"); 
	//įterpiamas meniu pagal vartotojo rolę
?>
		<div style="text-align: center;color:green">
        <br><br>
        <h1 class="title">Pradinis sistemos puslapis</h1>
        <h2 class="title">Piešinių konkursas</h2>
        <h3 class="title">Justas Vaickelionis IFF-9/11</h3>
        </div><br>	
	
<?php  
		}
     else {   			  
   	 	if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes 
        else {
			if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
        }  															
		echo "<div align=\"center\">";echo "<font size=\"4\" color=\"#ff0000\">".$_SESSION['message'] . "<br></font>";   // jei ankstesnis puslapis perdavė $_SESSION['message']       
        echo "<table class=\"center\"><tr><td>";
        include("include/login.php");                    // prisijungimo forma
		echo "</td></tr></table></div><br>";
           
	}
?>
		</body>
</html>