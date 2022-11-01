<?php  include('header.php'); ?>


<h1>List of Keepers</h1>
<table class="table">
          <thead>
            <tr>
              <th style="width: 15%;">Reservation number</th>
              <th style="width: 30%;">Owner</th>
              <th style="width: 30%;">Total fee</th>
              <th style="width: 30%;">Pet Name</th>
              <th style="width: 30%;">Pet type</th>
              <th style="width: 30%;">Pet size</th>
              <th style="width: 15%;">Confirmation Status</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($ReservationList as $reservation){     
                ?>
              <tr>
                <td class="first-td">  <?php echo $reservation->getReservationNumber();     ?></td>
                <td class="first-td">  <?php echo $reservation->getOwner()->getName();     ?></td>
                <td>  <?php echo $reservation->getCompensation();  ?></td>
                <td>  <?php echo '$' . $reservation->getPet()->getName()    ;?></td>
                <td>  <?php echo '$' . $reservation->getPet()->getPetType()    ;?></td>
                <td>  <?php echo '$' . $reservation->getPet()->getSize()    ;?></td>
                <td>  <?php echo '$' . $reservation->getPet()->getConfirmation()    ;?></td>
                <td>          
                    <form action="<?php echo FRONT_ROOT."Reservation/SetConfirmation"?>"> <!-- cambiar el CONTROLLER -->
                    <button type="submmit" value="confirm" class="large-button">Book keeper</button>
                    <button type="submmit" value="reject" class="large-button">Book keeper</button>
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