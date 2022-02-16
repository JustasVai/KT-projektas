<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose
include 'upload.php';
session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "patvirtinimas") )
{ header("Location:logout.php");exit;}

?>
<style type="text/css">
   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 300px;
   }
</style>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>TOP10 Galerija</title>
		
        <link href="styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
    <table><tr><td>
         <a class="back" href="index.php">Atgal į Pradžia</a>
      </td></tr>
	</table><br>
		<div class="container">
			<div class="upfrm">
			</div>
			
			
				 	
					<h2 align="center" class="title">TOP10 Galerija</h2>
					
					<?php 
						$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
					    $result = mysqli_query($db, "SELECT * FROM paveiksliukai ORDER BY bendras_vertinimas DESC");
						$rowsCount = 0;
    					while ($row = mysqli_fetch_array($result)) {
						if($rowsCount<10)
						{
							
						$author = $row['autorius_id'];
						$sql="SELECT vardas,pavarde FROM vartotojas WHERE userid='$author'";
						$paveikID=$row['id'];
						$surn = mysqli_query($db, $sql);
						$resultatai= mysqli_fetch_array($surn);
						$vardas=$resultatai['vardas'];
						$pavarde=$resultatai['pavarde'];
						$title = $row['darbo_pavadinimas'];
						$theme = $row['tema'];
						$description = $row['aprasymas'];
						$bendras=$row['bendras_vertinimas'];
						
						echo "<div id='img_div'>";
      					echo "<img src='uploads/".$row['failo_pavadinimas']."' >";
					
						echo "<p style=\"float: left;\"><b>Darbo pavadinimas:</b> $title</p>";
						echo "<p style=\"float: left;\"><b>Autorius:</b> $vardas $pavarde</p>";
						echo "<p style=\"float: left;\"><b>Tema:</b> $theme</p>";
						echo "<p><b>Darbo aprašymas:</b> $description</p>";
						echo "<h3 align=\"left\" class=\"ada\">Vertinimas: </h3>";
						echo "<p style=\"float: left;\"><b>Bendras įvertinimas:</b> $bendras</p>";
      					echo "</div>";
						}
						$rowsCount= $rowsCount+1;
						
						}
							
						
						?>
						
					
				
			</div>
        <br>
	</body>
</html>


