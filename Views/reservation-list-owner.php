<?php  include('header.php'); ?>


<h1>Pending reservations</h1>
<table class="table">
          <thead>
            <tr>
              <th style="width: 15%;">Number</th>
              <th style="width: 30%;">Keeper</th>
              <th style="width: 30%;">Pet Name</th>
              <th style="width: 20%;">Photo</th>
              <th style="width: 15%;">Pet type</th>
              <th style="width: 15%;">Pet size</th>
              <th style="width: 20%;">Start</th>
              <th style="width: 20%;">End</th>
              <th style="width: 15%;">Total fee</th>
              <th style="width: 15%;">Status</th>
              <th style="width: 20%;">Chat</th>
            </tr>
          </thead>
          <tbody>
              <?php  foreach($ReservationList as $reservation){     
                  ?>
              <tr>
                  <td class="first-td">  <?php echo $reservation->getReservationNumber();     ?></td>
                  <td class="first-td">  <?php echo $reservation->getKeeper()->getName();     ?></td>
                  <td>  <?php echo  $reservation->getPet()->getName()    ;?></td>
                  <td><img class="pet-img" src="<?php echo FRONT_ROOT.VIEWS_PATH.'user-images/'. $reservation->getPet()->getPhoto(); ?>" alt="<?php echo $reservation->getPet()->getPhoto();  ?>" ></td>
                  <td>  <?php echo  $reservation->getPet()->getPetType()    ;?></td>
                  <td>  <?php echo  $reservation->getPet()->getSize()    ;?></td>
                  <td>  <?php echo  $reservation->getDateStart()    ;?></td>
                  <td>  <?php echo  $reservation->getDateEnd()    ;?></td>
                  <td>  <?php echo "$ " . $reservation->getCompensation();  ?></td>
                  <td>  <?php 
                      if($reservation->getConfirmation()== 1){
                          echo  "confirmed";    
                        }else if($reservation->getConfirmation()=== 0){
                            echo  "rejected";   
                        }elseif (!$reservation->getConfirmation()){
                            echo  "pending";
                        }
                        ;?></td>
                <td >          
                    <form action="<?php echo FRONT_ROOT."Chat/showChat"?>" method="post"> <!-- cambiar el CONTROLLER -->
                    <input type="hidden" id="id" name="keeperId" value="<?php echo $reservation->getKeeper()->getId()  ?>"></input>
                    <input type="hidden" id="id" name="ownerId" value="<?php echo $reservation->getOwner()->getId()  ?>"> </input>
                    <button type="submit"  class="large-button" style="padding: 20px 20px;">Chat</button>
                </form>
                
            </td>
        </tr>
            <?php  };  ?>

          </tbody>
        </table>


   <div class="container">
    <br>
    <a  href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>"><button class="medium-button">go back</button></a>
   </div>


<?php    include('footer.php'); ?>