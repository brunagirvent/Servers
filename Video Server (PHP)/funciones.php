<link rel="STYLESHEET" type="text/css" href="taula_cerca.css"> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?

	// Establishes a link with a database on a MySQL server
	function conectar_videos()
	{
		// Connection to the database
  		if (!($link=mysql_connect("localhost","laurens","terrassa")))
   		{
	     		echo "Error connection the database.";
	      		exit();
   		}
		
   		// Select the database used by the PHP interface
  		if (!mysql_select_db("archivos",$link))
  		{
      		echo "Error selecting the database.";
		 	exit();
   		}
		
   	return $link;
	} 	
	
	
	// Get the extension of a filename
	function getextension ($filename)
	{

		// Split the filename in two
		$ext = explode(".", $filename);

		// Return the second part, which corresponds to the extension
		return $ext[1];
	}

	
	// A new entry to the database is added for table videos
	function addVisualDataUrlsToDatabase ($name,$professor,$data,$NameCategory,$NameTopic,$CategoryId,$TopicId,$ext,$desc,$def)
	{
		// Establishes a link with a database on a MySQL server
		$link=conectar_videos();

		//implement the metadata of the video to the database in all the tables
		MYSQL_QUERY("INSERT INTO videos (name,user,date,Description,NameCategory,NameTopic,CategoryId,TopicId)"."VALUES ('$name', '$professor', '$data', '$desc', '$NameCategory', '$NameTopic', '$CategoryId', '$TopicId')",$link);

		// Query the database with the video object ID
		$result1 = mysql_query ("select id from videos where name = '$name'",$link);

		// Get the resulting data from the query
		$rowvideos = mysql_fetch_array ($result1);

		// Read the video object ID and URLs for video versions and thumbnail
		$id = $rowvideos[0];
 
		// if the defition is high then upload the 3 metadata of the video
		if($def == "high") {

			// give to right name to the video to upload the metadata on the database
			$urlHigh = "http://147.83.74.180/videos/high/".$id.".".$ext;
			$urlStd = "http://147.83.74.180/videos/standard/".$id.".MPG";
			//$urlLow = "http://147.83.74.180/videos/low/".$id.".mp4";
			$urlLow = "http://147.83.74.180/videos/low/".$id."-index.m3u8";
			$thumbnail = "http://147.83.74.180/thumbnails/".$id.".jpg";

			// upload the metadata of the video on the datebase
			MYSQL_QUERY("update videos set urlLow='$urlLow' , urlStd='$urlStd' , urlHigh='$urlHigh' , ThumbnailUrl='$thumbnail' where name = '$name'",$link);
		

		}

		// if the defition is standard then upload the 2metadata of the video
		if($def == "standard") {

			// give to right name to the video to upload the metadata on the databa
			$urlStd = "http://147.83.74.180/videos/standard/".$id.".".$ext;
			//$urlLow = "http://147.83.74.180/videos/low/".$id.".mp4";
			$urlLow = "http://147.83.74.180/videos/low/".$id."-index.m3u8";
			$thumbnail = "http://147.83.74.180/thumbnails/".$id.".jpg";

			// upload the metadata of the video on the datebase
			MYSQL_QUERY("update videos set urlLow='$urlLow' , urlStd='$urlStd' , ThumbnailUrl='$thumbnail' where name = '$name'",$link);

		}

		// if the defition is low then upload the metadata of the video
		if($def == "low") {

			// give to right name to the video to upload the metadata on the databa
			//$urlLow = "http://147.83.74.180/videos/low/".$id.".".$ext;
			$urlLow = "http://147.83.74.180/videos/low/".$id."-index.m3u8";
			$thumbnail = "http://147.83.74.180/thumbnails/".$id.".jpg";
		
			// upload the metadata of the video on the datebase
			MYSQL_QUERY("update videos set urlLow='$urlLow' , ThumbnailUrl='$thumbnail' where name = '$name'",$link);

		}

		// Close the link to the database
		mysql_close($link); 

		return $id;
		
	}

	function comptip ($NameCategory)
	{
		
		// Establishes a link with a database on a MySQL server
		$link=conectar_videos();

		// Select everything from the database
		$result1=mysql_query("select name,user,date,urlLow,urlStd,urlHigh,id,ThumbnailUrl,NameTopic from videos where NameCategory = '$NameCategory'",$link);

		// If there are no video then give comment
		if (mysql_num_rows($result1) == 0)
		{
			?> <font  class="text"> <p align="center"> There are no videos in this section </p></font> <?
		}
		else
		{
		
			?><table align="center" border="0" cellpadding="0" cellspacing="0" class="tabla">
			<tr class='modo1' align = "center"> <th colspan="9"> <? echo $NameCategory ?> </th></tr> 
			<tr  align = "center"><th><b>Id</b></th><th><b>Title of video</b></th><th><b>User</b></th><th><b>Date</b></th><th><b>Low</b></th><th><b>Standard</b></th><th><b>High</b></th><th><b>Topic</b></th><th><b>Thumbnail</b></th></tr>
			<?
		
			while ($rowvideos = mysql_fetch_array($result1)) 
			{
				
				// put every data from the database in different variables
				$name = $rowvideos[0];		
				$professor = $rowvideos[1];
				$date = $rowvideos[2];
				$urlLow = $rowvideos[3];
				$urlStd = $rowvideos[4];
				$urlHigh = $rowvideos[5];
				$id = $rowvideos[6];
				$thumbnail = $rowvideos[7];
				$NameTopic = $rowvideos[8];	


				// Run this code if there is a version in low, standard and high definition
				if($urlHigh != "")
				{
					if($urlStd != "") 
					{
						if($urlLow != "")
						{
							echo ("<TR class='modo1' align='center'>");
							echo ("<TD>".$id."</TD><TD>".$name."</TD><TD>".$professor."</TD><TD>".$date."</TD><TD> <p><a href=videos.php?name=".$id."&url=1>Play<a/></p><p><a href=".$urlLow.">Download</a></p></TD>  <TD> <p><a href=videos.php?name=".$id."&url=2>Play<a/></p><p><a href=".$urlStd.">Download</a></p></TD><TD> <p><a href =videos.php?name=".$id."&url=3>Play<a/></p><p><a href=".$urlHigh.">Download</a></p></TD> <TD>".$NameTopic."</TD> <TD><img src=".$thumbnail." width=200></TD> ");
							echo ("</TR>");
						}
					}
				}

				// Run this code if there is a version in low and standard definition
				if($urlHigh == "")
				{
					if($urlStd != "") 
					{
						if($urlLow != "")
						{
							echo ("<TR class='modo1' align='center'>");
							echo ("<TD>".$id."</TD><TD>".$name."</TD><TD>".$professor."</TD><TD>".$date."</TD><TD> <p><a href =videos.php?name=".$id."&url=1>Play<a/></p><p><a href=".$urlLow.">Download<a/></p></TD>  <TD> <p><a href=videos.php?name=".$id."&url=2>Play<a/></p><p><a href=".$urlStd.">Download</a></p></TD><TD> No </TD> <TD>".$NameTopic."</TD> <TD><img src=".$thumbnail." width=200></TD> ");
							echo ("</TR>");
						}
					}
				}

				// Run this code if there is a version in low definition
				if($urlHigh == "")
				{
					if($urlStd == "") 
					{
						if($urlLow != "")
						{
							echo ("<TR class='modo1' align='center'>");
							echo ("<TD>".$id."</TD><TD>".$name."</TD><TD>".$professor."</TD><TD>".$date."</TD><TD> <p><a href= videos.php?name=".$id."&url=1>Play<a/></p><p><a href=".$urlLow.">Download</a></p></TD>  <TD> No </TD><TD> No </TD> <TD>".$NameTopic."</TD> <TD><img src=".$thumbnail." width=200></TD> ");
							echo ("</TR>");
						}
					}
				}

			}
		}
	
		//Released data from the result variable
		mysql_free_result($result1);
		  
		//Close connection to database
		mysql_close($link); 
	}
	
	
	
	function Home()
	{
		// Establishes a link with a database on a MySQL server
		$link=conectar_videos(); 		
		
		$date = time ();
		$data = date ( "d-m-Y" , $date ); 
		$date_limit = date("d-m-Y", strtotime("$data -1 day"));
		
		// Select everything from the database
		$result1=mysql_query("select name,user,date,Description,urlLow,urlStd,urlHigh,ThumbnailUrl,id,NameCategory,NameTopic from videos limit 0,5",$link);

		
		// If there are no videos on the database, show message
		if (mysql_num_rows($result1) == 0)
		{
			?> <font  class="text"> <p align="center"> Not uploaded any videos </p></font> <?
		}
		else
		{
			?><table align="center" border="0" cellpadding="0" cellspacing="0" class="tabla">
			<tr class='modo1' align = "center"> <th colspan="12"> Home </th></tr> 
			<tr  align = "center"><th><b>Id</b></th><th><b>Title of video</b></th><th><b>User</b></th><th><b>Date</b></th><th><b>Description</b></th><th><b>Low</b></th><th><b>Standard</b></th><th><b>High</b></th><th><b>Category</b></th><th><b>Topic</b></th><th><b>Thumbnail</b></th></tr>
			<?

		
			while ($rowvideos = mysql_fetch_array($result1))
			{	

				// put every data from the database in different variables

				$name = $rowvideos[0];
				$professor =$rowvideos[1];
				$date = $rowvideos[2];
				$desc = $rowvideos[3];
				$urlLow = $rowvideos[4];
				$urlStd = $rowvideos[5];
				$urlHigh = $rowvideos[6];
				$thumbnail = $rowvideos[7];
				$id = $rowvideos[8];
				$NameCategory = $rowvideos[9];
				$NameTopic = $rowvideos[10];
				
				

				// Run this code if there is a version in low, standard and high definition
				if($urlHigh != "")
				{
					if($urlStd != "") 
					{
						if($urlLow != "")
						{
							echo ("<TR class='modo1' align='center'>");
							echo ("<TD>".$id."</TD><TD>".$name."</TD><TD>".$professor."</TD><TD>".$date."</TD><TD>".$desc."</TD><TD> <p><a href=videos.php?name=".$id."&url=1>Play<a/></p><p><a href=".$urlLow.">Download</a></p></TD>  <TD> <p><a href=videos.php?name=".$id."&url=2>Play<a/></p><p><a href=".$urlStd.">Download</a></p></TD><TD> <p><a href =videos.php?name=".$id."&url=3>Play<a/></p><p><a href=".$urlHigh.">Download</a></p></TD> <td>".$NameCategory."</td><td>".$NameTopic."</td><TD><img src=".$thumbnail." width=200></TD> ");
							echo ("</TR>");
						}
					}
				}

				// Run this code if there is a version in low and standard definition
				if($urlHigh == "")
				{
					if($urlStd != "") 
					{
						if($urlLow != "")
						{
							echo ("<TR class='modo1' align='center'>");
							echo ("<TD>".$id."</TD><TD>".$name."</TD><TD>".$professor."</TD><TD>".$date."</TD><TD>".$desc."</TD><TD> <p><a href =videos.php?name=".$id."&url=1>Play<a/></p><p><a href=".$urlLow.">Download<a/></p></TD>  <TD> <p><a href=videos.php?name=".$id."&url=2>Play<a/></p><p><a href=".$urlStd.">Download</a></p></TD><TD> No </TD> <td>".$NameCategory."</td><td>".$NameTopic."</td><TD><img src=".$thumbnail." width=200></TD> ");
							echo ("</TR>");
						}
					}
				}

				// Run this code if there is a version in low definition
				if($urlHigh == "")
				{
					if($urlStd == "") 
					{
						if($urlLow != "")
						{
							echo ("<TR class='modo1' align='center'>");
							echo ("<TD>".$id."</TD><TD>".$name."</TD><TD>".$professor."</TD><TD>".$date."</TD><TD>".$desc."</TD><TD> <p><a href= videos.php?name=".$id."&url=1>Play<a/></p><p><a href=".$urlLow.">Download</a></p></TD>  <TD> No </TD><TD> No </TD> <td>".$NameCategory."</td><td>".$NameTopic."</td><TD><img src=".$thumbnail." width=200></TD> ");
							echo ("</TR>");
						}
					}
				}

			}
		}
	
		//Released data from the result variable
		mysql_free_result($result1);
		  
		//Close connection to database
		mysql_close($link); 	
	}	

	function intro()
	{
		
		?><table align="right" class ='taula_cerca'><tr> <th> Title</th><td align="center"  class = 'modo1'> <form action="search.php" target="body" method="post" name="cerca" id="cerca" > <input align="middle" size="10" maxlength="20" value ="" name="searchtitle" type="text"></td><td align="center"  class = 'modo1'><input  type='submit' value='GO'></form></td></tr></table><?
		
	}

			
			
?>
