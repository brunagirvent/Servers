
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
		?> <font  class= "text"><p align="justify"> Hola! Benvinguts a la p�gina de Videos sota demanda del departament de TSC Terrassa.</p>
		<p align="justify">Soc David Vera Montoro, alumne de la EUETIT cursant el PFC de la enginyeria Telecomunicacions, escpecialitat so i imatge.Tamb� soc l'autor d'aquesta p�gina, la qual he presentat com PFC. Pel qui no estigui molt situat/da en el tema 
		el servei que presento �s video sota demanda basat en el protocol http. �s a dir, que nom�s fent clic a el bot� play d'un v�deo es pot visualitzar aquest, sense la necessitat de desc�rrega 
		previa (encara que tamb� es dona aquesta opci�).</p> 
		<p align="justify"> Aquesta feina l'he portat a terme gr�cies a la informaci� proporcionada per alumnes de cursos passats amb els seus PFC's. Parlo de �ngela Abat amb <a target="_top" href = "http://hdl.handle.net/2099.1/4410"> "Servidors de corrents d'audio i v�deo
		basat en programari i formats lliures"</a>, Stefano Mosca amb "Live streaming and peer-to-peer television" i Lorena Gomes i X�nia Alb� amb <a target="_top" href = "https://upcommons.upc.edu/pfc/handle/2099.1/3871">  "Servidor de v�deo sobre IP utilitzant programari lliure"</a>. </p> </font><?
		}
		else
		{
		 novetats();
		}
		
		
		
		
				
		?>


	  

</body>
</html>


