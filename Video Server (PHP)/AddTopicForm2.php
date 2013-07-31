<? session_start(); ?>

<html>
	<head>
		<title> UPC Add new topic </title>
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
		
		// If you are logged in...		
		if ((isset ($_SESSION['prof'])) && (isset($_SESSION['id_cliente'])) ) {

			echo "<table align='right' class='tabla1' border='0'>";
			echo "<tr> <td colspan =2  class='modo1' > You are logged in as : ".$_SESSION['prof']."</td></tr>";
			echo "<tr> <td class = 'modo1'  ><a href='form1.php'> Upload video </td></tr>";
			echo "<tr> <td class = 'modo1'  ><a href='DeleteVideo1.php'> Delete video </a></td></tr>" ;
			echo "<tr> <td class = 'modo1'  ><a href='AddTopic.php'> Add new topic </td> </tr>";
			echo "<tr> <td class = 'modo1'  ><a href='DeleteTopic1.php'> Delete topic </a></td></tr>" ;
			echo "<tr> <td class = 'modo1' colspan=2  ><a href='form1.php?logout=0'> Exit </a></td></tr>";
			echo "</table>";			
			//convert all the posts to variables:
			$NewNameTopic = $_POST["NewNameTopic"];
			$NewDescriptionTopic = $_POST["TopicDescription"];
			$NewSelectedCategoryId = $_POST["NewSelectedCategoryId"];
			$ext = getextension ($_FILES['userfile']['name']);
			$One = "1";
			$Two = "2";
			$Three = "3";
			$Four = "4";
			$Five = "5";

			
			if(!empty($NewNameTopic)){

				// Connect to the database
				$link=conectar_videos();

				// Get all the data of each field and put them in a variable
				$result1 = MYSQL_QUERY("select NameTopic from Topic where CategoryId = '$NewSelectedCategoryId' and TopicId = '$One'",$link);
				while ($rowtopic1 = mysql_fetch_array($result1)) {
					$CheckNameTopic1 = $rowtopic1[0];
				}

				$result2 = MYSQL_QUERY("select NameTopic from Topic where CategoryId = '$NewSelectedCategoryId' and TopicId = '$Two'",$link);
				while ($rowtopic2 = mysql_fetch_array($result2)) {
					$CheckNameTopic2 = $rowtopic2[0];
				}

				$result3 = MYSQL_QUERY("select NameTopic from Topic where CategoryId = '$NewSelectedCategoryId' and TopicId = '$Three'",$link);
				while ($rowtopic3 = mysql_fetch_array($result3)) {
					$CheckNameTopic3 = $rowtopic3[0];
				}

				$result4 = MYSQL_QUERY("select NameTopic from Topic where CategoryId = '$NewSelectedCategoryId' and TopicId = '$Four'",$link);
				while ($rowtopic4 = mysql_fetch_array($result4)) {
					$CheckNameTopic4 = $rowtopic4[0];
				}

				$result5 = MYSQL_QUERY("select NameTopic from Topic where CategoryId = '$NewSelectedCategoryId' and TopicId = '$Five'",$link);
				while ($rowtopic5 = mysql_fetch_array($result5)) {
					$CheckNameTopic5 = $rowtopic5[0];
				}

				
				//If the topic already excist
				if(($CheckNameTopic1 == $NewNameTopic) || ($CheckNameTopic2 == $NewNameTopic) || ($CheckNameTopic3 == $NewNameTopic) || ($CheckNameTopic4 == $NewNameTopic)) {
					?> <font  class="text"><p align="center" > Sorry this topic already excist. Please change new topic name. </p><p align="center"> <a href=" AddTopic.php"> Change new topic name. </a> </p>  </font></center> <?
				}
				else {

					//if all the 5 avalible topics are taken, then give an overload
					if((!empty($CheckNameTopic1)) && (!empty($CheckNameTopic2)) && (!empty($CheckNameTopic3)) && (!empty($CheckNameTopic4)) && (!empty($CheckNameTopic5))){
						?> <font  class="text"><p align="center" > Overload of topics, please first delete a topic. </p><p align="center"> <a href=" AddTopic.php"> Delete topic </a> </p>  </font></center> <?
					}
					else {

						//category "Courses"
						if(($CheckNameTopic1 == "") && ($NewSelectedCategoryId == "1")) {
							$IdPicture = "1";
							$TopicId = "1";
						}

						if((!empty($CheckNameTopic1)) && ($CheckNameTopic2 == "") && ($NewSelectedCategoryId == "1")){
							$IdPicture = "2";
							$TopicId = "2";
						}

						if((!empty($CheckNameTopic1))&& (!empty($CheckNameTopic2)) && ($CheckNameTopic3 == "") && ($NewSelectedCategoryId == "1")){
							$IdPicture = "3";
							$TopicId = "3";
						}

						if((!empty($CheckNameTopic1))&& (!empty($CheckNameTopic2))  && (!empty($CheckNameTopic3)) && ($CheckNameTopic4 == "") && ($NewSelectedCategoryId == "1")){
							$IdPicture = "4";
							$TopicId = "4";
						}

						if((!empty($CheckNameTopic1))&& (!empty($CheckNameTopic2)) && (!empty($CheckNameTopic3))  && (!empty($CheckNameTopic4)) && ($CheckNameTopic5 == "") && ($NewSelectedCategoryId == "1")){
							$IdPicture = "5";
							$TopicId = "5";
						}


						//Category "Thesis"
						if(($CheckNameTopic1 == "") && ($NewSelectedCategoryId == "2")) {
							$IdPicture = "6";
							$TopicId = "1";
						}

						if((!empty($CheckNameTopic1)) && ($CheckNameTopic2 == "") && ($NewSelectedCategoryId == "2")){
							$IdPicture = "7";
							$TopicId = "2";
						}

						if((!empty($CheckNameTopic1))&& (!empty($CheckNameTopic2)) && ($CheckNameTopic3 == "") && ($NewSelectedCategoryId == "2")){
							$IdPicture = "8";
							$TopicId = "3";
						}

						if((!empty($CheckNameTopic1))&& (!empty($CheckNameTopic2))  && (!empty($CheckNameTopic3)) && ($CheckNameTopic4 == "") && ($NewSelectedCategoryId == "2")){
							$IdPicture = "9";
							$TopicId = "4";
						}

						if((!empty($CheckNameTopic1))&& (!empty($CheckNameTopic2)) && (!empty($CheckNameTopic3))  && (!empty($CheckNameTopic4)) && ($CheckNameTopic5 == "") && ($NewSelectedCategoryId == "2")){
							$IdPicture = "10";
							$TopicId = "5";
						}

					
						//Category "Campus"
						if(($CheckNameTopic1 == "") && ($NewSelectedCategoryId == "3")) {
							$IdPicture = "11";
							$TopicId = "1";
						}

						if((!empty($CheckNameTopic1)) && ($CheckNameTopic2 == "") && ($NewSelectedCategoryId == "3")){
							$IdPicture = "12";
							$TopicId = "2";
						}

						if((!empty($CheckNameTopic1))&& (!empty($CheckNameTopic2)) && ($CheckNameTopic3 == "") && ($NewSelectedCategoryId == "3")){
							$IdPicture = "13";
							$TopicId = "3";
						}

						if((!empty($CheckNameTopic1))&& (!empty($CheckNameTopic2))  && (!empty($CheckNameTopic3)) && ($CheckNameTopic4 == "") && ($NewSelectedCategoryId == "3")){
							$IdPicture = "14";
							$TopicId = "4";
						}

						if((!empty($CheckNameTopic1))&& (!empty($CheckNameTopic2)) && (!empty($CheckNameTopic3))  && (!empty($CheckNameTopic4)) && ($CheckNameTopic5 == "") && ($NewSelectedCategoryId == "3")){
							$IdPicture = "15";
							$TopicId = "5";
						}

						//the path with the file name where the file will be stored, upload is the directory name							
						$Thumbnail = "/opt/lampp/htdocs/projecte/thumbnails/Topic".$IdPicture.".".$ext;
						$ThumbnailUrl ="http://147.83.74.180/thumbnails/Topic".$IdPicture.".".$ext;
					
						// check if the picture is moved to his directory: /opt/lampp/htdocs/projecte/thumbnails
						if(move_uploaded_file ($_FILES['userfile']['tmp_name'], $Thumbnail)){

							//Give the uploaded file the full permissions, so the file can be deleted by every user.
							chmod ($Thumbnail, 0777);
						
							// Update the data of the topic on the database
							MYSQL_QUERY("update Topic set NameTopic='$NewNameTopic', DescriptionTopic='$NewDescriptionTopic', ThumbnailUrl='$ThumbnailUrl' where  CategoryId = '$NewSelectedCategoryId' and TopicId = '$TopicId'");
							?> <font class="text"><p align="center" >New topic <?php echo $NewNameTopic; ?> has been created.<a href= AddTopic.php> Back to add new topic </a> </p>  </font></center> <?
						}
						else {
							echo "Failed to upload file Contact Site admin to fix the problem";
						}
					}
				}	
			}
			else {
				?> <font  class="text"><p align="center" > You did not fill in the field name. </p><p align="center"> <a href=" AddTopic.php"> Back </a> </p>  </font></center> <?
			}
		}

		?>
				
	</body>
</html>
