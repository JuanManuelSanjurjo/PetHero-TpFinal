<?php  include('header.php'); ?>
<!-- <?php  include('nav-bar.php'); ?> -->


    <h1>Make a reservation</h1>
<form action="<?php echo FRONT_ROOT."Reservation/showKeeperListToFiltrate"?>" method="get">
<div>
      <h3>What type of pet want to make a reservation for?</h3>
      
      <p class="p-text" style="position:relative; right:5%">Select start of period</p><p class="p-text" style="position:relative; left:5%">Select end of period</p>
          <br>
       <select name="typeOfPet">
            <option value="Cat">CAT</option>
            <option value="Dog">DOG</option>
       </select>        
          <input type="date" style="width: 25%;" min="<?php getdate() ?>" id="Dates" name="dateStart" placeholder="Select start of period" multiple="true" />
          <input type="date" style="width: 25%;" min="<?php getdate() ?>" id="Dates" name="dateEnd" placeholder="Select end of period" multiple="true" />
          <button type="submmit" class="large-button">Update Availability</button>
          <table class="table">

        </div>

</form>
<!-- /*
    <form action="<?php echo FRONT_ROOT."Reservation/showKeeperList" ?>" method="get">
          <thead>
            <tr>
              <th style="width: 15%;">Username</th>
              <th style="width: 30%;">Name</th>
              <th style="width: 30%;">Compensation</th>
              <th style="width: 15%;">Size Accepted</th>
              <th style="width: 10%;">Availability</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($keeperList as $keeper){     
                ?>
              <tr>
                <td class="first-td">  <?php echo $keeper->getUsername();     ?></td>
                <td>  <?php echo $keeper->getName() .' '. $keeper->getSurname();  ?></td>
                <td>  <?php echo '$' . $keeper->getCompensation() . ' /day';   ?></td>
                <td>  <?php echo $keeper->getPetType();              ?></td>
                <td>  <?php foreach($keeper->getAvailabilityList() as $date){echo $date .'<br>';} ?></td>
              </tr>
            <?php  };  ?>

          </tbody>
        </table>
      </form> 

   <div class="container">
    <br>
    <a  href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>"><button class="medium-button">go back</button></a>
  </div>


*/ -->























<?php    include('footer.php'); ?>