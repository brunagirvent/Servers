<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Search</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="STYLESHEET" type="text/css" href="tabla.css">
		<link rel="STYLESHEET" type="text/css" href="text.css">
		<link rel="STYLESHEET" type="text/css" href="estilos.css">
	</head>
	
	<body>
		<?
			include ("funciones.php");
			$link = conectar_videos();
			$searchtitle = $_POST["searchtitle"];
			
			
			$result=mysql_query("select name,user,date,Description,urlLow,urlStd,urlHigh,ThumbnailUrl,id,NameCategory,NameTopic from videos where name like '$searchtitle' ",$link);
			if (mysql_num_rows($result) == 0)
			{
				?> <font  class="text"> <p align="center"> Sorry, no video with this name.  </p><p align="center"> <a href="body.php?intro=0">Back</a></p></font> <?
			}
			else
			{

				?><table align="center" border="0" cellpadding="0" cellspacing="0" class="tabla">
				<tr class='modo1' align = "center"> <th colspan="12"> Search result </th></tr> 
				<tr  align = "center"><th><b>Id</b></th><th><b>Title of video</b></th><th><b>User</b></th><th><b>Date</b></th><th><b>Description</b></th><th><b>Low</b></th><th><b>Standard</b></th><th><b>High</b></th><th><b>Category</b></th><th><b>Topic</b></th><th><b>Thumbnail</b></th></tr>
				<?
			
				while ($rowvideos = mysql_fetch_array($result)){	

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
					if($urlHigh != "") {
						if($urlStd != ""){
							if($urlLow != ""){
							
								echo ("<TR class='modo1' align='center'>");
								echo ("<TD>".$id."</TD><TD>".$name."</TD><TD>".$professor."</TD><TD>".$date."</TD><TD>".$desc."</TD><TD> <p><a href=videos.php?name=".$id."&url=1>Play<a/></p><p><a href=".$urlLow.">Download</a></p></TD>  <TD> <p><a href=videos.php?name=".$id."&url=2>Play<a/></p><p><a href=".$urlStd.">Download</a></p></TD><TD> <p><a href =videos.php?name=".$id."&url=3>Play<a/></p><p><a href=".$urlHigh.">Download</a></p></TD> <td>".$NameCategory."</td><td>".$NameTopic."</td><TD><img src=".$thumbnail." width=200></TD> ");
								echo ("</TR>");
							}
						}
					}

					// Run this code if there is a version in low and standard definition
					if($urlHigh == "") {
						if($urlStd != "") {
							if($urlLow != ""){
							
								echo ("<TR class='modo1' align='center'>");
								echo ("<TD>".$id."</TD><TD>".$name."</TD><TD>".$professor."</TD><TD>".$date."</TD><TD>".$desc."</TD><TD> <p><a href =videos.php?name=".$id."&url=1>Play<a/></p><p><a href=".$urlLow.">Download<a/></p></TD>  <TD> <p><a href=videos.php?name=".$id."&url=2>Play<a/></p><p><a href=".$urlStd.">Download</a></p></TD><TD> No </TD> <td>".$NameCategory."</td><td>".$NameTopic."</td><TD><img src=".$thumbnail." width=200></TD> ");
								echo ("</TR>");
							}
						}
					}

					// Run this code if there is a version in low definition
					if($urlHigh == "") {
						if($urlStd == "") {
							if($urlLow != "") {
							
								echo ("<TR class='modo1' align='center'>");
								echo ("<TD>".$id."</TD><TD>".$name."</TD><TD>".$professor."</TD><TD>".$date."</TD><TD>".$desc."</TD><TD> <p><a href= videos.php?name=".$id."&url=1>Play<a/></p><p><a href=".$urlLow.">Download</a></p></TD>  <TD> No </TD><TD> No </TD> <td>".$NameCategory."</td><td>".$NameTopic."</td><TD><img src=".$thumbnail." width=200></TD> ");
								echo ("</TR>");
							}	
						}
					}

				}

				?><font  class="text"><p align="center"><a href="body.php?intro=0"> Back </a></p></font> <?
			}

			//releasin the data in the result variable.
			mysql_free_result($result);
			  
			//Close the connection to the database.
			mysql_close($link); 
			
		
		?>
	</body>
</html>
