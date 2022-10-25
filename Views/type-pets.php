<?php  include('header.php'); ?>
  <br>
  <br>
  <div class="">
      <h2 style="text-align:center">  Select the Size of pets you are willing to take care </a></h1>
  </div>
  <br>
  <br>

  <div class="container">
      <form action="<?php echo FRONT_ROOT."Keeper/setPetType"?>">    <!-- cambiar el CONTROLLER -->
          <button type="submmit" class="large-button" name="size" value="Small">Small</button>
      </form>
  </div>
  <br>
  <br>
  <div class="container">
      <form action="<?php echo FRONT_ROOT."Keeper/setPetType"?>"> <!-- cambiar el CONTROLLER -->
          <button type="submmit" class="large-button" name="size" value="Medium">Medium</button>
      </form>
  </div>
  <br>
  <br>
  <div class="container">
      <form action="<?php echo FRONT_ROOT."Keeper/setPetType"?>"> <!-- cambiar el CONTROLLER -->
          <button type="submmit" class="large-button" name="size" value="Big">Big</button>
      </form>
  </div>
  <br>
  <br>
  <!-- LOG OUT LOG OUT LOG OUT -->
  <div class="container">
    <p class="p-text">Log Out</p>
      <form action="<?php echo FRONT_ROOT."Home/logout"?>"> <!-- cambiar el CONTROLLER -->
          <button type="submmit" class="large-button">Log Out</button>
      </form>
  </div>


<?php    include('footer.php'); ?>

