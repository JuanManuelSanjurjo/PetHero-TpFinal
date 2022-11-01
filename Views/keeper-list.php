<?php  include('header.php'); ?>


<h1>List of Keepers</h1>
<table class="table">
          <thead>
            <tr>
              <th style="width: 15%;">Username</th>
              <th style="width: 30%;">Name</th>
              <th style="width: 30%;">Compensation</th>
              <th style="width: 15%;">Pets Accepted</th>
              <th style="width: 10%;">Book</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($keeperList as $keeper){     
                ?>
              <tr>
                <td class="first-td">  <?php echo $keeper->getUsername();     ?></td>
                <td>  <?php echo $keeper->getName() .' '. $keeper->getSurname();  ?></td>
                <td>  <?php echo '$' . $keeper->getCompensation() . ' /day';   ?></td>
                <td>  <?php echo $keeper->getPetType()." dogs or cats";              ?></td>
                <td>          
                    <form action="<?php echo FRONT_ROOT."Reservation/setBooking"?>"> <!-- cambiar el CONTROLLER -->
                    <input type="hidden" name="keeper" value="<?php $keeper ?>">   
                    <button type="submmit" class="large-button">Book keeper</button>
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