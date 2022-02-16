<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose
session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location:logout.php");exit;}
include 'upload.php';
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
        <title>Įkelti paveikslėlį</title>
        <link href="styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
    <table><tr><td>
         <a class="back" href="index.php">Atgal į Pradžia</a>

      </td></tr>
	</table><br>
		<div class="container">
			<div class="upfrm">
				
				<?php if(!empty($statusMsg)){?>
				<p style="text-align:center;" class="status-msg"><?php echo $statusMsg; ?>
				<?php }?>
				
				<form action="" method="post" enctype="multipart/form-data" class="slaptazodis">
					Pasirinkite Paveiksliuką iš kompiuterio:
					<input type="file" name="file"><br>
					<p style="text-align:center;">Paveikslėlio pavadinimas:<br>
					<input type="text" name="pavad"><br>
					</p>
				
					<p style="text-align:center;">Komentaras: <br>
					<textarea id="text" cols="40" rows="4" name="image_text" placeholder="Paveikslėlio komentaras"></textarea><br>
					</p>
					<p style="text-align:center;">Paveikslėlio tema: <br>
					<input type="text" name="tema"><br>
					</p>
					<p style="text-align:center;">
					<input type="submit" name="paveiksliukas" value="Įkelti">
					</p>
				</form>
			</div>
			
		</div>
        <br>
	</body>
</html>
