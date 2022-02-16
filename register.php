<?php
// register.php registracijos forma
// jei pats registruojasi rolė = DEFAULT_LEVEL, jei registruoja ADMIN_LEVEL vartotojas, rolę parenka
// Kaip atsiranda vartotojas: nustatymuose $uregister=
//                                         self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai galimi
// formos laukus tikrins procregister.php

session_start();
if (empty($_SESSION['prev'])) { header("Location: logout.php");exit;} // registracija galima kai nera userio arba adminas
// kitaip kai sesija expirinasi blogai, laikykim, kad prev vistik visada nustatoma
include("include/nustatymai.php");
include("include/functions.php");
if ($_SESSION['prev'] != "procregister")  inisession("part");  // pradinis bandymas registruoti

$_SESSION['prev']="register";
?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Registracija</title>
            <link href="styles1.css" rel="stylesheet" type="text/css" >
			
        </head>
		
        <body class="a">
                        <table><tr><td>
                           <a class="atgal" href="index.php">Atgal į Pradžia</a></td></tr>
				        </table>   
								<div align="center">
                    			<table> <tr><td>
                                    <form action="procregister.php" method="POST" class="login">              
                                                <center style="font-size:18pt;"><b>Registracija</b></center>
										
									<p style="text-align:center;">Vartotojo vardas:<br>
            						<input class ="s1" name="Vvardas" type="text" value="<?php echo $_SESSION['name_login'];  ?>"><br>
           							<?php echo $_SESSION['name_error']; ?>
        							</p>
										
       								<p style="text-align:center;">Slaptažodis:<br>
          							<input class ="s1" name="slaptazodis" type="password" value="<?php echo $_SESSION['pass_login']; ?>"><br>
            						<?php echo $_SESSION['pass_error']; ?>
        							</p>
										
									<p style="text-align:center;">Vardas:<br>
          							<input class ="s1" name="vardas" type="text" ><br>
            						
        							</p>  
										
									<p style="text-align:center;">Pavardė:<br>
          							<input class ="s1" name="pavarde" type="text" ><br>
            						
        							</p>
										
									<p style="text-align:center;">Gimimo data:<br>
          							<input class ="s1" name="data" type="date" value="<?php echo $_SESSION['date_login']; ?>"><br>
            						
        							</p>  
										
									<p style="text-align:center;">E-paštas:<br>
                                    <input class ="s1" name="epastas" type="text" value="<?php echo $_SESSION['mail_login']; ?>"><br>
									<?php echo $_SESSION['mail_error']; ?>
                                    </p>  
										
									<?php
										 if ($_SESSION['ulevel'] == $user_roles[ADMIN_LEVEL] )
										{echo "<p style=\"text-align:center;\">Rolė<br>";
										 echo "<select name=\"role\">";
   									   	 foreach($user_roles as $x=>$x_value)
  											{echo "<option ";
        	 									if ($x == DEFAULT_LEVEL) echo "selected ";
             									echo "value=\"".$x_value."\" ";
         	 									echo ">".$x."</option></p>";
											}
										}
									?>
                      	
                                    <p style="text-align:center;">
                                    <input class="logbtn" type="submit" value="Registruoti">
                                    </p>
                                    </form>
                                    </td></tr>
			                    </table>
                             </div>
                
                          
        </body>
    </html>
   
