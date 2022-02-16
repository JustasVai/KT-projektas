<?php
session_start();
// cia sesijos kontrole: tik is procadmin
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "vertinimas"))
{ header("Location: logout.php");exit;}

include("include/nustatymai.php");
include("include/functions.php");
$_SESSION['prev'] = "patvirtinimas";

$atitikimas = $_POST['atitikimas'];
$spalvingumas = $_POST['spalvingumas'];
$kurybiskumas= $_POST['kurybiskumas'];
$kompozicija = $_POST['kompozicija'];
$pavid= $_SESSION['paveikid'];
$user=$_SESSION['user'];
$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql="SELECT userid FROM vartotojas WHERE prisijungimo_vardas='$user'";
$result=mysqli_query($db, $sql);
$row=mysqli_fetch_assoc($result);
$vertintojas=$row['userid'];

if($atitikimas==neivertintas || $kompozicija==neivertintas || $kurybiskumas==neivertintas || $spalvingumas==neivertintas)
{
	$_SESSION['message']="Reikia pasirinkti vertinimą";
	header("Location:operacija2.php");exit;
}


else
{
$sql="SELECT * FROM vertinimai WHERE piesinio_id='$pavid' AND vertintojas_id='$vertintojas'";
$result=mysqli_query($db, $sql);
if(mysqli_num_rows($result) == 0)
{
	$result = mysqli_query($db, "SELECT * FROM vertinimai WHERE piesinio_id='$pavid'");
	$sql = "INSERT into vertinimai (piesinio_id,vertintojas_id,spalvingumas,kompozicija,atitikimas,kurybiskumas) VALUES ('$pavid','$vertintojas','$spalvingumas','$kompozicija','$atitikimas','$kurybiskumas')";
	mysqli_query($db, $sql);
	
	
	if(mysqli_num_rows($result)==0)
	{
		$bendras=($spalvingumas+$kurybiskumas+$kompozicija+$atitikimas)/4;
	}
	else
	{
$spalvingumas1=0;
$kurybiskumas1=0;
$kompozicija1=0;
$atitikimas1=0;
while ($row = mysqli_fetch_array($result)) {
	$spalvingumas1= $spalvingumas1+$row['spalvingumas'];
	$kurybiskumas1= $kurybiskumas1+$row['kurybiskumas'];
	$kompozicija1= $kompozicija1+$row['kompozicija'];
	$atitikimas1= $atitikimas1+$row['atitikimas'];
}
$spalvingumas=$spalvingumas1+$spalvingumas;
$kurybiskumas=$kurybiskumas1+$kurybiskumas;
$kompozicija=$kompozicija1+$kompozicija;
$atitikimas=$atitikimas1+$atitikimas;
		
$rowsCount=mysqli_num_rows($result)+1;
$spalvingumas= $spalvingumas/$rowsCount;
$kurybiskumas= $kurybiskumas/$rowsCount;
$kompozicija= $kompozicija/$rowsCount;
$atitikimas= $atitikimas/$rowsCount;
$bendras=($spalvingumas+$kurybiskumas+$kompozicija+$atitikimas)/4;
}



	$sql1 = "UPDATE paveiksliukai SET bendras_vertinimas='$bendras' WHERE  id='$pavid'";
	mysqli_query($db, $sql1);
	$_SESSION['message']="Vertinimai prideti sėkmingai";
}
else{
$sql = "UPDATE vertinimai SET spalvingumas='$spalvingumas',kurybiskumas='$kurybiskumas',kompozicija='$kompozicija',atitikimas='$atitikimas' WHERE  piesinio_id='$pavid' AND vertintojas_id='$vertintojas'";
mysqli_query($db, $sql);
$result = mysqli_query($db, "SELECT * FROM vertinimai WHERE piesinio_id='$pavid' AND vertintojas_id <> '$vertintojas'");
$spalvingumas1=0;
$kurybiskumas1=0;
$kompozicija1=0;
$atitikimas1=0;
while ($row = mysqli_fetch_array($result)) {
	$spalvingumas1= $spalvingumas1+$row['spalvingumas'];
	$kurybiskumas1= $kurybiskumas1+$row['kurybiskumas'];
	$kompozicija1= $kompozicija1+$row['kompozicija'];
	$atitikimas1= $atitikimas1+$row['atitikimas'];
}
$spalvingumas=$spalvingumas1+$spalvingumas;
$kurybiskumas=$kurybiskumas1+$kurybiskumas;
$kompozicija=$kompozicija1+$kompozicija;
$atitikimas=$atitikimas1+$atitikimas;
$rowsCount=mysqli_num_rows($result)+1;
$spalvingumas= $spalvingumas/$rowsCount;
$kurybiskumas= $kurybiskumas/$rowsCount;
$kompozicija= $kompozicija/$rowsCount;
$atitikimas= $atitikimas/$rowsCount;
$bendras=($spalvingumas+$kurybiskumas+$kompozicija+$atitikimas)/4;

$sql1 = "UPDATE paveiksliukai SET bendras_vertinimas='$bendras' WHERE id='$pavid'";
mysqli_query($db, $sql1);
$_SESSION['message']="Vertinimai pakeisti sėkmingai";
}

header("Location:operacija2.php");exit;
}
