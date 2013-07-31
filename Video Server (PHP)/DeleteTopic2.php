<? session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Delete Topic</title>
	<link rel="STYLESHEET" type="text/css" href="text.css">
	<link rel="STYLESHEET" type="text/css" href="estilos.css">
	<link rel="STYLESHEET" type="text/css" href="tabla1.css"> 
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

	<?
	if ((isset ($_SESSION['prof'])) && (isset($_SESSION['id_cliente'])) ) {

		echo "<table align='right' class='tabla1' border='0'>";
		echo "<tr> <td colspan =2  class='modo1' > You are logged in as : ".$_SESSION['prof']."</td></tr>";
		echo "<tr> <td class = 'modo1'  ><a href='form1.php'> Upload video </td></tr>";
		echo "<tr> <td class = 'modo1'  ><a href='DeleteVideo1.php'> Delete video </a></td></tr>" ;
		echo "<tr> <td class = 'modo1'  ><a href='AddTopic.php'> Add new topic </td> </tr>";
		echo "<tr> <td class = 'modo1'  ><a href='DeleteTopic1.php'> Delete topic </a></td></tr>" ;
		echo "<tr> <td class = 'modo1' colspan=2  ><a href='form1.php?logout=0'> Exit </a></td></tr>";
		echo "</table>";
			
		$NameTopic = $_POST["name"];
		$clear = null;

		//check if they fill in the name of a topic
		if($NameTopic != "") {

			// Include PHP file with functions
			include('funciones.php');
		
			// connect to database
			$link=conectar_videos();

			// get data from database of the selected video			$result=mysql_query("SELECT newid,ThumbnailUrl FROM Topic WHERE NameTopic='$NameTopic'",$link);

			// Get the newid of the database of the selected name and put it in a variable
			while($rowtopic = mysql_fetch_array($result)){
				$idTopic = $rowtopic[0];
				$ThumbnailUrl = $rowtopic[1];
			}

			//Split up the Url so we can use the extension of the selected topic
			//Pay attension, this have to change when you give another url to an created topic.
			//Split the filename 
			$extension = explode(".", $ThumbnailUrl);

			//Take the 4th part of the url, so you only get the extension of the file and put it in a variable
			$ext = $extension[4];	

			// Make the right url of the file and put it in a variable
			$PictureUrl = "/opt/lampp/htdocs/projecte/thumbnails/Topic".$idTopic.".".$ext;

			// Make sure that the file isn't open, otherwise you can not delete the file.
			$fh = fopen($PictureUrl, 'w') or die("can't open file");
			fclose($fh);

			//Check if the topic excists otherwise delete the topic on the database 
			if (mysql_num_rows($result) == 0) {

				?> <font  class="text"><p align="center" > There is not an topic with the name:<?php echo $NameTopic; ?>. Please check if you spell it right! </p><p align="center"> <a href=" DeleteTopic1.php"> Back to delete topic. </a> </p>  </font></center> <?

			}
			else {
				// delete the picture of the selected topic on his located directory: /opt/lampp/htdocs/projecte/thumbnails/
				if(unlink($PictureUrl)){

					//Delete all de info of the topic on the database
					mysql_query("UPDATE Topic set NameTopic='$clear', ThumbnailUrl='$clear', DescriptionTopic='$clear' WHERE newid='$idTopic'",$link);
					
					// show message of succesful deleted topic
					?> <font  class="text"><p align="center" > The topic <?php echo $NameTopic; ?> is deleted </p><p align="center"> <a href=" DeleteTopic1.php"> Delete another topic. </a> </p>  </font></center> <?
				}
				else {
					?> <font class="text"><p align="center" >Sorry, failed in topic deleting.<a href= DeleteTopic1.php> Back to delete topic. </a> </p>  </font></center> <?
			
				}
			}

			//Released data from the result variable
			mysql_free_result($result);
		  
			//Close connection to database
			mysql_close($link); 
		}
		else {
			?> <font  class="text"><p align="center" > You did not enter a topic name. </p><p align="center"> <a href=" form1.php"> Implement the name of the topic. </a> </p>  </font></center> <?
	
		}	
	}
	else {
		?> <font  class="text"><p align="center" > You are not allowed to modify. </p> </font></center> <?
	}
			
	?>
</body>
</html>
