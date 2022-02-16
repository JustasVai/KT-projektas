<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 
	echo "<link href=\"styles.css\" rel=\"stylesheet\" type=\"text/css\" >";
     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr class=\"c\"><td>";
        echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br>";
        echo "</td></tr><tr><td>";
        if ($_SESSION['user'] != "guest") {echo "<a class=\"a\" href=\"useredit.php\">Redaguoti paskyrą</a> &nbsp;&nbsp;";
        echo "<a class=\"a\" href=\"operacija1.php\">Įkelti paveikslėlį</a> &nbsp;&nbsp;";}
        echo "<a class=\"a\" href=\"operacija2.php\">Peržiūrėti visą galeriją</a> &nbsp;&nbsp;";
		echo "<a class=\"a\" href=\"operacija4.php\">Peržiūrėti TOP10 galeriją</a> &nbsp;&nbsp;";
        //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
        
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
            echo "<a class=\"a\" href=\"admin.php\">Administratoriaus sąsaja</a> &nbsp;&nbsp;";
        }
        echo "<a class=\"a\" href=\"logout.php\">Atsijungti</a>";
      echo "</td></tr></table>";
?>       
    
 