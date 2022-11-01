<?php  include('header.php'); ?>
<!-- <?php  include('nav-bar.php'); ?> -->

<div class="container">
  <form action="<?php echo FRONT_ROOT."Reservation/showKeeperListToFiltrate"?>" method="post" style="background: linear-gradient( #fdc36b, #e08b3b);"> 
  <p class="p-text">Select your pet</p>
  <select class="dog-select" style="width: 15%"   name="size" id="role" required>
    <?php foreach($petList as $pet){ ?>
      <option value=" <?php echo $pet["id"] ?>"> <?php echo $pet["name"]?> </option>
      <?php  }  ?>
    </select>
    <p class="p-text">Select start of period</p>
    <input type="date" style="width: 15%;" min="<?php getdate() ?>" id="Dates" name="dateStart" placeholder="Select start of period" multiple="true" />
    <p class="p-text" >Select end of period</p>
    <input type="date" style="width: 15%;" min="<?php getdate() ?>" id="Dates" name="dateEnd" placeholder="Select end of period" multiple="true" />
    <button type="submmit" class="large-button" style="width: 15%; margin-left: 2rem">Filter</button>
  </form>
</div>



