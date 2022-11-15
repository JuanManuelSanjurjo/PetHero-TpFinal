<?php  include('header.php'); ?>

    <h1>Your Pets</h1>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 30%;">Name</th>
                <th style="width: 30%;">Breed</th>
                <th style="width: 18%;">Size</th>
                <th style="width: 30%;">Observations</th>
                <th style="width: 15%;">Photo</th>
                <th style="width: 15%;">Vaxination Plan</th>
                <th style="width: 15%;">Video</th>
                <th style="width: 15%;">Modify</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $pet){  
                ?>
            <tr> 
                <form action="<?php echo FRONT_ROOT."Pet/modifyPet"?>" method="post"> <!-- cambiar el CONTROLLER -->
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
                <input type="file" name="photo" id="Photo" accept=".jpeg,.jpg,.pdf,.gif,.png,.jfif">
            </td>
            <td>
                <input type="file" name="vaxPlanImg" id="VaxPlanImg" accept=".jpeg,.jpg,.pdf,.gif,.png,.jfif">
            </td>
            <td> 
                <input type="file"   name="video" id="Video"  > 
            </td>
            <td>      
                <input type="hidden" name="petId" value="<?php echo $pet->getId(); ?>">   
                <button type="submmit" class="large-button">Modify</button>
            </td>
        </form>
        </tr>
            <?php  };  ?>
          
        </tbody>
        </table>


  <div class="container">
    <br>
    <a  href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>"><button class="medium-button">Home</button></a>
  </div>


<?php    include('footer.php'); ?>