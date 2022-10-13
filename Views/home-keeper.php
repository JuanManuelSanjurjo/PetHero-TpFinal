<?php  include('header.php'); ?>

  <div class="">
      <h1> <a href="<?php echo FRONT_ROOT.'Home/showHomeView'?>">  WELCOME TO <br> PET HERO </a></h1>
  </div>

  <!-- PARA USUARIO KEEPER   HAY QUE DIVIDIRLO -->
  <div class="container">
    <p class="p-text">Set you availabilities</p>
      <form action="<?php echo FRONT_ROOT."Home/showPetList"?>"> <!-- cambiar el CONTROLLER -->
          <button type="submmit" class="large-button">Indicate Availability</button>
      </form>
  </div>

  <div class="container">
    <p class="p-text">Set pets you are willing to take care</p>
      <form action="<?php echo FRONT_ROOT."Home/showPetList"?>"> <!-- cambiar el CONTROLLER  y ahcer vista y guardado de las preferencias -->
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

