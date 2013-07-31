<? session_start();
$_SESSION = array();
header("Location: right.php");//pon el nombre de la pagina logeo
?>


<html>


	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /
	<link rel="STYLESHEET" type="text/css" href="estilos.css">
	</head>
	<body bgcolor="#6699FF">
	     <div id="button">
                        <ul>
                                <!-- CSS Tabs -->

			<li><a href="body.php?Home=Home" target="body"  ><span>Home</span></a></li>
			<li><a href="body.php?MenuCategory=MenuCategory" target="body" name="MenuCategory" ><span>Menu Category</span></a></li>
			<li><a href="body.php?Courses=Courses" target="body" name="Courses"><span>Courses</span></a></li>
			<li><a href="body.php?Thesis=Thesis" target="body" name="Thesis"><span>Thesis</span></a></li>
			<li><a href="body.php?Campus=Campus" target="body" name="Campus"><span>Campus</span></a></li>
			<li><a href="body.php?webcam=webcam" target="body" name="webcam">Webcam</a></li>
			<li><a href="form1.php" target="body">Upload video</a></li>

                        </ul>
                </div>
        </body>
</html>
