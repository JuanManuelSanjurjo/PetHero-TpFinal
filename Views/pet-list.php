<?php  include('header.php'); ?>

<form action="<?php echo FRONT_ROOT."Pet/showMyPetList" ?>" method="GET">
    <?php echo "dale pa";?>
        <table style="text-align:center;">
          <thead>
            <tr>
              <th style="width: 15%;">Name</th>
              <th style="width: 30%;">Photo</th>
              <th style="width: 30%;">Breed</th>
              <th style="width: 15%;">Size</th>
              <th style="width: 10%;">Vaxination Plan</th>
              <th style="width: 30%;">Observations</th>
            </tr>
          </thead>
          <tbody>
            <?php    foreach($petList as $pet){  
                if($_SESSION["loggedUser"]->getId()===$pet->getIdOwner()){                
                ?>
              <tr>
                <td>  <?php echo $pet->getName()                    ?></td>
                <td>  <?php echo $pet->getPhoto()                   ?></td>
                <td>  <?php echo $pet->getBreed()                   ?></td>
                <td>  <?php echo $pet->getSize()                    ?></td>
                <td>  <?php echo $pet->getVaxPlanImg()              ?></td>
                <td>  <?php echo $pet->getObservations()            ?></td>
              </tr>
            <?php  }};  ?>
            
          </tbody>
        </table>
      </form> 


<?php    include('footer.php'); ?>