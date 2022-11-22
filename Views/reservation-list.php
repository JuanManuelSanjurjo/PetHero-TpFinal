<?php  include('header.php'); ?>

<h1>Pending reservations</h1>
<table class="table">
          <thead>
            <tr>
              <th style="width: 10%;">Number</th>
              <th style="width: 25%;">Owner</th>
              <th style="width: 15%;">Total fee</th>
              <th style="width: 20%;">Pet Name</th>
              <th style="width: 20%;">Photo</th>
              <th style="width: 15%;">Pet type</th>
              <th style="width: 15%;">Pet size</th>
              <th style="width: 20%;">Start</th>
              <th style="width: 20%;">End</th>
              <th style="width: 15%;">Status</th>
              <th style="width: 15%;">Payment</th>
              <th style="width: 20%;">Confirm</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($ReservationList as $reservation){     
                ?>
              <tr>
                <td class="first-td">  <?php echo $reservation->getReservationNumber();     ?></td>
                <td class="first-td">  <?php echo $reservation->getOwner()->getName();     ?></td>
                <td>  <?php echo "$ " . $reservation->getCompensation();  ?></td>
                <td>  <?php echo  $reservation->getPet()->getName()    ;?></td>
                <td><img class="pet-img" src="<?php echo FRONT_ROOT.VIEWS_PATH.'user-images/'. $reservation->getPet()->getPhoto(); ?>" alt="<?php echo $reservation->getPet()->getPhoto();  ?>" ></td>
                <td>  <?php echo  $reservation->getPet()->getPetType()    ;?></td>
                <td>  <?php echo  $reservation->getPet()->getSize()    ;?></td>
                <td>  <?php echo  $reservation->getDateStart()    ;?></td>
                <td>  <?php echo  $reservation->getDateEnd()    ;?></td>
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
                    <form action="<?php echo FRONT_ROOT."Reservation/showPayment"?>" method="post"> <!-- cambiar el CONTROLLER -->
                    <input type="hidden" id="id" name="reservationId" value="<?php echo $reservation->getReservationNumber()  ?>">
                    <button type="submit"  class="large-button" style="padding: 10px 10px;">check</button>
                  </form>
               
                </td>
                <td >          
                  <?php if($reservation->getConfirmation() === NULL) {  ?>
                    <form action="<?php echo FRONT_ROOT."Reservation/setConfirmation"?>" method="post"> <!-- cambiar el CONTROLLER -->
                    <input type="submit" name="confirmation" value="confirm" class="large-button" style="padding: 10px 10px;"></input>
                    <input type="hidden" id="id" name="reservationId" value="<?php echo $reservation->getReservationNumber()  ?>">
                   </form>
                   <form action="<?php echo FRONT_ROOT."Reservation/setConfirmation"?>" method="post"> <!-- cambiar el CONTROLLER -->
                      <input type="submit" name="confirmation" value="reject" class="large-button" style="padding: 10px 10px;"></input>
                      <input type="hidden" id="id" name="reservationId" value="<?php echo $reservation->getReservationNumber()  ?>">
                    </form>
                    <?php }  ?>
                    <form action="<?php echo FRONT_ROOT."Chat/showChat"?>" method="post"> <!-- cambiar el CONTROLLER -->
                    <input type="hidden" id="id" name="keeper" value="<?php echo $reservation->getKeeper()->getId()  ?>"></input>
                    <input type="hidden" id="id" name="owner" value="<?php echo $reservation->getOwner()->getId()  ?>"> </input>
                    <button type="submit"  class="large-button" style="padding: 10px 10px;">Chat</button>
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