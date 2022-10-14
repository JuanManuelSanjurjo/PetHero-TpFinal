<?php  include('header.php'); ?>

  <div class="">
      <h1> <a href="<?php echo FRONT_ROOT.'Home/showHomeView'?>">  WELCOME TO <br> PET HERO </a></h1>
  </div>


<!-- PARA USUARIO OWNER -->
  <div class="container">
      <form action="<?php echo FRONT_ROOT."Pet/showMyPetList"?>">    <!-- cambiar el CONTROLLER -->
          <button type="submmit" class="large-button">Pet list</button>
      </form>
  </div>

  <div class="container">
      <form action="<?php echo FRONT_ROOT."Home/showKeeperList"?>"> <!-- cambiar el CONTROLLER -->
          <button type="submmit" class="large-button">Show Keepers</button>
      </form>
  </div>

  <div class="container">
      <form action="<?php echo FRONT_ROOT."Pet/showAddPet"?>"> <!-- cambiar el CONTROLLER -->
          <button type="submmit" class="large-button">Add Pet</button>
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

