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
      <h1 style="text-align:center;"><img src="img/header/SPAWAR-PAC.jpg" alt="SSC PAC Logo" style="width:82px;height:75px;" align="left">
   WIFI Registration
   <img src="img/header/50Elogo_final.png" alt="SSC PAC 50E Logo" style="width:110px;height:75px;" align="right"> </h1>
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

      <h1>Register your WIFI MAC</h1>

      <!-- provides a page that allows a user to type in the information to register a WIFI device, and also provides a table listing all currently registered WIFI devices -->

      Please type in the MAC address of your WIFI device, the associated SSID for this device, and the name you would like to have associated with it:
      <form action="wMACsubmit.php" method="post">
        WIFI MAC:
        <input type="text" name="wMAC">
        <br> SSID:
        <input type="text" name="SSID">
        <br> Name:
        <input type="text" name="username">
        <br>
        <input type="submit">
      </form>

      <br>
      <br>

      <h1>Listing of registered WIFI devices</h1>
      <p>
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
  $query = "SELECT * from WIFIMACs"; // query to list all currently registered WIFI devices
  $rs = mysql_query($query);

  echo "<table> <tr> <th> MAC Address </th> <th> Registered SSID </th> <th> Registered Name </th> </tr>";   // create the table and heading row

  while ($row = mysql_fetch_assoc($rs)) {
    echo "<tr> <td>" . $row['MAC'] . "</td> <td>" . $row['SSID'] . "</td><td>" . $row['User'] . "</td></tr>";  // create a line per response
  }

  echo "</table>";  // close out the table

  mysql_close();
?>

    </article>

    <footer>
      <p style="text-align:center;">Thank You, Team SDE</p>
    </footer>

  </div>

</body>

</html>
