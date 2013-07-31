<?php

//Conection
function connection() {
   // 1. Create a database connection
    $connection = mysql_connect("147.83.74.180","alexander","terrassa");
    if (!$connection) {
        die("No Database connection to 147.83.74.180: " . mysql_error());
    }
    
    // 2. Select a database to use
    $db_select = mysql_select_db("archivos",$connection);
    if (!$db_select) {
        die("Database selection failed: " . mysql_error());
    }
}

//Database query to get the data

//Get category
function GetCategory($Category_ID, &$_xml){
      //Perform database query
    $result = mysql_query("SELECT * FROM Category WHERE CategoryId=$Category_ID");
    if (!$result) {
        die("Database query failed: " . mysql_error());
    }
	
    // Use returned data
    while ($row = mysql_fetch_array($result)) {
      //iPhone app not use Most Viewed and Top Rated categories
      if (($row[0] != "Most Viewed") && ($row[0] != "Top Rated"))
      {
      //Write CategoryID on XML file
       $_xml .= "<Category id=\"" . $Category_ID . "\">\r\n";
      //Write nameCategory on XMl file
       $_xml .= "<nameCategory>" . $row[0] . "</nameCategory>\r\n";
      }
}
}


//Get Topic
function GetTopic($CatId,$TopId, &$_xml) {
     // 3. Perform database query
    $resultTop = mysql_query("SELECT * FROM Topic WHERE CategoryId=$CatId AND TopicId=$TopId");
    if (!$resultTop) {
       die("Database query failed: " . mysql_error());
    }
    // 4. Use returned data
      while ($row = mysql_fetch_array($resultTop)) {
	//Ignore rows without text
	if ($row[1] != "")
	{
	//Write TopicID to XML file
	$_xml .= "<Topic id=\"" . $TopId . "\">\r\n";
	//Write nameTopi on XML file
	$_xml .= "<nameTopic>" . $row[1] . "</nameTopic>\r\n";
      }
    }
        
 } 


//Get Videos
function GetVideos($Category_ID,$Topic_ID, &$_xml){
    // Perform database query
    $result = mysql_query("SELECT * FROM videos WHERE
                          CategoryId=$Category_ID
                          AND TopicId=$Topic_ID");
    if (!$result) {
       die("Database query failed: " . mysql_error());
    }
    // 4. Use returned data
    while ($row = mysql_fetch_array($result)) {
	$id = $row[0];
        $nameVideo = $row[1];
        $user = $row[2];
        $date = $row[3];
	$description = $row [4];
	$urlVideo = $row[5]; //iPhone quality
        $urlThumbnail = $row[8]; 

        //Write VideoID on XML file
	$_xml .= "<video id=\"" . $id . "\">\r\n";
	//Write video metadata on XML file
	$_xml .= "<nameVideo>" . $nameVideo . "</nameVideo>\r\n";
	$_xml .= "<user>" . $user . "</user>\r\n";
	$_xml .= "<date>" . $date . "</date>\r\n";
	$_xml .= "<description>" . $description . "</description>\r\n";
	$_xml .= "<urlThumbnail>" . $urlThumbnail . "</urlThumbnail>\r\n";
	$_xml .= "<urlVideo>" . $urlVideo . "</urlVideo>\r\n";
	$_xml .= "</video>\r\n";
    }
}

function generate_xml() 
{
  //Connect to database
  connection();

  //Open XML file and write first lines
  $file= fopen("/opt/lampp/htdocs/projecte/iPhone/metadata.xml", "w");

  $_xml = "<?xml version = \"1.0\" encoding=\"UTF-8\"?>\r\n";
  $_xml .= "<Videos>\r\n";

  $CatId=1;

  //Count number of categories on database
  $resultC = mysql_query("SELECT COUNT(*) FROM Category");
  $nCats = mysql_fetch_array($resultC);

  //Get data from database
  while ($CatId <= $nCats[0])
  {
    //get category
    GetCategory($CatId,$_xml);

    $TopId=1;
    //Count number of topics on each category
    $resultT = mysql_query("SELECT COUNT(*) FROM Topic WHERE CategoryId=$CatId");
    $nTops = mysql_fetch_array($resultT);

    //Define if there are videos on this category
    $hasvideos=false; 

    //Get topics of each category
      while ($TopId <= $nTops[0])
	{

	  //Check if there are videos on the topic
	  $resultV = mysql_query ("SELECT COUNT(id) AS cnt FROM videos WHERE CategoryId=$CatId AND TopicId=$TopId");
	  $row = mysql_fetch_assoc($resultV);
	  $nVideos = $row['cnt'];
	  
	  //Check if there are videos on the topic
	  if ($nVideos!=0)
	   {	
	    $hasvideos=true;

	    //Get topic
	    GetTopic($CatId,$TopId, $_xml);
	      
	    //Get the videos
	    GetVideos($CatId,$TopId, $_xml);	  

	   //Write finish Topic label on XML File 
	   $_xml .= "</Topic>\r\n"; 
	  }
	$TopId++;
      }

      //Write finish Category label on XML File if Category has videos
      if ($hasvideos)
      $_xml .= "</Category>\r\n"; 

      $CatId++;
  }

  //Write finish Video label on XML File 
  $_xml .= "</Videos>\r\n"; 

  //Write data on XML file 
  fwrite($file, $_xml);
  fclose($file);
}

?>