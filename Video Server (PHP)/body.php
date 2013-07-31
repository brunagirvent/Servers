<html>
<head>
    <title>Projecte</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="STYLESHEET" type="text/css" href="estilos.css">
	<link rel="STYLESHEET" type="text/css" href="tabla.css">
	<link rel="STYLESHEET" type="text/css" href="text.css">
	<link rel="STYLESHEET" type="text/css" href="taula_cerca.css"> 

</head>
<body    >
		<?		
		// Include PHP file with functions
		include("funciones.php");	

		if (isset ($_GET["Home"]))
		{	
			Home();	
		}
		
		else if (isset ($_GET["Courses"]))
		{	
			comptip ($_GET["Courses"]);	
		}

		else if (isset ($_GET["docencia"]))
		{
			comptip ($_GET["docencia"]);
			
		}

		else if (isset ($_GET["Thesis"]))
		{
			comptip ($_GET["Thesis"]);			
		}
		
		else if (isset ($_GET["Campus"]))
		{
			comptip ($_GET["Campus"]);	
		}

		
		else if (isset ($_GET ["credits"]))
		{
		?> 

		<font  class= "text"><p align="justify"> Hello! Welcome to the Video on demand from the department of TSC Terrassa.</p>
		<p align="justify">My name is De Vos Laurens and I am an Belgium student of KAHO Sint-Lieven Rabot - Ghent. The last five months I have been working on a project, called "Usuability improvements on a Metadata Server for Video on Demand based on Free Software". As you can see, in the title, is this project an improvement of an earlier project made by David Vera.</p> 

		<p align="justify">If you have any trouble by finding your way in this website, this is a link to a document which explain the working of each service: <a href ="/projecte/Servidor_web_de_video_sota_demanda_en_el_VideoLan.pdf"> "Help Document"</a> </p> 

		<p align="justify">In the next link you can find the thesis written by David Vera: 		<a href ="/projecte/Servidor_web_de_video_sota_demanda_en_el_VideoLan.pdf"> "Servidor web de vídeo sota demanda basat en el VideoLan"</a> </p> 
		<p align="justify">In the next link you can find the improvement thesis written by myself: 		<a href ="/projecte/Servidor_web_de_video_sota_demanda_en_el_VideoLan.pdf"> "Usuability improvements on a Metadata Server for Video on Demabd based on Free Software."</a> </p> 
		</font>
		<?
		}

		else
		{
		 Home();
		}
				
		?>
	  

</body>
</html>


