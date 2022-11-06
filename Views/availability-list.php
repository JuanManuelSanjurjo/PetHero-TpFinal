<?php  include('header.php'); ?>


<h1>Availabilities</h1>
<table class="table">
          <thead>
            <tr>
              <th style="width: 30%;">Start</th>
              <th style="width: 30%;">End</th>
              <th style="width: 30%;">Cancel Time Slot</th>
   
            </tr>
          </thead>
          <tbody>
            <?php  foreach($availabilityList as $availability){     
                ?>
              <tr>
                <td class="first-td">  <?php echo $availability->getStart();     ?></td>
                <td class="first-td">  <?php echo $availability->getEnd();     ?></td>
                <td>          
                    <form action="<?php echo FRONT_ROOT."Keeper/removeAvailability"?>"> <!-- cambiar el CONTROLLER -->
                    <input type="submit"  value="Cancel" class="large-button" style="padding: 10px 10px;"></input>
                    <input type="hidden" id="id" name="availabilityId" value="<?php echo $availability->getId()  ?>">
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