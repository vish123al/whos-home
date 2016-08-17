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
   Bluetooth/WIFI Finder v.0.2
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
        <li><a href="WIFIReg.php">WIFI Registration</a> </li>
      </ul>
    </nav>

    <article>
      <h1>Visible BlueTooth MAC Addresses</h1>

      <!-- This is the homepage for this application.  It will provide 2 tables, one for detected BlueTooth Devices, and one for the detected WIFI devices
   in each table, it will be LEFT JOINED with the table of registered devices, to provide names if the device has been registered, as well as the information detected by the sensor.
   Additionally, if the detected device has not been registered, a link will be made of the MAC address to call a page to register said MAC address... with the MAC address prepopulated -->

      <?php
  $dbhost = getenv("SNIFFERDB_SERVICE_HOST");
  $dbport = getenv("OPENSHIFT_MYSQL_DB_PORT");
  $dbuser = getenv("OPENSHIFT_MYSQL_DB_USERNAME");
  $dbpwd = getenv("OPENSHIFT_MYSQL_DB_PASSWORD");
  $dbname = getenv("OPENSHIFT_MYSQL_DBNAME");
  $connection = mysql_connect($dbhost.":".$dbport, $dbuser, $dbpwd)
    or die("Some error occurred during connection " . mysql_error($connection));
  if (!$connection) {
      echo "Could not connect to database";
  }

  $dbconnection = mysql_select_db($dbname);
  // Query to identify active bluetooth devices, and LEFTJOIN
  //with registered bluetooth devices on the MAC address
  $query = "SELECT ActiveBlueTooth.MAC, UserMACs.User,
  ActiveBlueTooth.DeviceName, ActiveBlueTooth.SensorID
  FROM ActiveBlueTooth LEFT JOIN UserMACs ON ActiveBlueTooth.MAC=UserMACs.MAC
  ORDER BY UserMACs.User;";
  $rs = mysql_query($query);


  echo "<table> <tr> <th> MAC Address </th> <th> Registered Name </th> <th> Device's Reported Name </th> <th> SensorID of detecting Sensor </th> </tr>";   // create the table and heading row

  while ($row = mysql_fetch_assoc($rs)) {
      echo "<tr> <td>"; // begin the line of the database printout

        // If the MAC Address does not have a registered name, provide a link to a registration page where the clicked MAC address is already populated
        // If the MAC Address already has a registered name, then just print the MAC address
    if (is_null($row['User'])) {
        echo "<a href='ExistingbMACsubmit.php?MAC=" . $row['MAC'] . "'>" . $row['MAC'] . "</a>";
    } else {
        echo $row['MAC'];
    }
      echo "</td> <td>" . $row['User'] . "</td><td>" . $row['DeviceName'] . "</td><td>" . $row['SensorID'] . "</td></tr>";  // complete the line of the database printout
  }

  echo "</table>";  // close out the table
  mysql_close();
?>
        <br>
        <h1>Visible WIFI MAC Addresses</h1>

        <?php
  $dbhost = getenv("SNIFFERDB_SERVICE_HOST");
  $dbport = getenv("OPENSHIFT_MYSQL_DB_PORT");
  $dbuser = getenv("OPENSHIFT_MYSQL_DB_USERNAME");
  $dbpwd = getenv("OPENSHIFT_MYSQL_DB_PASSWORD");
//    echo "Here is your dbpwd variable: " . $dbpwd . "<br>";
  $dbname = getenv("OPENSHIFT_MYSQL_DBNAME");;
//    echo "Here is your dbname variable: " . $dbname . "<br>";
  $connection = mysql_connect($dbhost.":".$dbport, $dbuser, $dbpwd);
    //echo "Here is your connection variable: " . $connection . "<br>";
  if (!$connection) {
      echo "Could not connect to database";
  }

  $dbconnection = mysql_select_db($dbname, $connection);

  // Query to Left Join the detected WIFI devices with registered WIFI devices
  //based upon MAC address
  $query = "SELECT ActiveWIFI.MAC, WIFIMACs.User, WIFIMACs.SSID as rSSID,
  ActiveWIFI.SSID as aSSID, ActiveWIFI.SensorID
  FROM ActiveWIFI LEFT JOIN WIFIMACs ON ActiveWIFI.MAC=WIFIMACs.MAC
  ORDER BY WIFIMACs.User";
  $rs = mysql_query($query);
  //echo "my resultset: " . $rs;
  echo "<table> <tr> <th> MAC Address </th> <th> Registered Name </th> <th> Registered SSID* </th> <th> Device's Reported SSID* </th> <th> SensorID of detecting Sensor </th> </tr>";   // create the table and heading row


  while ($row = mysql_fetch_assoc($rs)) {
      echo "<tr> <td>"; // start row per DB line entry

        // If the MAC Address does not have a registered name, provide a link to a registration page where the clicked MAC address is already populated
        // If the MAC Address already has a registered name, then just print the MAC address
    if (is_null($row['User'])) {
        echo "<a href='ExistingwMACsubmit.php?MAC=" . $row['MAC'] . "'>" . $row['MAC'] . "</a>";
    } else {
        echo $row['MAC'];
    }

      echo "</td> <td>" . $row['User'] . "</td><td>" . $row['rSSID'] . "</td><td>" . $row['aSSID'] . "</td><td>" . $row['SensorID'] . "</td></tr>";  // complete the line per response
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
