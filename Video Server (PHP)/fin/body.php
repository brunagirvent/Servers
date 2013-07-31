
<html>
<head>
    <title>Projecte</title>
	<link rel="STYLESHEET" type="text/css" href="estilos.css">
	<link rel="STYLESHEET" type="text/css" href="tabla.css">
	<link rel="STYLESHEET" type="text/css" href="text.css">
	<link rel="STYLESHEET" type="text/css" href="taula_cerca.css"> 
</head>
            

    
<body    >

	
   
		<?		
		//Incloem l'arxiu php.funciones
		include("funciones.php");
		if (isset ($_GET["novetats"])  )
		{	
			
			novetats();
			
		}
		
		else if (isset ($_GET["pfc"]))
		{
			
			comptip ($_GET["pfc"]);
			
			
		}
		else if (isset ($_GET["docencia"]))
		{
			comptip ($_GET["docencia"]);
			
		}
		else if (isset ($_GET["euetit"]))
		{
			comptip ($_GET["euetit"]);
			
		}
		
		
		else if (isset ($_GET["socrates"]))
		{
			comptip ($_GET["socrates"]);
			
		}
		else if (isset ($_GET["estudiants"]))
		{
			comptip ($_GET["estudiants"]);
			
		}
		else if (isset ($_GET["vilaweb"]))
		{
			comptip ($_GET["vilaweb"]);
			
		}
		
		else if (isset ($_GET ["credits"]))
		{
		?> <font  class= "text"><p align="justify"> Hola! Benvinguts a la pàgina de Videos sota demanda del departament de TSC Terrassa.</p>
		<p align="justify">Soc David Vera Montoro, alumne de la EUETIT cursant el PFC de la enginyeria Telecomunicacions, escpecialitat so i imatge.També soc l'autor d'aquesta pàgina, la qual he presentat com PFC. Pel qui no estigui molt situat/da en el tema 
		el servei que presento és video sota demanda basat en el protocol http. És a dir, que només fent clic a el botò play d'un vídeo es pot visualitzar aquest, sense la necessitat de descàrrega 
		previa (encara que també es dona aquesta opció).</p> 
		<p align="justify"> Aquesta feina l'he portat a terme gràcies a la informació proporcionada per alumnes de cursos passats amb els seus PFC's. Parlo de Àngela Abat amb <a target="_top" href = "http://hdl.handle.net/2099.1/4410"> "Servidors de corrents d'audio i vídeo
		basat en programari i formats lliures"</a>, Stefano Mosca amb "Live streaming and peer-to-peer television" i Lorena Gomes i Xènia Albà amb <a target="_top" href = "https://upcommons.upc.edu/pfc/handle/2099.1/3871">  "Servidor de vídeo sobre IP utilitzant programari lliure"</a>. </p> </font><?
		}
		else
		{
		 novetats();
		}
		
		
		
		
				
		?>


	  

</body>
</html>


