<html>

	<head>
		<title>Videos</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="STYLESHEET" type="text/css" href="tabla_plugin.css">
		
	</head>

	<body  >
	<? 
	// Include PHP file with functions
	include ('funciones.php');

	// Establishes a link with a database on a MySQL server
	$link=conectar_videos();

	$id = $_GET["name"];

	//check if you want to play the low definition video
	if ( $_GET["url"] == 1 )
	{
		//If you select low definition then he should go to the low directory of the video. So we'll put low in a variable to use later in the url
		$def = "low";
		//Get the metadate of the selected video of the datebase
		$result = mysql_query ( "SELECT name,Description,urlLow FROM videos WHERE id = '$id'",$link);
		//Put all the metadata in variables
		$rowvideos = mysql_fetch_array ($result);
		$name = $rowvideos[0];
		$desc = $rowvideos[1];
		$path = $rowvideos[2];
		
	}

	//Check if you want to play the standard definition video
	if ( $_GET["url"] == 2 )
	{
		//If you select standard definition then he should go to the standard directory of the video. So we'll put standard in a variable to use later in the url
		$def = "standard";
		//Get the metadate of the selected video of the datebase
		$result = mysql_query ( "select name,Description,urlStd from videos where id = '$id'",$link);
		//Put all the metadata in variables
		$rowvideos = mysql_fetch_array ($result);
		$name = $rowvideos[0];
		$desc = $rowvideos[1];
		$path = $rowvideos[2];
		
	}

	//Check if you want to play the low definition video
	if ( $_GET["url"] == 3)
	{
		//If you select high definition then he should go to the high directory of the video. So we'll put high in a variable to use later in the url
		$def = "high";
		//Get the metadate of the selected video of the datebase
		$result = mysql_query ( "select name,Description,urlHigh from videos where id = '$id'",$link);
		//Put all the metadata in variables
		$rowvideos = mysql_fetch_array ($result);
		$name = $rowvideos[0];
		$desc = $rowvideos[1];
		$path = $rowvideos[2];
		
	}
	
		
	
	
	
	?>
		
		<table align="center" class="tabla_plugin"> 
		<tr><th colspan="2" align="center" > <? echo $name; ?></th></tr>
		<tr><td width="505"   class="modo1" > <p><embed  type="application/x-vlc-plugin" name="video1"  autoplay="no" loop="yes" height="300" width="500" target=  "<?php echo $path; ?>" /></p> </td> <td align="left" valign="top"   class="modo1"> Description: <? echo $desc; ?> </td></tr>
		<tr><th ><p>
			<input type="button" value="Play" onclick="document.video1.play();" />
			<input type="button" value="Pause" onclick="document.video1.pause();" />
			<input type="button" value="Stop" onclick="document.video1.stop();" />
			<input type="button" value="Fullscreen" onclick="document.video1.fullscreen()" />
			<input type="button" name="chewa" value="Mute" onclick="document.video1.mute()" />
		</p></th><th></th></tr>
		 </table>
		 <table align="center" class="tabla_plugin"><td class="modo1" ><a href="http://www.videolan.org/vlc" title="Get VLC media player - It plays, it streams, it kills WiMPs!!"><img src="http://www.videolan.org/images/buttons/GetVLC_110.png" width="110"height="45" alt="Get VLC media player" /></a></td> <td class="modo1"> To play the video you need to install the VLC connector.  <p><a href = "http://www.videolan.org/mirror.php?file=vlc/0.8.6d/win32/vlc-0.8.6d-win32.exe"> Windows </a></p><p> <a href = "http://www.videolan.org/vlc/"> Linux </a></p><a href = "http://www.videolan.org/vlc/download-macosx.html"> Mac </a>  </td></table>
		
		
		
		
	</body>
	
</html>
