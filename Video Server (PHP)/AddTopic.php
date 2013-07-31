<? session_start(); ?>
	
<html>
	<head>
		<title> Add New Topic </title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="STYLESHEET" type="text/css" href="tabla1.css"> 
		<link rel="STYLESHEET" type="text/css" href="tablar.css"> 
		<link rel="STYLESHEET" type="text/css" href="text.css"> 
		<link rel="STYLESHEET" type="text/css" href="estilos.css">
		
	</head>
	<body>
		<?		
	
	
			if (isset ($_GET["logout"]))
			{
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

					<!-- Define a form to generate a new topic -->
					<form enctype="multipart/form-data" action="AddTopicForm2.php" method="POST" name="ftp" id="form_ftp" >		

						<table align="center"  class = 'tablar' >					
						<tr><td class = 'modo1' colspan=2 align="center" > Add new topic </td></tr>						
						<!-- Select a category for the topic -->
						<tr><th > Select category:</th><td align="left" class = 'modo1'> 
						<select name="NewSelectedCategoryId"> <option value="1"> Courses <option value="2"> Thesis <option value="3"> Campus </select></td></tr>

						<!-- Enter title and description -->
						<tr><th > Title of new topic:</td><td align="left" class = 'modo1'>
						<input name ="NewNameTopic" type="text"  size="25" maxlength="20" value =""></td></tr>

						<tr><th > Topic description: </th> <td class = "modo1" > 
						<textarea name="TopicDescription" rows="7" cols="43" value= ""> </textarea> </td></tr>

						<!-- Choose a file on disk as a picture -->
						<tr> <th > Select picture:</th><td class = "modo1 ">
						<input name="userfile" type="file"/></td></tr>

						<!-- Button to submit the data -->
						<tr><td class="modo1"></td><td align="center" >
						<input name="Submit" type="submit" class="modo1" id="upload" value="Create new topic" /><INPUT type="reset"></td></tr>
						</table>
					</form>
								
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
