<?php  include('header.php'); ?>

  <div class="">
      <h1>   WELCOME TO <br> PET HERO </h1>
  </div>



  <!-- PARA USUARIO KEEPER   HAY QUE DIVIDIRLO -->  
  <div class="container">
    <p class="p-text">Indicate Availability</p>
      <form action="<?php echo FRONT_ROOT."Home/addAvilability"?>" method="post"> 
          <input type="date" min="<?php getdate() ?>" id="Dates" name="dates" placeholder="Select days" multiple="true" />
          <button type="submmit" class="large-button">Update Availability</button>
      </form>
  </div>


  <div class="container">
    <p class="p-text">Set your compensation per day</p>
      <form action="<?php echo FRONT_ROOT."Home/setCompensation"?>" method="post"> 
      <input type="number" placeholder="Set your Fee" min="1" name="compensation" id="Compensation" required>

      <button type="submmit" class="medium-button">Set Fee</button>  
    </form>
  </div>

  <div class="container">
    <p class="p-text">Set pets you are willing to take care</p>
      <form action="<?php echo FRONT_ROOT."Home/showTypeOfPet"?>" method="post"> 
          <button type="submmit" class="large-button">Set Preferences</button>
      </form>
  </div>


  <!-- LOG OUT LOG OUT LOG OUT -->
  <div class="container">
    <p class="p-text">Log Out</p>
      <form action="<?php echo FRONT_ROOT."Home/logout"?>" method="post"> 
          <button type="submmit" class="large-button">Log Out</button>
      </form>
  </div>


<?php    include('footer.php'); ?>

