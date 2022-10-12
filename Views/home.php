<?php  include('header.php'); ?>

  <div class="">
      <h1> <a href="<?php echo FRONT_ROOT.'Home/showHomeView'?>">  WELCOME TO <br> PET HERO </a></h1>
  </div>


<!-- PARA USUARIO OWNER -->
  <div class="container">
      <form action="<?php echo FRONT_ROOT."Home/showPetList"?>">
          <button type="submmit" class="login-button">Pet list</button>
      </form>
  </div>

  <div class="container">
      <form action="<?php echo FRONT_ROOT."Home/showKeeperList"?>">
          <button type="submmit" class="login-button">Show Keepers</button>
      </form>
  </div>


  <!-- PARA USUARIO KEEPER   HAY QUE DIVIDIRLO -->
  <div class="container">
    <p class="p-text">Set you availabilities</p>
      <form action="<?php echo FRONT_ROOT."Home/showPetList"?>">
          <button type="submmit" class="login-button">Indicate Availability</button>
      </form>
  </div>


<?php    include('footer.php'); ?>


