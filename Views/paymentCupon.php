<?php  include('header.php'); ?>

<div class="container" style="background: #5f04aa;">

    <div class="coupon" style="text-align: center;">
        <div class="container" style="background:  #5f04aa;">
          <h1 style="color:aliceblue">Pet Hero</h1>
        </div>
        <div class="container" style="background: linear-gradient( #ff9900, #e97100); font-weight: bold">
          <p><?php echo $name . " " . $surname ?></p>
          <p><?php echo $pet ?></p>
          <p><?php echo $keeper ?></p>
          <p><?php echo "From " .$dateStart . " to " .$dateEnd ?></p>
          <p><?php echo "Total fee: $ " . $total ?></p>
          <p><?php echo "Reservation Number: ". $reservationNumber ?></p>
          <div class="imgcontainer">
               <img src=" C:\xampp\htdocs\PHP\TPFinal\Views\img\cheems.png" alt="Avatar" >
          </div>
          <div class="imgcontainer">
          <img src=" TPFinal\Views\img\barcode_cupon.jpeg" alt="Avatar" >
          </div>
          <div class="imgcontainer">
          <img src=" TPFinal\Views\img\barcode_cupon.jpeg" alt="Avatar" >
          </div>
          
        </div>
        <div class="container"  style="background:  #5f04aa;">
          <p class="expire"  style="color:aliceblue"> <?php echo "Expires:  " . date('y:m:d', strtotime('+3 days')) ?></p>
        </div>
      </div>

</div>
    


      <?php    include('footer.php'); ?>

