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
   Detected WIFI Device Registration Page
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
      <h1>Registering a detected WIFI MAC address</h1>

      <!-- This page is called from index.php when a detected MAC address, without a registered name, is clicked, and provides a simplier way to register that MAC by autopopulating said field -->

      Please type in the associated SSID for this device, as well as the name you would like to have associated with it:
      <form action="wMACsubmit.php" method="post">
        WIFI MAC:
        <?php echo $_GET['MAC'];?>
        <input type="hidden" name="wMAC" value="<?php echo $_GET['MAC'];?>">
        <br>
        <!-- provide the MAC address to the call, but not in an editable fashion -->
        SSID:
        <input type="text" name="SSID">
        <br> Name:
        <input type="text" name="username">
        <br>
        <input type="submit">
      </form>
      <br>
      <br>

    </article>

    <footer>
      <p style="text-align:center;">Thank You, Team SDE</p>
    </footer>

  </div>

</body>

</html>
