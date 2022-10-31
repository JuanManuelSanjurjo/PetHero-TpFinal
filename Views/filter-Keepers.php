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



<?php    include('footer.php'); ?>