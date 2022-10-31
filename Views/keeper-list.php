<?php  include('header.php'); ?>

<div class="container">
  <form action="<?php echo FRONT_ROOT."Reservation/filterKeepers"?>" method="post" style="background: linear-gradient( #fdc36b, #e08b3b);"> 
  <p class="p-text">Select your pet</p>
  <select class="dog-select" style="width: 15%"   name="size" id="role" required>
    <?php foreach($petList as $pet){ ?>
      <option value=" <?php $pet ?>"> <?php $pet->getName() ?> </option>
      <?php  }  ?>
    </select>
    <p class="p-text">Select start of period</p>
    <input type="date" style="width: 15%;" min="<?php getdate() ?>" id="Dates" name="dateStart" placeholder="Select start of period" multiple="true" />
    <p class="p-text" >Select end of period</p>
    <input type="date" style="width: 15%;" min="<?php getdate() ?>" id="Dates" name="dateEnd" placeholder="Select end of period" multiple="true" />
    <button type="submmit" class="large-button" style="width: 15%; margin-left: 2rem">Filter</button>
  </form>
</div>

<h1 style="margin-bottom:0">List of Keepers</h1>
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