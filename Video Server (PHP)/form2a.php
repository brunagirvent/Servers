<? session_start(); ?>

<html>
	<head>
		<title> Verification form </title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="STYLESHEET" type="text/css" href="estilos.css">
		<link rel="STYLESHEET" type="text/css" href="tabla1.css">
		<link rel="STYLESHEET" type="text/css" href="tablar.css">
		<link rel="STYLESHEET" type="text/css" href="text.css">
	</head>

	<body>

		<? 
		
		// Include PHP file with functions		
		include('funciones.php'); 

		// Establishes a link with a database on a MySQL server
		$link=conectar_videos();
		
		if ((isset ($_SESSION['prof'])) && (isset($_SESSION['id_cliente'])) ) {
				
			echo "<table align='right' class='tabla1' border='0'>";
			echo "<tr> <td colspan =2  class='modo1' > You are logged in as: ".$_SESSION['prof']."</td></tr>";
			echo "<tr> <td class = 'modo1'  ><a href='modificar.php?borrar=0'> Delete video </a></td></tr>" ;
			echo "<tr><td class = 'modo1'> <a href='form1.php'> Upload video </td></tr>";
			echo "<tr> <td class = 'modo1'><a href='modificar.php?mod=0'> Add new category </td> </tr>";
			echo "<tr> <td class = 'modo1' colspan=2  ><a href='form1.php?logout=0'> Exit </a></td></tr>";
			echo "</table>";
					
					
			//Keep the variables that we collect on the route
			$name = $_POST["name"];
			$professor = $_SESSION['prof'];
			$Category = $_POST["Category"];
			$def = $_POST["def"];						
					
			if(!empty($name)){

				if ( $Category == "Courses") {
					$CategoryId == "1";
				}
				if ( $Category == "Thesis") {
					$CategoryId == "2";
				}
				if ( $Category == "Campus") {
					$CategoryId == "3";
				}

				$result=mysql_query("select NameTopic FROM Topic WHERE CategoryId='$CategoryId AND TopicId='$TopicId'",$link);

				while ($rowtopic = mysql_fetch_array($result) {

					// put every data from the database in different variables
					$NameTopic = $rowtopic[0];
		

					$counter = 1;

					//If the user picked for category "courses" then he has to show the 5 possible topics
					while ( $counter <= 5 ) {

						if (($CategoryId == "1") && ($TopicId == "1")) {
							$NameTopic1 = $NameTopic;
						}
						if (($CategoryId == "1") && ($TopicId == "2")) {
							$NameTopic2 = $NameTopic;
						}
						if (($CategoryId == "1") && ($TopicId == "3")) {
							$NameTopic3 = $NameTopic;
						}
						if (($CategoryId == "1") && ($TopicId == "4")) {
							$NameTopic4 = $NameTopic;
						}
						if (($CategoryId == "1") && ($TopicId == "5")) {
							$NameTopic5 = $NameTopic;
						}
						$counter = $counter + 1;
						$TopicId = $TopicId + 1;
					}


						?>									
						<table align="center" class = "tablar"  >
						<tr> <td align ="center" colspan =2 class ="modo1" > VIDEO tab 2 </td></tr>
						<form  enctype="multipart/form-data" action="form3.php" method="post" name="ftp" id="form_ftp" >

						<tr><th > Select topic:</th><td align="left" class = 'modo1'> <select name="Topic"> <option value="<? echo $NameTopic1 ?>" > <option value="<? echo $NameTopic2 ?>" > <option value="<? echo $NameTopic3 ?>" > <option value="<? echo $NameTopic4 ?>" > <option value="<? echo $NameTopic5 ?>" ></select></td></tr>
						<tr> <th > Video description: </th> <td class = "modo1" > <textarea name="desc" rows="7" cols="43" value= ""> </textarea> </td></tr>
						<tr><th > Select file:</th><td class = "modo1 "><input name="tmp_file" type="file"   id="tmp_file" /></td></tr>
				
						<input type="hidden" name="name" id="name" value="<? echo $name ?>" />
						<input type="hidden" name="professor" id="professor" value="<? echo $professor ?>" />
						<input type="hidden" name="Category" id="Category" value="<? echo $Category ?>" />
						<input type="hidden" name="def" id="def" value="<? echo $def ?>" />
								
						<input type="hidden" name="mode" id="mode" value="1" />
						<tr><td class ="modo1"> </td><td class = "modo1 "><input name="Submit" type="submit" value="Upload video" /><INPUT type="reset"></td></tr>
						</table>
						<?				
				}
			}
			else
			{

				?> <font  class="text"><p align="center" > You did not fill in the field name. </p><p align="center"> <a href=" form1.php"> Back </a> </p>  </font></center> <?
			}
		}

		?>
		
		
	</body>
	
</html>
