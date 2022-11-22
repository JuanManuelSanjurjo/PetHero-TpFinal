<?php  include('header.php'); ?>

<div class="container" style="background: #5f04aa;">

    <div class="coupon" style="text-align: center;">
        <div class="container" style="background:  #5f04aa;">
        <br>
          <h1 style="color:aliceblue">Pet Hero</h1>
        </div>
        <div class="container" style="background:  #ff9900; font-weight: bold">
        <br>
          <p><?php echo "Client: ".$name . " " . $surname ?></p>
          <p><?php echo "Pet: ".$pet ?></p>
          <p><?php echo "Selected Keeper: ".$keeper ?></p>
          <p><?php echo "From " .$dateStart . " to " .$dateEnd ?></p>
          <p><?php echo "Total fee: $" . $total ?></p>
          <p><?php echo "Payment requiered 50%: $" . ($total / 2); ?></p>
          <p style="color:firebrick"><?php echo "The remanent must be payed on arrival"; ?></p>
          <p><?php echo "Reservation Number: #". $reservationNumber ?></p>
          <div class="imgcontainer">
            <img src="<?php echo $qrCupon?>" alt="qr"  >
          </div>
          <p><?php echo "QR code"?></p>
          <div class="imgcontainer">
               <img src="<?php echo $barcodeCupon?>" alt="barcode" >
          </div>
          <p><?php echo "Pago Facil / Rapipago"?></p>
          <p style="color:firebrick"><?php echo "Dont forget to upload your payments in the corresponding reservation"?></p>
          <br>
        </div>
        <div class="container"  style="background:  #5f04aa;">
          <p class="expire"  style="color:aliceblue;font-weight: bold"> <?php echo "Reservation expires: " . date('y /m /d', strtotime('+3 days')) ?></p>
          <br>
        </div>
      </div>

</div>

  <div class="container">
      <br>
      <a  href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>"><button class="medium-button">go back</button></a>
    </div>


<?php    include('footer.php'); ?>

