<?php 
// forgotpass.php  jei nesiseka prisijungti
// is proclogin gauna:
// $_SESSION['name_login']  vartotojas
// $_SESSION['userid']  userid, bus slaptažodziui pirmi 4 simboliai
//                          !! jei e-paštu negaunate, atsirinkite 4 simbolius iš DB "userid" stulpelio
// $_SESSION['umail']   epaštas, kur pasiųsti 

session_start(); 
// cia sesijos kontrole
if (empty($_SESSION['name_login'])) { header("Location: logout.php");exit;}
  $_SESSION['prev'] = "forgotpass";
 ?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Negali prisijungti</title>
        <link href="styles.css" rel="stylesheet" type="text/css" >
    </head>
  <body>
    
       <table><tr><td>
           <a class="back" href="index.php">Atgal į Pradžia</a></td></tr>
       </table>               
        <table class="slaptazodis"> 
			<tr><td>
			<div align="center">
           		<font size="5" color="#000000"><b>Vartotojas <?php echo $_SESSION['name_login']; ?> negali prisijungti</b></font>
           		<br>
          	Jei paspausite "Tęsti" bus pakeistas slaptažodis.<br>
            Laikinas slaptažodis bus pasiųstas adresu <?php echo $_SESSION['umail']; ?><br><br>	 
				
            <table class="center">
              <form action="newpass.php" method="POST">  
	               <p style="text-align:center;">
                 <input class="button" type="submit" name="login" value="Tęsti">    
                 </p>
				
              </form> 
            </table>
		   </div>
			</td></tr>
	  </table>
   </body>
</html>




