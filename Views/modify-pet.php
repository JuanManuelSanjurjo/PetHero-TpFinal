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
                <th>Modify</th>
            </tr>
        </thead>
        <tbody>
            <?php    
          foreach($list as $pet){  
              ?>
            <form action="<?php echo FRONT_ROOT."Owner/modifyPet"?>"> <!-- cambiar el CONTROLLER -->
            <tr> 
                <td class="first-td"> <input type="text" name="name" value=" <?php echo $pet->getName() ?>" required></td>
                <td>  <input type="text" name="breed" value=" <?php echo $pet->getBreed() ?>"></td>
                <td>  
                    <select class="dog-select" value=" <?php echo $pet->getSize() ?>"  name="size" id="role" required>
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Big">Big</option>
                    </select>
                </td>
                <td style="min-width: 100px" >  <textarea name="observations" placeholder=" <?php echo $pet->getObservations()      ?>"></textarea>
                <td>
                <input type="file"  name="photo" id="Photo" accept=".jpeg,.jpg,.pdf,.gif,.png,.jfif">
                <input type="hidden" name="photoOG" value="<?php echo  $pet->getPhoto(); ?>">
            </td>
                <td>
                    <input type="file"   name="vaxPlanImg" id="VaxPlanImg" accept=".jpeg,.jpg,.pdf,.gif,.png,.jfif">
                    <input type="hidden" name="vaxPlanImgOG" value="<?php echo $pet->getVaxPlanImg(); ?>">
                </td>
                <td> 
                    <input type="file"   name="video" id="Video"  > 
                    <input type="hidden" name="videoOG" value="<?php echo $pet->getVideo(); ?>">
                </td>
                <td>      
                      <input type="hidden" name="petId" value="<?php echo $pet->getId(); ?>">   
                    <button type="submmit" class="large-button">Modify</button>
                </td>
            </tr>
            </form>
            <?php  };  ?>
          
        </tbody>
        </table>


  <div class="container">
    <br>
    <a  href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>"><button class="medium-button">Home</button></a>
  </div>


<?php    include('footer.php'); ?>