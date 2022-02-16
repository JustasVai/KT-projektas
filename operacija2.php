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
        <title>Galerija</title>
		<center><b><?php echo $_SESSION['message']; ?></b></center>
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
			
			
				 	
					<h2 align="center" class="title">Galerija</h2>
					
					<?php 
						$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
					    $result = mysqli_query($db, "SELECT * FROM paveiksliukai");
						
    					while ($row = mysqli_fetch_array($result)) {
						$author = $row['autorius_id'];
						$sql="SELECT vardas,pavarde FROM vartotojas WHERE userid='$author'";
						$paveikID=$row['id'];
						
						$sql1="SELECT * FROM vertinimai WHERE piesinio_id='$paveikID'";
						$vertinimai= mysqli_query($db, $sql1);
						
						$surn = mysqli_query($db, $sql);
						$resultatai= mysqli_fetch_array($surn);
						$vardas=$resultatai['vardas'];
						$pavarde=$resultatai['pavarde'];
						$title = $row['darbo_pavadinimas'];
						$theme = $row['tema'];
						$description = $row['aprasymas'];
						$spalvingumas=0;// $rezVertinimai['spalvingumas'];
						$kurybiskumas=0; //$rezVertinimai['kurybiskumas'];
						$kompozicija=0; //$rezVertinimai['kompozicija'];
						$atitikimas=0; //$rezVertinimai['atitikimas'];
						while($row1 = mysqli_fetch_array($vertinimai))
						{
							$spalvingumas= $spalvingumas+$row1['spalvingumas'];
							$kurybiskumas= $kurybiskumas+$row1['kurybiskumas'];
							$kompozicija= $kompozicija+$row1['kompozicija'];
							$atitikimas= $atitikimas+$row1['atitikimas'];
						}
						if(mysqli_num_rows($vertinimai) == 0)
						{
							$spalvingumas= "Neįvertinta";
							$kurybiskumas= "Neįvertinta";
							$kompozicija= "Neįvertinta";
							$atitikimas="Neįvertinta";
							$bendras="Neįvertinta";
						}
						else{
						$rowsCount=mysqli_num_rows($vertinimai);
						$spalvingumas= $spalvingumas/$rowsCount;
						$kurybiskumas= $kurybiskumas/$rowsCount;
						$kompozicija= $kompozicija/$rowsCount;
						$atitikimas= $atitikimas/$rowsCount;
						$bendras=($spalvingumas+$kurybiskumas+$kompozicija+$atitikimas)/4;
						}
						
						?>
						
						<?php
						if($_SESSION['ulevel'] == $user_roles[ADMIN_LEVEL] || $_SESSION['ulevel'] == $user_roles[VERTINTOJAS_LEVEL])
						{
						echo "<div id='img_div'>";
							
      					echo "<a href=\"operacijavertinimas.php?autorius=$author&paveiksloid=$paveikID&bendras=$bendras\"><img src='uploads/".$row['failo_pavadinimas']."' ></a>";
						
						echo "<p style=\"float: left;\"><b>Darbo pavadinimas:</b> $title</p>";
						echo "<p style=\"float: left;\"><b>Autorius:</b> $vardas $pavarde</p>";
						echo "<p style=\"float: left;\"><b>Tema:</b> $theme</p>";
						echo "<p><b>Darbo aprašymas:</b> $description</p>";
						echo "<h3 align=\"left\" class=\"ada\">Vertinimas: </h3>";
						echo "<p style=\"float: left;\"><b>Spalvingumas:</b> $spalvingumas</p>";
						echo "<p style=\"float: left;\"><b>Kompozicija:</b> $kompozicija</p>";
						echo "<p style=\"float: left;\"><b>Atitikimas:</b> $atitikimas</p>";
						echo "<p style=\"float: left;\"><b>Kūrybiškumas:</b> $kurybiskumas</p>";
						echo "<p style=\"float: left;\"><b>Bendras įvertinimas:</b> $bendras</p>";
      					echo "</div>";
						}
						else
						{
      					echo "<div id='img_div'>";
      					echo "<img src='uploads/".$row['failo_pavadinimas']."' >";
					
						echo "<p style=\"float: left;\"><b>Darbo pavadinimas:</b> $title</p>";
						echo "<p style=\"float: left;\"><b>Autorius:</b> $vardas $pavarde</p>";
						echo "<p style=\"float: left;\"><b>Tema:</b> $theme</p>";
						echo "<p><b>Darbo aprašymas:</b> $description</p>";
						echo "<h3 align=\"left\" class=\"ada\">Vertinimas: </h3>";
						echo "<p style=\"float: left;\"><b>Spalvingumas:</b> $spalvingumas</p>";
						echo "<p style=\"float: left;\"><b>Kompozicija:</b> $kompozicija</p>";
						echo "<p style=\"float: left;\"><b>Atitikimas:</b> $atitikimas</p>";
						echo "<p style=\"float: left;\"><b>Kūrybiškumas:</b> $kurybiskumas</p>";
						echo "<p style=\"float: left;\"><b>Bendras įvertinimas:</b> $bendras</p>";
      					echo "</div>";
						
    					}	
						}
  					?>
				
			</div>
        <br>
	</body>
</html>

