<? session_start();?>
	
<html>
	<head>
		<title> Delete Video </title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="STYLESHEET" type="text/css" href="tabla1.css"> 
		<link rel="STYLESHEET" type="text/css" href="tablar.css"> 
		<link rel="STYLESHEET" type="text/css" href="text.css"> 
		<link rel="STYLESHEET" type="text/css" href="estilos.css">
		
	</head>
	<body>
		<?		
			if (isset ($_GET["logout"])) {

					$_SESSION = array();
					
					echo "<table align='center' class='tabla1' border='0'>";
					echo "<form action='login.php' method='POST'>";
					echo "<tr> <td class = 'modo1' colspan =2> Administrator </td></tr><tr><th><b>User:</b></th>  <td class='modo1'> <input type='text' size='15'  name='login'></td></tr>";
					echo "<tr><th ><b>Password:</b> </th><td class='modo1'><input type='password' size='15' name='password'></td></tr> ";
					echo "<tr><td class='modo1' colspan=2><input type='submit' value='Login'></td></tr>";
					echo "</form> </table> "; 
			}
			
			else
			{
				if ( (isset ($_SESSION['prof'])) && (isset($_SESSION['id_cliente'])) )  
				{
					
					echo "<table align='right' class='tabla1' border='0'>";
					echo "<tr> <td colspan =2  class='modo1' > You are logged in as : ".$_SESSION['prof']."</td></tr>";
					echo "<tr> <td class = 'modo1'  ><a href='form1.php'> Upload video </td></tr>";
					echo "<tr> <td class = 'modo1'  ><a href='DeleteVideo1.php'> Delete video </a></td></tr>" ;
					echo "<tr> <td class = 'modo1'  ><a href='AddTopic.php'> Add new topic </td> </tr>";
					echo "<tr> <td class = 'modo1'  ><a href='DeleteTopic1.php'> Delete topic </a></td></tr>" ;
					echo "<tr> <td class = 'modo1' colspan=2  ><a href='form1.php?logout=0'> Exit </a></td></tr>";
					echo "</table>";
					
					?>					
					<table align="center"  class = 'tablar' >
			
					<!--Formulario para elejir el archivo a subir -->
					<form action="DeleteVideo2.php" method="post" name="ftp" id="form_ftp" >
					<tr><td class = 'modo1' colspan=2 align="center" > Delete Video </td></tr>
					<tr><th > Enter the Id of the video you want to delete:</td><td align="left" class = 'modo1'><input name ="name" type="text"  size="25" maxlength="20" value =""></td></tr>
					<tr><td class="modo1"></td><td class="modo1" align="center" ><input name="Submit" type="submit" value="Delete video" /><INPUT type="reset"></td></tr>
					</table>
									
					<?
		
		
				}
				else 
				{
 			
					echo "<table align='center' class='tabla1' border='0'>";
					echo "<form action='login.php' method='POST'>";
					echo "<tr> <td class = 'modo1' colspan =2> Administració </td></tr><tr><th><b>Usuari:</b></th>  <td class='modo1'> <input type='text' size='15'  name='login'></td></tr>";
					echo "<tr><th ><b>Password:</b> </th><td class='modo1'><input type='password' size='15' name='password'></td></tr> ";
					echo "<tr><td class='modo1' colspan=2><input type='submit' value='Login'></td></tr>";
					echo "</form> </table> "; 
				}
			}

	
		?>

	</body>

	
</html>
