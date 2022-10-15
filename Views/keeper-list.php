<?php  include('header.php'); ?>

<form action="<?php echo FRONT_ROOT."Home/showKeeperList" ?>" method="get">
        <table class="table">
          <thead>
            <tr>
              <th style="width: 15%;">Username</th>
              <th style="width: 30%;">Name</th>
              <th style="width: 30%;">Compensation</th>
              <th style="width: 15%;">Dogs Accepted</th>
              <th style="width: 10%;">Availability</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($keeperList as $keeper){     
                ?>
              <tr>
                <td>  <?php echo $keeper->getUsername();             ?></td>
                <td>  <?php echo $keeper->getName();                 ?></td>
                <td>  <?php echo $keeper->getCompensation();         ?></td>
                <td>  <?php echo $keeper->getPetType();              ?></td>
                <td>  <?php print_r($keeper->getAvailabilityList()); ?></td>
              </tr>
            <?php  };  ?>

          </tbody>
        </table>
      </form> 


<?php    include('footer.php'); ?>