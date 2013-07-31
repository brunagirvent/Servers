<? session_start();?>




<html>


	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="STYLESHEET" type="text/css" href="estilos.css">
	<link rel="STYLESHEET" type="text/css" href="tabla.css">
	<link rel="STYLESHEET" type="text/css" href="tabla1.css">
	</head>
	<body >
	     
                
				
<?
				
				
				
				
	include("funciones.php");


	if (($_POST['login']!="") && ($_POST['password']!="")) 
	{
		//Set the username and password
		$login=$_POST['login'];
		$password=$_POST['password'];
		
		//If password or user is wrong do not enter

		if (($password=="") OR ($login==""))
		{
			echo "<table align='center' class='tabla1' border='0'>";
			echo "<tr> <td class ='modo1'  >User uncorrect</td></tr>";
			echo "<tr> <td class ='modo1'  ><a href='form1.php'>Back</a></td></tr>" ;
			echo "</table>";
		}

		else
		{
		$link=conectar_videos();

		$query = mysql_query("SELECT id,gestor,password FROM usuarios WHERE gestor = '$login'",$link) or die(mysql_error());
		$data = mysql_fetch_array($query);
		if($data['password'] != $password)
		{
			echo "<table align='center'  class='tabla1' border='0'>";
			echo "<tr> <td class ='modo1' >User uncorrect</td></tr>";
			echo "<tr> <td class ='modo1' ><a href='form1.php'>Back</a></td></tr>" ;
			echo "</table>";
		}
		else
		{ 
			$query = mysql_query("SELECT id,gestor,password FROM usuarios WHERE gestor = '$login'",$link) or die(mysql_error());
			$row = mysql_fetch_array($query);
			$_SESSION["prof"] = $row['gestor'];
			$_SESSION["id_cliente"] = $row['id'];
			
			echo "<table align='right' class='tabla1' border='0'>";
			echo "<tr> <td colspan =2  class='modo1' > You are logged in as : ".$_SESSION['prof']."</td></tr>";
			echo "<tr> <td class = 'modo1'  ><a href='form1.php'> Upload video </td></tr>";
			echo "<tr> <td class = 'modo1'  ><a href='DeleteVideo1.php'> Delete video </a></td></tr>" ;
			echo "<tr> <td class = 'modo1'  ><a href='AddTopic.php'> Add new topic </td> </tr>";
			echo "<tr> <td class = 'modo1'  ><a href='DeleteTopic1.php'> Delete topic </a></td></tr>" ;
			echo "<tr> <td class = 'modo1' colspan=2  ><a href='form1.php?logout=0'> Exit </a></td></tr>";
			echo "</table>";

			
		}
		}
	}
	else 
	{


			echo "<table align='center' class='tabla1' border='0'>";
			echo "<tr> <td class =  'modo1' >User uncorrect</td></tr>";
			echo "<tr> <td class = 'modo1' ><a href='form1.php'>Back</a></td></tr>" ;
			echo "</table>";
	}




?>
        </body>
</html>
