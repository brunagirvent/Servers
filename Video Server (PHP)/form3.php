<? session_start () ?>
<html>
	<head>
		<title>UPC Video Upload</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="STYLESHEET" type="text/css" href="estilos.css">
		<link rel="STYLESHEET" type="text/css" href="tabla1.css">
		<link rel="STYLESHEET" type="text/css" href="tablar.css">
		<link rel="STYLESHEET" type="text/css" href="text.css">
	</head>

	<body >
	
		<?
		// Include PHP file with functions
		include('funciones.php'); 
		// Include PHP file which generate an XML file with database contents
		include ('/opt/lampp/htdocs/projecte/iPhone/generateXML.php');
		
		echo "<table align='right' class='tabla1' border='0'>";
		echo "<tr> <td colspan =2  class='modo1' > You are logged in as : ".$_SESSION['prof']."</td></tr>";
		echo "<tr> <td class = 'modo1'  ><a href='form1.php'> Upload video </td></tr>";
		echo "<tr> <td class = 'modo1'  ><a href='DeleteVideo1.php'> Delete video </a></td></tr>" ;
		echo "<tr> <td class = 'modo1'  ><a href='AddTopic.php'> Add new topic </td> </tr>";
		echo "<tr> <td class = 'modo1'  ><a href='DeleteTopic1.php'> Delete topic </a></td></tr>" ;
		echo "<tr> <td class = 'modo1' colspan=2  ><a href='form1.php?logout=0'> Exit </a></td></tr>";
		echo "</table>";
			
			//convert all the posts to variables:
			$name = $_POST["name"];
			$professor = $_POST["professor"];
			$ext = getextension ($_FILES['videofile']['name']);
			$def = $_POST["def"];
			$CategoryId = $_POST["CategoryId"];
			$NameCategory = $_POST["Category"];
			$TopicId = $_POST["Topic"];
			$date = time ();
			$data = date ( "d-m-Y" , $date ); 
			$mode = $_POST["mode"]; 
			$desc = $_POST["desc"];						
			

			// Establishes a link with a database on a MySQL server
			$link=conectar_videos();

			$result=mysql_query("select NameTopic from Topic where TopicId = '$TopicId' AND CategoryId = '$CategoryId'",$link);

			while ($rowtopic = mysql_fetch_array($result)) {
				$NameTopic = $rowtopic[0];
			}

			if($NameTopic == "") {

				?> <font  class="text"> <p align="center"> You did not select a topic, please try again. <a href= form1.php> Back to upload video </a> </p>  </font></center> <?	
			
			}
			else {

				// Adding to the database the URLs for different video versions and thumbnail
				$id = addVisualDataUrlsToDatabase ($name,$professor,$data,$NameCategory,$NameTopic,$CategoryId,$TopicId,$ext,$desc,$def);
							
				// the input video file
				$video = "/opt/lampp/htdocs/projecte/videos/".$def."/".$id.".".$ext;

				// path to ffmpeg
				$ffmpeg = "/usr/local/bin/ffmpeg";				

				// Convert video

				// If the implemented video is a high definition version, then generate standard and low definition
				if($def == "high") {

					// move the selected video and save it in the selected directory
					if(move_uploaded_file ($_FILES['videofile']['tmp_name'], $video)) {

						//Give the uploaded file the full permissions, so the file can be deleted by every user.
						chmod ($video, 0777);

						// Where the Standard definition video will be saved
						$standdefinition = "/opt/lampp/htdocs/projecte/videos/standard/".$id.".MPG";

						// generate standard definition video
						$defstandcmd = "$ffmpeg -i $video -acodec libmp3lame -vcodec mpeg2video $standdefinition";
						exec ($defstandcmd);

						//Give the uploaded file the full permissions, so the file can be deleted by every user.
						chmod ($standdefinition, 0777);

						/*
						// Where the low definition video will be saved
						$lowdefinition = "/opt/lampp/htdocs/projecte/videos/low/".$id.".mp4";

						// generate low definition video
						$deflowcmd = "$ffmpeg -i $video -acodec libfaac -vcodec libx264 $lowdefinition";
						exec ($deflowcmd);
						
						//Give the uploaded file the full permissions, so the file can be deleted by every user.
						chmod ($lowdefinition, 0777);
						*/

						// Where the low definition video will be saved
						$lowdefinition = "/opt/lampp/htdocs/projecte/videos/low/".$id."-index.m3u8";
					
						//Where the script to adapt video to iPhone quality is saved
						$script = "/opt/lampp/htdocs/projecte/iPhone/adaptVideoiPhone.sh";
						
						//adaptVideo $video=input video file $name=name video
						exec ("$script $video $id");

						?> <font class="text"><p align="center" >The 3 definition videos has been uploaded succesful.<a href= form1.php> Back to upload video </a> </p>  </font></center> <?
					}
					else {
						echo "Failed to upload file Contact Site admin to fix the problem";
					}

				}
					
				// If the implemented video is a standard definition version, then generate only low definition
				if($def == "standard") {

					// move the selected video and save it in the selected directory
					if(move_uploaded_file ($_FILES['videofile']['tmp_name'], $video )) {

						//Give the uploaded file the full permissions, so the file can be deleted by every user.
						chmod ($video, 0777);
						
						/*
						// Where the low definition video will be saved
						$lowdefinition = "/opt/lampp/htdocs/projecte/videos/low/".$id.".mp4";
					
						// generate low definition video
						$deflowcmd = "$ffmpeg -i $video -acodec libfaac -vcodec libx264 $lowdefinition";
						exec ($deflowcmd);

						//Give the uploaded file the full permissions, so the file can be deleted by every user.
						chmod ($lowdefinition, 0777);
						*/

						// Where the low definition video will be saved
						$lowdefinition = "/opt/lampp/htdocs/projecte/videos/low/".$id."-index.m3u8";
					
						//Where the script to adapt video to iPhone quality is saved
						$script = "/opt/lampp/htdocs/projecte/iPhone/adaptVideoiPhone.sh";
						
						//adaptVideo $video=input video file $name=name video
						exec ("$script $video $id");

						?> <font class="text"><p align="center" >The 2 definition videos has been uploaded succesful.<a href= form1.php> Back to upload video </a> </p>  </font></center> <?
					}
					else {
						echo "Failed to upload file Contact Site admin to fix the problem";
					}
				}

				// If the implemented video is a low definition version, then only copy the selected low defintion video to the directory
				if($def == "low") {
				    
					// move the selected video and save it in the selected directory
					if(move_uploaded_file ($_FILES['videofile']['tmp_name'], $video )) {

					      //Give the uploaded file the full permissions, so the file can be deleted by every user.
					      chmod ($video, 0777);
					  
					      // Where the low definition video will be saved
					      $lowdefinition = "/opt/lampp/htdocs/projecte/videos/low/".$id."-index.m3u8";
					
					      //Where the script to adapt video to iPhone quality is saved
					      $script = "/opt/lampp/htdocs/projecte/iPhone/adaptVideoiPhone.sh";
						
					      //adaptVideo $video=input video file $name=name video
					      exec ("$script $video $id");
		
					      ?> <font class="text"><p align="center" >The selected definition video has been uploaded succesful.<a href= form1.php> Back to upload video </a> </p>  </font></center> <?

					}
					else {
						echo "Failed to upload file Contact Site admin to fix the problem";
					}
					 
				}


				// Thumbnail generation - Just one thumbnail for the 3 video versions
															
				// where the keyframe will be saved
				$thumbnail = "/opt/lampp/htdocs/projecte/thumbnails/".$id.".jpg";
					
				// default time to get the keyframe
				$second = 1;

				// generate the thumbnail
				$thumbcmd = "$ffmpeg -i $video -deinterlace -an -ss $second -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg -s 200x150 $thumbnail";
				exec($thumbcmd);

				//Give the uploaded file the full permissions, so the file can be deleted by every user.
				chmod ($thumbnail, 0777);

				// XML generation 
			        // generate the xml file to iPhone player
				generate_xml();
				
				//Delete video low
				if($def == "low") {
				    unlink($video);
				}
			}
	

		?>
				
	</body>
</html>


