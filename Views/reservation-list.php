<?php  include('header.php'); ?>

<h1 style="margin-bottom:0">List of Keepers</h1>
<table class="table">
          <thead>
            <tr>
              <th style="width: 15%;">Reservation number</th>
              <th style="width: 30%;">Owner</th>
              <th style="width: 30%;">Total fee</th>
              <th style="width: 15%;">Pet name</th>
              <th style="width: 15%;">Pet type</th>
              <th style="width: 15%;">Pet size</th>
              <th style="width: 10%;">Confirmation status</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($reservationList as $reservation){     
                ?>
              <tr>
                <td class="first-td">  <?php echo $reservation->getReservationNumber();     ?></td>
                <td class="first-td">  <?php echo $reservation->getOwner->getName();     ?></td>
                <td class="first-td">  <?php echo $reservation->getCompensation();     ?></td>
                <td class="first-td">  <?php echo $reservation->getPet->getName();     ?></td>
                <td class="first-td">  <?php echo $reservation->getPet->getPetType();     ?></td>
                <td class="first-td">  <?php echo $reservation->getPet->getPetSize();     ?></td>
                <td class="first-td">  <?php echo $reservation->getConfirmation();     ?></td>
                <form action="<?php echo FRONT_ROOT."Reservation/setConfirmation"?>"> <!-- cambiar el CONTROLLER -->
                    <button type="submmit" class="large-button">Book keeper</button>
                </form>
                <form action="<?php echo FRONT_ROOT."Reservation/setConfirmation"?>"> <!-- cambiar el CONTROLLER -->
                    <button type="submmit" class="large-button">Book keeper</button>
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