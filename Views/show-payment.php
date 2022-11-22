<?php  include('header.php'); ?>

<h1>Payment</h1>
<div class="container">
<img src=" <?php echo FRONT_ROOT.VIEWS_PATH."payments/" . $reservation->getPayment() ?>" alt="Payment bill">
</div>
<div class="container">
 <br>
 <a  href="<?php echo FRONT_ROOT.'Keeper/showHomeView'?>"><button class="medium-button">Home</button></a>
</div>


<?php    include('footer.php'); ?>



<!-- <form action="<?php echo FRONT_ROOT."Reservation/getPayment"?>" method="get"> 
<img src=" <?php echo FRONT_ROOT.VIEWS_PATH."payments/" . $reservation->getPayment() ?>" alt="Payment bill">
<input type="hidden" id="id" name="reservationId" value="<?php echo $reservation->getReservationNumber() ?>"> 
<button type="submit"  class="medium-button" style="padding: 10px 10px;">Download</button>
</form> -->