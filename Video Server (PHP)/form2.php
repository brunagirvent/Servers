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
			$name = $_POST["name"];
			$professor = $_SESSION['prof'];
			$Category = $_POST["Category"];
			$def = $_POST["def"];						
					
			if(!empty($name)){

				?>									
				<table align="center" class = "tablar"  >
				<tr> <td align ="center" colspan =2 class ="modo1" > You selected as Category: <?php echo $_POST["Category"]; ?> </td></tr>
				<form  enctype="multipart/form-data" action="form3.php" method="post" name="ftp" id="form_ftp" >
				<?	

				// if you selected category courses then get the date of the database under the table topic and use the topics for options
				if($Category == "Courses"){
		
					$CategoryId = "1";

					// Establishes a link with a database on a MySQL server
					$link=conectar_videos();

					$result=mysql_query("select NameTopic,TopicId from Topic where CategoryId = '$CategoryId'",$link);

					// If there are no video then give comment
					if (mysql_num_rows($result) == 0){

						?> <font  class="text"> <p align="center"> There are no topics in this category, please add a topic. <a href= AddTopic.php> Back to form </a> </p>  </font> <?
					}
					else
					{
						while ($rowtopic = mysql_fetch_array($result)) {
				
							// put every data from the database in different variables
							$NameTopic = $rowtopic[0];
							$TopicId = $rowtopic [1];
						
							if($TopicId == "1"){
							$NameTopicOption1 = $NameTopic;
							}

							if($TopicId == "2"){
							$NameTopicOption2 = $NameTopic;
							}

							if($TopicId == "3"){
							$NameTopicOption3 = $NameTopic;
							}

							if($TopicId == "4"){
							$NameTopicOption4 = $NameTopic;
							}

							if($TopicId == "5"){
							$NameTopicOption5 = $NameTopic;
							}
						}
					
						?>
						<tr><th > Select topic:</th><td align="left" class = 'modo1'> <select name="Topic"> <option value="1" > <?php echo $NameTopicOption1; ?> <option value="2" > <?php echo $NameTopicOption2; ?> <option value="3" > <?php echo $NameTopicOption3; ?> <option value="4" > <?php echo $NameTopicOption4; ?> <option value="5" > <?php echo $NameTopicOption5; ?> </select></td></tr>
						<?

					}
				}

				// if you selected category thesis then get the date of the database under the table topic and use the topics for options			
				if($Category == "Thesis"){
		
					$CategoryId = "2";

					// Establishes a link with a database on a MySQL server
					$link=conectar_videos();

					$result=mysql_query("select NameTopic,TopicId from Topic where CategoryId = '$CategoryId'",$link);

					// If there are no video then give comment
					if (mysql_num_rows($result) == 0){

						?> <font  class="text"> <p align="center"> There are no topics in this category, please add a topic. <a href= AddTopic.php> Back to form </a> </p>  </font> <?
					}
					else
					{
						while ($rowtopic = mysql_fetch_array($result)) {
				
							// put every data from the database in different variables
							$NameTopic = $rowtopic[0];
							$TopicId = $rowtopic [1];						

							if($TopicId == "1"){
								$NameTopicOption1 = $NameTopic;
							}

							if($TopicId == "2"){
								$NameTopicOption2 = $NameTopic;
							}

							if($TopicId == "3"){
								$NameTopicOption3 = $NameTopic;
							}

							if($TopicId == "4"){
								$NameTopicOption4 = $NameTopic;
							}

							if($TopicId == "5"){
								$NameTopicOption5 = $NameTopic;
							}
						}
					
						?>
						<tr><th > Select topic:</th><td align="left" class = 'modo1'> <select name="Topic"> <option value="1" > <?php echo $NameTopicOption1; ?> <option value="2" > <?php echo $NameTopicOption2; ?> <option value="3" > <?php echo $NameTopicOption3; ?> <option value="4" > <?php echo $NameTopicOption4; ?> <option value="5" > <?php echo $NameTopicOption5; ?> </select></td></tr>
						<?

					}
				}

				// if you selected category Campus then get the date of the database under the table topic and use the topics for options
				if($Category == "Campus"){
		
					$CategoryId = "3";

					// Establishes a link with a database on a MySQL server
					$link=conectar_videos();

					$result=mysql_query("select NameTopic,TopicId from Topic where CategoryId = '$CategoryId'",$link);

					// If there are no video then give comment
					if (mysql_num_rows($result) == 0){

						?> <font  class="text"> <p align="center"> There are no topics in this category, please add a topic. <a href= AddTopic.php> Back to form </a> </p>  </font> <?
					}
					else
					{
						while ($rowtopic = mysql_fetch_array($result)) {
				
							// put every data from the database in different variables
							$NameTopic = $rowtopic[0];
							$TopicId = $rowtopic [1];
						
							if($TopicId == "1"){
							$NameTopicOption1 = $NameTopic;
							}

							if($TopicId == "2"){
							$NameTopicOption2 = $NameTopic;
							}

							if($TopicId == "3"){
							$NameTopicOption3 = $NameTopic;
							}

							if($TopicId == "4"){
							$NameTopicOption4 = $NameTopic;
							}

							if($TopicId == "5"){
							$NameTopicOption5 = $NameTopic;
							}
						}

						if(($NameTopicOption1 != "") && ($NameTopicOption2 == "") && ($NameTopicOption3 == "") && ($NameTopicOption4 == "") && ($NameTopicOption5 == "")){
					
							?>
							<tr><th > Select topic:</th><td align="left" class = 'modo1'> <select name="Topic"> <option value="1" > <?php echo $NameTopicOption1; ?>  </select></td></tr>
							<?
						}						

						if(($NameTopicOption1 != "") && ($NameTopicOption2 != "") && ($NameTopicOption3 == "") && ($NameTopicOption4 == "") && ($NameTopicOption5 == "")){
					
							?>
							<tr><th > Select topic:</th><td align="left" class = 'modo1'> <select name="Topic"> <option value="1" > <?php echo $NameTopicOption1; ?> <option value="2" > <?php echo $NameTopicOption2; ?>  </select></td></tr>
							<?
						}						

						if(($NameTopicOption1 != "") && ($NameTopicOption2 != "") && ($NameTopicOption3 != "") && ($NameTopicOption4 == "") && ($NameTopicOption5 == "")){
					
							?>
							<tr><th > Select topic:</th><td align="left" class = 'modo1'> <select name="Topic"> <option value="1" > <?php echo $NameTopicOption1; ?> <option value="2" > <?php echo $NameTopicOption2; ?> <option value="3" > <?php echo $NameTopicOption3; ?> </select></td></tr>
							<?
						}

						if(($NameTopicOption1 != "") && ($NameTopicOption2 != "") && ($NameTopicOption3 != "") && ($NameTopicOption4 != "") && ($NameTopicOption5 == "")){
					
							?>
							<tr><th > Select topic:</th><td align="left" class = 'modo1'> <select name="Topic"> <option value="1" > <?php echo $NameTopicOption1; ?> <option value="2" > <?php echo $NameTopicOption2; ?> <option value="3" > <?php echo $NameTopicOption3; ?> <option value="4" > <?php echo $NameTopicOption4; ?>  </select></td></tr>
							<?
						}


						if(($NameTopicOption1 != "") && ($NameTopicOption2 != "") && ($NameTopicOption3 != "") && ($NameTopicOption4!= "") && ($NameTopicOption5 != "")){
					
							?>
							<tr><th > Select topic:</th><td align="left" class = 'modo1'> <select name="Topic"> <option value="1" > <?php echo $NameTopicOption1; ?> <option value="2" > <?php echo $NameTopicOption2; ?> <option value="3" > <?php echo $NameTopicOption3; ?> <option value="4" > <?php echo $NameTopicOption4; ?> <option value="5" > <?php echo $NameTopicOption5; ?> </select></td></tr>
							<?
						}

					}
				}
				
				?>

				<tr> <th > Video description: </th> <td class = "modo1" > <textarea name="desc" rows="7" cols="43" value= ""> </textarea> </td></tr>
				<tr> <th > Select file:</th><td class = "modo1 "><input name="videofile" type="file"/></td></tr>

				<input type="hidden" name="name" id="name" value="<? echo $name ?>" />
				<input type="hidden" name="professor" id="professor" value="<? echo $professor ?>" />
				<input type="hidden" name="Category" id="Category" value="<? echo $Category ?>" />
				<input type="hidden" name="def" id="def" value="<? echo $def ?>" />				
				<input type="hidden" name="mode" id="mode" value="1" />
				<input type="hidden" name="CategoryId" id="CategoryId" value="<? echo $CategoryId ?>" />				
				<tr><td class ="modo1"> </td><td class = "modo1 "><input name="Submit" type="submit" value="Upload video" /><INPUT type="reset"></td></tr>
				</table>
				</form>
				<?				

			}
			else
			{

				?> <font  class="text"><p align="center" > You did not fill in the field name. </p><p align="center"> <a href=" form1.php"> Back </a> </p>  </font></center> <?
			}
		}

		?>
		
		
	</body>
	
</html>
