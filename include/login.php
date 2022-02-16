
<?php
	//Login forma 
	if (!isset($_SESSION)) { header("Location: logout.php");exit;}
	$_SESSION['prev'] = "login";
	include("include/nustatymai.php");

?>      <link href="styles.css" rel="stylesheet" type="text/css" >
		<header class="title"> 
			Piešinių konkursas
		</header>
		<body>
		
		<form action="proclogin.php" method="POST" class="login">        
			
        <center style="font-size:18pt;"><b>Prisijungimas</b></center>
			
        <p style="text-align:center;">Vartotojo vardas:<br>
            <input class ="s1" name="user" type="text" value="<?php echo $_SESSION['name_login'];  ?>"/><br>
            <?php echo $_SESSION['name_error']; 
			?>
        </p>
		
        <p style="text-align:center;">Slaptažodis:<br>
            <input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"/><br>
            <?php echo $_SESSION['pass_error']; 
			?>
        </p>  
        <p style="text-align:center;">
            <input class="logbtnl" type="submit" name="login" value="Prisijungti"/>   
            <input class="logbtn" type="submit" name="problem" value="Pamiršote slaptažodį?"/>   
        </p>
        <p style="text-align:center;">
<?php
			if ($uregister!="admin") {echo "<a href=\"register.php\">Registracija</a>";}
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"guest.php\">Svečias</a>";
?>
        </p>     
    </form>
</body>