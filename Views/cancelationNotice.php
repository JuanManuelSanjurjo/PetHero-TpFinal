<?php  include('header.php'); ?>

<div class="container" style="background: #5f04aa;">

    <div class="coupon" style="text-align: center;">
        <div class="container" style="background:  #5f04aa;">
        <br>
          <h1 style="color:aliceblue">Pet Hero</h1>
        </div>
        <div class="container" style="background:  #ff9900; font-weight: bold">
        <br>
          <p>"Your reservation has been denied"</p>
          <p><?php echo "Client: ".$name . " " . $surname ?></p>
          <p><?php echo "Pet: ".$pet ?></p>
          <p><?php echo "Selected Keeper: ".$keeper ?></p>
          <p><?php echo "From " .$dateStart . " to " .$dateEnd ?></p>
          <p><?php echo "Reservation Number: #". $reservationNumber ?></p>
        </div>
        <div class="container"  style="background:  #5f04aa;">
          <br>
        </div>
      </div>

</div>


<?php    include('footer.php'); ?>
