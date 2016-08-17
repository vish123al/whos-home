<html>
<head>
<style>
div.container {
    width: 100%;
    border: 1px solid gray;
}

header, footer {
    padding: 1em;
    color: white;
    background-color: black;
    clear: left;
}

nav {
    float: left;
    max-width: 150px;
    margin: 0;
    padding: 1em;
}

nav ul {
    list-style-type: none;
    padding: 0;
}

nav ul a {
    text-decoration: none;
}

article {
    margin-left: 155px;
    border-left: 1px solid gray;
    padding: 1em;
    overflow: hidden;
}


.image {
	position: relative;
	width: 100%;
}

h2 {
	position: absolute;
	top: 93px;
	left: 17px;
	width: 100%;
}

h2 span {
	color: yellow;
	font: bold 15px/24px Helvetica, Sans-Serif;
	background: rgb(18,18,241); <!-- blue -->
	padding: 2px;
}

h3 {
	position: absolute;
	top: 94px;
	left: 45px;
	width: 100%;
}

h3 span {
	color: blue;
	font: bold 15px/24px Helvetica, Sans-Serif;
	background: rgb(241, 241, 18); <!-- yellow -->
	padding: 2px;
}


</style>
</head>
<body>

<div class="container">

<header>
   <h1 style="text-align:center;"><img src="img/header/SPAWAR-PAC.jpg" alt="SSC PAC Logo" style="width:82px;height:75px;" align="left">
   Map
   <img src="img/header/50Elogo_final.png" alt="SSC PAC 50E Logo" style="width:110px;height:75px;" align="right"> </h1>
   <br><br>
</header>


<nav>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="Map.php">Map</a></li>
    <li><a href="BluetoothReg.php">Bluetooth Registration</a></li>
    <li><a href="WIFIReg.php">WIFI Registration</a></li>
  </ul>
</nav>

<article>
  <h1>Map</h1>
  <!-- This page will provide a MAP picture, that identifies building 57, with a blue box that identifies the count of detected BlueTooth devices by sensor 512,
    and a yellow box that identifies the count of detected WIFI devices by sensor 512 -->

  <div class="image">
	<img src="MAP.jpg" alt="" />

<?php
  $dbhost = getenv("SNIFFERDB_SERVICE_HOST");
	//echo "Here is your dbhost variable: " . $dbhost . "<br>";
  $dbport = getenv("OPENSHIFT_MYSQL_DB_PORT");
	//echo "Here is your dbport variable: " . $dbport . "<br>";
  $dbuser = getenv("OPENSHIFT_MYSQL_DB_USERNAME");
	//echo "Here is your dbuser variable: " . $dbuser . "<br>";
  $dbpwd = getenv("OPENSHIFT_MYSQL_DB_PASSWORD");
	//echo "Here is your dbpwd variable: " . $dbpwd . "<br>";
  $dbname = getenv("OPENSHIFT_MYSQL_DBNAME");
	//echo "Here is your dbname variable: " . $dbname . "<br>";
  $connection = mysql_connect($dbhost.":".$dbport, $dbuser, $dbpwd);
	//echo "Here is your connection variable: " . $connection . "<br>";
  if (!$connection) {
    echo "Could not connect to database";
  }

  $dbconnection = mysql_select_db($dbname);
  $query = "SELECT COUNT(MAC) AS NumOfDevices FROM ActiveBlueTooth WHERE SensorID=512"; // query to count the detected BlueTooth devices by sensor 512
  $rs = mysql_query($query);


  while ($row = mysql_fetch_assoc($rs)) {
  echo "<h2><span>" . $row['NumOfDevices'] . "<span></h2>"; // note that h2 was set to have the blue background in the CSS
  }

$query = "SELECT COUNT(MAC) AS NumOfDevices FROM ActiveWIFI WHERE SensorID=512"; // query to count the detected number of WIFI devices by sensor 512
  $rs = mysql_query($query);



  while ($row = mysql_fetch_assoc($rs)) {
  echo "<h3><span>" . $row['NumOfDevices'] . "<span></h3>"; // note that h3 was set to have the yellow background in the CSS
  }


  mysql_close();
?>


  </div>
</article>

<footer><p style="text-align:center;">Thank You, Team SDE</p></footer>

</div>

</body>
</html>
