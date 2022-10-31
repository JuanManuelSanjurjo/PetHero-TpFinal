<?php  include('header.php'); ?>

<form action="<?php echo FRONT_ROOT."Pet/showMyPetList" ?>" method="GET">
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
          </tr>
        </thead>
        <tbody>
          <?php    
          $list = $user->getPetList();
          var_dump($list);
          foreach( $list as $pet){  
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
            </tr>
          <?php  };  ?>
          
        </tbody>
      </table>
    </form> 

  <div class="container">
    <br>
    <a  href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>"><button class="medium-button">go back</button></a>
  </div>


<?php    include('footer.php'); ?>