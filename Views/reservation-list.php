<?php  include('header.php'); ?>


<h1>Reservations</h1>
<table class="table">
          <thead>
            <tr>
              <th style="width: 15%;">Reservation number</th>
              <th style="width: 30%;">Owner</th>
              <th style="width: 30%;">Total fee</th>
              <th style="width: 30%;">Pet Name</th>
              <th style="width: 30%;">Pet type</th>
              <th style="width: 30%;">Pet size</th>
              <th style="width: 15%;">Status</th>
              <th style="width: 15%;">Confirm</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($ReservationList as $reservation){     
                ?>
              <tr>
                <td class="first-td">  <?php echo $reservation->getReservationNumber();     ?></td>
                <td class="first-td">  <?php echo $reservation->getOwner()->getName();     ?></td>
                <td>  <?php echo $reservation->getCompensation();  ?></td>
                <td>  <?php echo  $reservation->getPet()->getName()    ;?></td>
                <td>  <?php echo  $reservation->getPet()->getPetType()    ;?></td>
                <td>  <?php echo  $reservation->getPet()->getSize()    ;?></td>
                <td>  <?php 
                      if($reservation->getConfirmation()== 1){
                        echo  "confirmed";    
                      }else if($reservation->getConfirmation()=== 0){
                        echo  "rejected";   
                      }elseif (!$reservation->getConfirmation()){
                        echo  "pending";
                      }
                          ;?></td>
                <td>          
                    <form action="<?php echo FRONT_ROOT."Reservation/setConfirmation"?>"> <!-- cambiar el CONTROLLER -->
                    <button type="submmit" value="confirm" class="large-button" style="padding: 10px 10px;">Confirm</button>
                    <button type="submmit" value="reject" class="large-button" style="padding: 10px 10px;">Reject</button>
                    <input type="hidden" id="id" name="reservationId" value="<?php $reservation->getReservationNumber  ?>">
                    </form>
              </td>
              </tr>
            <?php  };  ?>

          </tbody>
        </table>


   <div class="container">
    <br>
    <a  href="<?php echo FRONT_ROOT.'Keeper/showHomeView'?>"><button class="medium-button">go back</button></a>
   </div>


<?php    include('footer.php'); ?>