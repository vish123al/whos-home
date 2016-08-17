<html>

<head>
  <style>
    <?php include 'css/main.css';
    ?>
  </style>
</head>

<body>

  <div class="container">

    <header>
      <h1 style="text-align:center;">
     <img src="img/header/SPAWAR-PAC.jpg" alt="SSC PAC Logo" style="width:82px;height:75px;" align="left">
   Map
   <img src="img/header/50Elogo_final.png" alt="SSC PAC 50E Logo" style="width:110px;height:75px;" align="right">
 </h1>
      <br>
      <br>
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
      <div class="image">
        <img src="img/content/MAP.jpg" alt="" />
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
  $query = "SELECT COUNT(MAC) AS NumOfDevices FROM ActiveBlueTooth WHERE SensorID=512";
  $rs = mysql_query($query);


  while ($row = mysql_fetch_assoc($rs)) {
      echo "<h2><span>" . $row['NumOfDevices'] . "<span></h2>";
  }

$query = "SELECT COUNT(MAC) AS NumOfDevices FROM ActiveWIFI WHERE SensorID=512";
  $rs = mysql_query($query);



  while ($row = mysql_fetch_assoc($rs)) {
      echo "<h3><span>" . $row['NumOfDevices'] . "<span></h3>";
  }


  mysql_close();
?>


      </div>
    </article>

    <footer>
      <p style="text-align:center;">Thank You, Team SDE</p>
    </footer>

  </div>

</body>

</html>
