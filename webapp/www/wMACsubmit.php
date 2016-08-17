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
   WIFI Registration Page
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
      <h1>Welcome to the WIFI Registration</h1>

      <!-- page to do the insertion of a WIFI device, after the data is checked to be valid (valid MAC, valid user, valid SSID, new MAC address)
     and then provides the user an oppurtunity to submit/enter another WIFI device -->

      <br>
      <p>
        <?php
  $wMAC = $_POST["wMAC"]; // what was entered as a MAC Address
	echo "Here is your entered MAC: " . $wMAC . "<br>";
  $SSID = $_POST["SSID"]; // what was entered as a username
	echo "Here is your entered SSID: " . $SSID . "<br>";
  $username = $_POST["username"]; // what was entered as a username
	echo "Here is your entered name: " . $username . "<br>";
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

  // Check that the input is valid
  $validCheck = 0;
  if(!preg_match("/^[0-9a-fA-F]{2}(?=([:;.]?))(?:\\1[0-9a-fA-F]{2}){5}$/",$wMAC)) { // check if valid MAC


     echo "<br><br> ERROR: Please enter a valid Bluetooth MAC Address <br><br>"; // failed valid MAC Address

  } else {

    if(!preg_match("/^[0-9a-zA-Z ]*$/",$SSID)) { // check if valid SSID

        echo "<br><br> ERROR: Please enter a valid SSID <br><br>"; // failed SSID

    } else {


    	if(!preg_match("/^[0-9a-zA-Z ]*$/",$username)) { // check if valid username

        	echo "<br><br> ERROR: Please enter a valid name <br><br>"; // failed username

    	} else {

		$dbconnection = mysql_select_db($dbname);
		$sql = "SELECT COUNT(*) AS total FROM WIFIMACs WHERE MAC = '" . $wMAC . "'"; // does a count of desired MAC to see if it exists or not yet
		$results = mysql_query($sql);
		$row = mysql_fetch_assoc($results);
		$total = $row['total'];

		//echo "<br><br> total = " . $total . "<br><br>";

		if($total == 1) {

            		echo "<br><br> ERROR: Please enter a unique MAC Address <br><br>"; // failed unique MAC Address

	        } else {


		        $validCheck = 1;

	        }
	}

    }
  }



  //echo "<br><br> Your validCheck is: " . $validCheck . "<br><br>";

  if($validCheck == 1) { // only insert data, if data is valid
      	$dbconnection = mysql_select_db($dbname);
	$sql = "INSERT INTO WIFIMACs " . "(MAC, SSID, User) " . "VALUES ('" . $wMAC . "', '" . $SSID . "', '" . $username ."' )"; // inserts the data, if it is valid
        $retval = mysql_query($sql);

        //echo "<br><br> Query is: " . $sql . " <br><br> and results are: " . $retval . " <br><br>";

	if (! $retval ) { //provide the user feedback if the data was entered
		echo "<br><br> ERROR: Could not enter data <br>";
	} else {
		echo " <br><br> Data successfully entered <br>";
	}

  }



  mysql_close();
?>
          <br>
          <h1>Would you like to register another WIFI MAC address?</h1> Please type in the MAC address of your WIFI device, the associated SSID for this device, and the name you would like to have associated with it:
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
          <a href="WIFIReg.php">Click Here to return to the WIFI Registration page</a></li>

    </article>

    <footer>
      <p style="text-align:center;">Thank You, Team SDE</p>
    </footer>

  </div>

</body>

</html>
