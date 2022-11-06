<?php  include('header.php'); ?>

    <h1>Your Pets</h1>
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Breed</th>
            <th>Size</th>
            <th>Observations</th>
            <th>Photo</th>
            <th>Vaxination Plan</th>
            <th>Video</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
          <?php    
          foreach($list as $pet){  
            ?>
            <tr>
              <td class="first-td">  <?php echo $pet->getName()                    ?></td>
              <td>  <?php echo $pet->getBreed()                   ?></td>
              <td>  <?php echo $pet->getSize()                    ?></td>
              <td>  <?php echo $pet->getObservations()            ?></td>
              <td><img class="pet-img" src="<?php echo FRONT_ROOT.VIEWS_PATH.'user-images/'. $pet->getPhoto(); ?>" alt="<?php echo $pet->getPhoto()  ?>" ></td>
              <td><img  class="pet-img" src="<?php echo FRONT_ROOT.VIEWS_PATH.'user-images/'. $pet->getVaxPlanImg(); ?>" alt="<?php echo $pet->getVaxPlanImg()  ?>" ></td>
              <td> 
                <?php  if($pet->getVideo() != null){ ?>
                  <video class="pet-video" controls alt="NO VIDEO" width=320 height=240> 
                    <source src="<?php echo FRONT_ROOT.VIEWS_PATH.'user-videos/'. $pet->getVideo();?>"></video>
                  </td>
                  <?php  };  ?>
                  <td>
                  <form action="<?php echo FRONT_ROOT."Owner/removePet"?>" > <!-- cambiar el CONTROLLER -->
                    <input type="hidden" name="petId" value="<?php echo $pet->getId(); ?>">   
                    <button type="submmit" class="large-button">Remove Pet</button>
                  </form>
                  
              </td>
            </tr>
          <?php  };  ?>
          
        </tbody>
      </table>

 

  <div class="container" >
    <br>
    <form action="<?php echo FRONT_ROOT."Owner/showPetModify"?>" > <!-- cambiar el CONTROLLER -->
      <input type="hidden" name="petId" value="<?php echo $pet->getId(); ?>">   
      <button type="submmit" class="medium-button">Modify Pets</button>
    </form>
    <a  href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>"><button class="medium-button">go back</button></a>
  </div>


<?php    include('footer.php'); ?>