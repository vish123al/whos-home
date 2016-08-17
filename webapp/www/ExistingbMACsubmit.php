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
   Detected BlueTooth Device Registration Page
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
      <h1>Registering a detected BlueTooth MAC address</h1>
      <br>

      <!-- This page is called and referenced from the index.php page, when a user clicks a MAC address that does not currently have a registered name -->

      Please type in the name you would like to have associated with your selected MAC Address:
      <form action="bMACsubmit.php" method="post">
        Bluetooth MAC:
        <?php echo $_GET['MAC'];?>
        <input type="hidden" name="bMAC" value="<?php echo $_GET['MAC'];?>">
        <br>
        <!-- provide the selected MAC address, but not in an editable fashion -->
        Name:
        <input type="text" name="username">
        <br>
        <input type="submit">
      </form>
      <br>

    </article>

    <footer>
      <p style="text-align:center;">Thank You, Team SDE</p>
    </footer>

  </div>

</body>

</html>
