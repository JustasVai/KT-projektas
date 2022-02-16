<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
//var_dump($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL]);
//die();

if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL]) && ($_SESSION['ulevel'] != $user_roles[VERTINTOJAS_LEVEL]))   { header("Location: logout.php");exit;}
$_SESSION['prev']="vertinimas";
date_default_timezone_set("Europe/Vilnius");
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Vertinimo sąsaja</title>
        <link href="styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <table class="center" ><tr><td>
            
            </td></tr><tr><td>
		<center><font size="5">Paveikslėlio vertinimas</font></center></td></tr></table> <br>
		
		<form name="paveikslelis" action="patvirtinimas.php" method="post">
	    <table class="center" style=" width:75%; border-width: 2px; border-style: dotted;">
			
		<tr><td width=30%><a href="index.php">Atgal</a></td><td width=30%> 
		   
			</tr></table> <br> 
<?php
    
		$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		$user=$_SESSION['user'];
		$sql="SELECT userid FROM vartotojas WHERE prisijungimo_vardas='$user'";
		$result=mysqli_query($db, $sql);
		
		$row=mysqli_fetch_assoc($result);
		$vertintojas=$row['userid'];
		$author = $_GET['autorius'];
		$paveikID= $_GET['paveiksloid'];
		$result = mysqli_query($db, "SELECT * FROM paveiksliukai WHERE autorius_id='$author' AND id='$paveikID'" );
		
			//var_dump($_SESSION['bendras']);
			//die();
	//if (!$result || (mysqli_num_rows($result) < 1))  
		//	{echo "Klaida skaitant lentelę users"; exit;}
?>
    <table class="center"  border="1" cellspacing="0" cellpadding="5">
    <tr><td><b>Autorius</b></td><td><b>Paveiksliuko pavadinimas</b></td><td><b>Gimimo data</b></td><td><b>Spalvingumas</b></td><td><b>Kompozicija</b></td><td><b>Atitikimas</b></td><td><b>Kūrybiškumas</b></td></tr>
<?php
        while($row = mysqli_fetch_assoc($result)) 
		{	 
		
		
		$sql="SELECT vardas,pavarde,gimimo_data FROM vartotojas WHERE userid='$author'";
		$surn = mysqli_query($db, $sql);
		$rezultatai= mysqli_fetch_array($surn);
		$vardas=$rezultatai['vardas'];
		$pavarde=$rezultatai['pavarde'];
	    $pavadinimas=$row['darbo_pavadinimas']; 
		$data = $rezultatai['gimimo_data'];
		
		$paveikID=$row['id'];
		$_SESSION['paveikid']= $paveikID;
		$sql1="SELECT * FROM vertinimai WHERE piesinio_id='$paveikID' AND vertintojas_id='$vertintojas'";
		$vertinimas= mysqli_query($db, $sql1);	
		$rezVertinimai= mysqli_fetch_array($vertinimas);
		$spalvingumas =$rezVertinimai['spalvingumas'];
		$kurybiskumas=$rezVertinimai['kurybiskumas'];
		$kompozicija=$rezVertinimai['kompozicija'];
		$atitikimas=$rezVertinimai['atitikimas'];
	  	//$user= $row['prisijungimo_vardas'];
	  	//$email = $row['el_pastas'];
      	//$time = date("Y-m-d G:i", strtotime($row['pask_prisijungimas']));
		echo "<tr><td>".$vardas. " ".$pavarde."</td>";
      	echo "<td>".$pavadinimas. "</td>";
		echo "<td>".$data. "</td>";
    	echo "<td><select name=\"spalvingumas\">";
      	$yra=false;
		foreach($vertinimai as $x=>$x_value)
  		{echo "<option ";
        	if ($x_value == $spalvingumas) {$yra=true;echo "selected ";}
            echo "value=\"".$x_value."\" ";
         	echo ">".$x_value."</option>";
        }
		
        $neivertintas=neivertintas; 
		echo "<option ";
        if ($spalvingumas == null) 
		echo "selected ";
        echo "value=".$neivertintas." ";
        echo ">Neįvertintas</option>";      // papildoma opcija
      	echo "</select></td>";
		////////////////////////////////////
		echo "<td><select name=\"kompozicija\">";
      	$yra=false;
		foreach($vertinimai as $x=>$x_value)
  		{echo "<option ";
        	if ($x_value == $kompozicija) {$yra=true;echo "selected ";}
            echo "value=\"".$x_value."\" ";
         	echo ">".$x_value."</option>";
        }
		
        $neivertintas=neivertintas; 
		echo "<option ";
        if ($kompozicija == null) 
		echo "selected ";
        echo "value=".$neivertintas." ";
        echo ">Neįvertintas</option>";      // papildoma opcija
      	echo "</select></td>";
		/////////////////////////////////////
      	echo "<td><select name=\"atitikimas\">";
      	$yra=false;
		foreach($vertinimai as $x=>$x_value)
  		{echo "<option ";
        	if ($x_value == $atitikimas) {$yra=true;echo "selected ";}
            echo "value=\"".$x_value."\" ";
         	echo ">".$x_value."</option>";
        }
		
        $neivertintas=neivertintas; 
		echo "<option ";
        if ($atitikimas == null) 
		echo "selected ";
        echo "value=".$neivertintas." ";
        echo ">Neįvertintas</option>";      // papildoma opcija
      	echo "</select></td>";
			
		////////////////////////////////////
		echo "<td><select name=\"kurybiskumas\">";
      	$yra=false;
		foreach($vertinimai as $x=>$x_value)
  		{echo "<option ";
        	if ($x_value == $kurybiskumas) {$yra=true;echo "selected ";}
            echo "value=\"".$x_value."\" ";
         	echo ">".$x_value."</option>";
        }
		
        $neivertintas=neivertintas; 
		echo "<option ";
        if ($kurybiskumas == null) 
		echo "selected ";
        echo "value=".$neivertintas." ";
        echo ">Neįvertintas</option>";      // papildoma opcija
      	echo "</select></td>";
		
		
   }
?>
        </table>
        <br><input type="submit" value="Pridėti vertinimą">
        </form>
    </body></html>
