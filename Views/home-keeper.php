<?php  include('header.php'); ?>

  <div class="">
      <h1>   WELCOME TO <br> PET HERO </h1>
  </div>

  <!-- PARA USUARIO KEEPER   HAY QUE DIVIDIRLO -->  
  <div class="container">
    <p class="p-text">Set you availabilities</p>
      <form action="<?php echo FRONT_ROOT."Home/showPetList"?>"> <!-- cambiar el CONTROLLER -->
          <button type="submmit" class="large-button">Indicate Availability</button>
      </form>
  </div>

  <div class="container">
    <p class="p-text">Set your compensation per day</p>
      <form action="<?php echo FRONT_ROOT."Home/setCompensation"?>"> <!-- cambiar el CONTROLLER -->
      <input type="number" placeholder="Set your Fee" min="1" name="compansation" id="Compansation" required>

      <button type="submmit" class="medium-button">Set Fee</button>  
    </form>
  </div>

  <div class="container">
    <p class="p-text">Set pets you are willing to take care</p>
      <form action="<?php echo FRONT_ROOT."Home/showTypeOfPet"?>"> <!-- cambiar el CONTROLLER  y ahcer vista y guardado de las preferencias -->
          <button type="submmit" class="large-button">Set Preferences</button>
      </form>
  </div>


  <!-- LOG OUT LOG OUT LOG OUT -->
  <div class="container">
    <p class="p-text">Log Out</p>
      <form action="<?php echo FRONT_ROOT."Home/logout"?>"> <!-- cambiar el CONTROLLER -->
          <button type="submmit" class="large-button">Log Out</button>
      </form>
  </div>


<?php    include('footer.php'); ?>

