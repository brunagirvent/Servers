<? session_start();?>
		

<html>


	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /
	<link rel="STYLESHEET" type="text/css" href="estilos.css">
	<link rel="STYLESHEET" type="text/css" href="tabla.css">
	<link rel="STYLESHEET" type="text/css" href="tabla1.css">
	</head>
	
	
	<body >
	
	     <div  id="button"    >
                      <ul >
                                <!-- CSS Tabs -->
			<li><a href="body.php" target="body"  >Home</a></li>
			<li><a href="body.php?novetats=novetats" target="body"  >Novetats</a></li>
			<li><a href="body.php?pfc=pfc" target="body" name="pfc">PFC</a></li>
			<li><a href="body.php?docencia=docencia" target="body" name="docencia">Docencia</a></li>
			<li><a href="body.php?euetit=euetit" target="body" name="euetit">EUETIT</a></li>
			<li><a href="body.php?socrates=socrates" target="body" name="socrates">Socrates</a></li>
			<li><a href="body.php?estudiants=estudiants" target="body" name="estudiants" >Estudiants</a></li>
			<li><a href="body.php?vilaweb=vilaweb" target="body" name="vilaweb">Vilaweb</a></li>
			<li><a href="body.php?webcam=webcam" target="body" name="webcam">Webcam</a></li>
			<li><a href="form1.php" target="body">Pujar videos</a></li>
			

                        </ul>
                </div>
				
				
				
		<?		
			if (isset ($_GET["logout"]))
			{
					$_SESSION = array();
					echo "<table class='tabla1' border='0'>";
					echo "<form action='login.php' method='POST'>";
					echo "<tr><th><b>Usuari:</b></th></tr><tr><td class='modo1'> <input type='text' size='15'  name='login'></td></tr>";
					echo "<tr><th ><b>Password:</b> </th></tr><tr><td class='modo1'><input type='password' size='15' name='password'></td></tr>";
					echo "<tr><th align='center' colspan=2><input type='submit' value='Login'></th></tr>";
					echo "</form> </table> </body></html>"; 
			}
			else
			{
				if ((isset ($_SESSION['prof'])) && (isset($_SESSION['id_cliente'])) )  
				{
					echo "<table class='tabla1' border='0'>";
					echo "<tr> <th >Has ingressat com : ".$_SESSION['prof']."</th></tr>";
					echo "<tr> <th ><a href='right.php?logout=0'>Sortir</a></th></tr>" ;
					echo "</table>";
				}
				else 
				{
 			
					echo "<table class='tabla1' border='0'>";
					echo "<form action='login.php' method='POST'>";
					echo "<tr><th><b>Usuari:</b></th></tr><tr><td class='modo1'> <input type='text' size='15'  name='login'></td></tr>";
					echo "<tr><th ><b>Password:</b> </th></tr><tr><td class='modo1'><input type='password' size='15' name='password'></td></tr>";
					echo "<tr><th align='center' colspan=2><input type='submit' value='Login'></th></tr>";
					echo "</form> </table> </body></html>"; 
		
				}
			}
?>
        </body>
</html>
