<? session_start();?>
<html>
<head>
    <title>Projecte</title>
	<link rel="STYLESHEET" type="text/css" href="estilos.css">
	<link rel="STYLESHEET" type="text/css" href="tabla.css">
	
	
	
</head>
            

    
	<body >
	
   
		<?		
		//Incloem l'arxiu php.funciones
		include("funciones.php");
		if (isset ($_GET["novetats"]))
		{	
			novetats();
		}
		if (isset ($_GET["pfc"]))
		{
			comptip ($_GET["pfc"]);
			
		}
		if (isset ($_GET["docencia"]))
		{
			comptip ($_GET["docencia"]);
		}if (isset ($_GET["euetit"]))
		{
			comptip ($_GET["euetit"]);
		}
		
		
		if (isset ($_GET["socrates"]))
		{
			comptip ($_GET["socrates"]);
		}
		if (isset ($_GET["estudiants"]))
		{
			comptip ($_GET["estudiants"]);
		}
		if (isset ($_GET["vilaweb"]))
		{
			comptip ($_GET["vilaweb"]);
		}
		if (isset ($_GET["webcam"]))
		{
			comptip ($_GET["webcam"]);
		}
		
		
		
				
		?>
		
		
	     <div id="button"    >
                      <ul >
                                <!-- CSS Tabs -->
			<li><a href="body.php" target="body"  >Home</a></li>
			<li><a href="body.php?novetats=novetats" target="body"  >Novetats</a></li>
			<li><a href="body.php?pfc=pfc" target="body" name="pfc">PFC</a></li>
			<li><a href="body.php?docencia=docencia" target="body" name="docencia">Docencia</a></li>
			<li><a href="body.php?euetit=euetit" target="body" name="euetit">EUETIT</a></li>
			<li><a href="body.php?socrates=socrates" target="body" name="socrates">Socrates</a></li>
			<li><a href="body.php?estudiants=estudiants" target="body" name="estudiants" >Estudiants</a></li>
			<li><a href="body.php?vilaweb=vilaweb" target="body" name="vilaweb">Vilaweb</a></li>
			<li><a href="body.php?webcam=webcam" target="body" name="webcam">Webcam</a></li>
			<li><a href="form1.php" target="body">Pujar videos</a></li>

                        </ul>
                </div>
			


	  

	</body>
</html>


