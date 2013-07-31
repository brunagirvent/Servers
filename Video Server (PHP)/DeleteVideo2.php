<? session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Delete Video</title>
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
			
		$id = $_POST["name"];

		if(!empty($id)) {

			// Include PHP file with functions
			include('funciones.php');
			// Include PHP file which generate an XML file with database contents
			include ('/opt/lampp/htdocs/projecte/iPhone/generateXML.php');
		
			// connect to database
			$link=conectar_videos();

			// get data from database of the selected video
			$result=mysql_query("SELECT urlLow,urlStd,urlHigh FROM videos WHERE id='$id'",$link);

			// Get the newid of the database of the selected name and put it in a variable
			while ($rowvideos = mysql_fetch_array($result)) {	

				$UrlLow = $rowvideos[0];
				$UrlStd = $rowvideos[1];
				$UrlHigh = $rowvideos[2];
			}

			// If there are no videos on the database, show message
			if (mysql_num_rows($result) == 0) {

				?> <font  class="text"><p align="center" > There are no videos under this id number. </p><p align="center"> <a href=" form1.php"> Please upload a video first. </a> </p>  </font></center> <?

			}
			else {

				// The url of the located thumbnail to delete.
				$DeleteThumbnail = "/opt/lampp/htdocs/projecte/thumbnails/".$id.".jpg";

				// If there are 3 definition formats of the selected video then delete all 3.
				if( (!empty($UrlHigh)) && (!empty($UrlStd)) && (!empty($UrlLow)) ) {

					//Split up the Url so we can use the extension of the selected video
					//Pay attension, this have to change when you give another url to an uploaded video.

					// Split the filename of the high definition video and put the extension in a variable 
					$extensionHigh = explode(".", $UrlHigh);

					//Take the 4th part of the url, so you only get the extension of the file and put it in a variable
					$extHigh = $extensionHigh[4];

					// create the urls for the definition formats to delete.
					$DeleteHigh = "/opt/lampp/htdocs/projecte/videos/high/".$id.".".$extHigh;
					$DeleteStd = "/opt/lampp/htdocs/projecte/videos/standard/".$id.".MPG";
					//$DeleteLow = "/opt/lampp/htdocs/projecte/videos/low/".$id.".mp4";      
					$DeleteLow = "/opt/lampp/htdocs/projecte/videos/low/".$id."-index.m3u8";
					$DeleteLowDirectory = "/opt/lampp/htdocs/projecte/videos/low/".$id;
		
					 //Delete directory that contains iPhone video files
					 $removeDir= "rm -r $DeleteLowDirectory";
					 system($removeDir);

					// check if they are deleted otherwise show message of unsuccesful deleting
					if ((unlink($DeleteHigh)) && (unlink($DeleteStd)) && (unlink($DeleteLow))  && (unlink($DeleteThumbnail))) {
					
						// Delete selected row in the datebase.
						MYSQL_QUERY("DELETE from videos WHERE id='$id'",$link);	

						// XML generation 
						 // generate the xml file to iPhone player
						 generate_xml();

						// show message of succesful deleted video
						?> <font  class="text"><p align="center" > The videos are deleted. </p><p align="center"> <a href=" DeleteVideo1.php"> Delete another video. </a> </p>  </font></center> <?				
						
					}
					else {

						// show message if the mission " delete videos" failed
						?> <font class="text"><p align="center" >Sorry, failed in video deleting.<a href= DeleteVideo1.php> Back to delete video. </a> </p>  </font></center> <?

					}
				}

				// If there are 2 definition formats of the selected video then delete only those two.
				if(($UrlHigh == "") && (!empty($UrlStd)) && (!empty($UrlLow))) {

					//Split up the Url so we can use the extension of the selected video
					//Pay attension, this have to change when you give another url to an uploaded video.

					// Split the filename of the high definition video and put the extension in a variable 
					$extensionStd = explode(".", $UrlStd);

					//Take the 4th part of the url, so you only get the extension of the file and put it in a variable
					$extStd = $extensionStd[4];

					// create the urls for the definition formats to delete.
					$DeleteStd = "/opt/lampp/htdocs/projecte/videos/standard/".$id.".".$extStd;
					//$DeleteLow = "/opt/lampp/htdocs/projecte/videos/low/".$id.".mp4";
					$DeleteLow = "/opt/lampp/htdocs/projecte/videos/low/".$id."-index.m3u8";
					$DeleteLowDirectory = "/opt/lampp/htdocs/projecte/videos/low/".$id;

					 //Delete directory that contains iPhone video files
					 $removeDir= "rm -r $DeleteLowDirectory";
					 system($removeDir);

					// check if they are deleted otherwise show message of unsuccesful deleting
					if ((unlink($DeleteStd)) && (unlink($DeleteLow)) && (unlink($DeleteThumbnail))) {
						
						// Delete selected row in the datebase.
						MYSQL_QUERY("DELETE from videos WHERE id='$id'",$link);	

						// XML generation 
						 // generate the xml file to iPhone player
						 generate_xml();

						// show message of succesful deleted video
						?> <font  class="text"><p align="center" > The videos are deleted. </p><p align="center"> <a href=" DeleteVideo1.php"> Delete another video. </a> </p>  </font></center> <?	
						
					}
					else {

						// show message if the mission " delete videos" failed
						?> <font class="text"><p align="center" >Sorry, failed in video deleting.<a href= DeleteVideo1.php> Back to delete video. </a> </p>  </font></center> <?

					}				
				}

				// If there is just one definition format of the selected video (low definition) then delete this one.
				if(($UrlHigh == "") && ($UrlStd == "") && (!empty($UrlLow))) {

					//Split up the Url so we can use the extension of the selected video
					//Pay attension, this have to change when you give another url to an uploaded video.

					// Split the filename of the high definition video and put the extension in a variable 
					$extensionLow = explode(".", $UrlLow);

					//Take the 4th part of the url, so you only get the extension of the file and put it in a variable
					$extLow = $extensionLow[4];

					// create the urls for the definition formats to delete.
					//$DeleteLow = "/opt/lampp/htdocs/projecte/videos/low/".$id.".".$extLow;
					$DeleteLow = "/opt/lampp/htdocs/projecte/videos/low/".$id."-index.m3u8";
					$DeleteLowDirectory = "/opt/lampp/htdocs/projecte/videos/low/".$id;

					 //Delete directory that contains iPhone video files
					 $removeDir= "rm -r $DeleteLowDirectory";
					 system($removeDir);

					// check if they are deleted otherwise show message of unsuccesful deleting
					if ((unlink($DeleteLow)) && (unlink($DeleteThumbnail))) {

						// Delete selected row in the datebase.
						MYSQL_QUERY("DELETE from videos WHERE id='$id'",$link);	

						 // XML generation 
						 // generate the xml file to iPhone player
						 generate_xml();

						// show message of succesful deleted video
						?> <font  class="text"><p align="center" > The videos are deleted. </p><p align="center"> <a href=" DeleteVideo1.php"> Delete another video. </a> </p>  </font></center> <?	
						
					}
					else {

						// show message if the mission " delete video" failed
						?> <font class="text"><p align="center" >Sorry, failed in video deleting.<a href= DeleteVideo1.php> Back to delete video. </a> </p>  </font></center> <?

					}				
				}				
			}
			
			//Released data from the result variable
			mysql_free_result($result);
		  
			//Close connection to database
			mysql_close($link); 
		}
		else {
			?> <font  class="text"><p align="center" > You did not enter a Id number. </p><p align="center"> <a href=" form1.php"> Implement Id number of video. </a> </p>  </font></center> <?
	
		}	
	}
	else {
		?> <font  class="text"><p align="center" > You are not allowed to modify. </p> </font></center> <?
	}
			
	?>
</body>
</html>
