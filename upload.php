<?php
include 'include/nustatymai.php';
$statusMsg='';
$targetDir = 'uploads/';



if(isset($_POST['paveiksliukas']) && !empty($_FILES['file']['name']))
{		
		$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		$imageid=md5(uniqid());  
		$name=$_POST['pavad'];
		$authorID=$_SESSION['userid'];
		$theme=$_POST['tema'];
		$description=$_POST['image_text'];
		$fileName = basename($_FILES['file']['name']);
		$targetFilePath = $targetDir . $fileName;
		$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
		$allowTypes = array('jpg','png','jpeg');
		
		if(in_array($fileType,$allowTypes)){
			if(!file_exists($targetFilePath))
			{
				if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFilePath))
				{
					$sql = "INSERT into paveiksliukai (id,darbo_pavadinimas,autorius_id,tema,aprasymas,failo_pavadinimas) VALUES ('$imageid','$name','$authorID','$theme','$description','$fileName')";
					mysqli_query($db, $sql);

					$statusMsg = "Paveiksliukas įkeltas sėkmingai.";
				}
				else
				{
					$statusMsg = "Įvyko klaida įkeliant.";
				}
			}
			else
			{
				$statusMsg = "Toks failas jau yra";
			}
			
		}
		else
		{
			$statusMsg = "Netinkamas failo formatas";
		}
	
}
else
{
	$statusMsg = "Nepasirinktas joks paveiksliukas";
}
?>