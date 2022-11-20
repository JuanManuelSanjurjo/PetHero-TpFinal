<?php  include('header.php'); ?>

<h1>Payments</h1>
<div class="container">
<form action="<?php echo FRONT_ROOT."Payment/getPayment"?>" method="get"> <!-- cambiar el CONTROLLER -->
<img src=" <?php echo FRONT_ROOT.VIEWS_PATH."payments/" . $payment->getFileName() ?>" alt="Payment bill" class="avatar">
<input type="hidden" id="id" name="reservationId" value="<?php echo $payment->getIdReservation() ?>"> 
<button type="submit"  class="medium-button" style="padding: 10px 10px;">Download</button>
</form>
</div>

<div class="container">
 <br>
 <a  href="<?php echo FRONT_ROOT.'Keeper/showHomeView'?>"><button class="medium-button">go back</button></a>
</div>


<?php    include('footer.php'); ?>