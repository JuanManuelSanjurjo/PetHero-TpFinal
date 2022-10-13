<?php require 'header.php'; ?>


<form action="<?php echo FRONT_ROOT."Pet/registerPet"?>">
  <div class="container">
    <h1>Register Pet</h1>
    <p class="p-text">Fill in this form to add a Pet</p>
    <br>    
    <label for="email"><b></b></label>
    <input type="text" placeholder="Enter name" name="name" id="Name" required>
    <br>
    <label for="breed"><b></b></label>
    <input type="text" placeholder="Enter the breed" name="breed" id="Breed" required>
    <br>
    <label for="role" class="p-text">Size</label>
        <select class="dog-select" name="user-role" id="role" required>
            <optgroup label="Web">
                <option value="small">Small dog</option>
                <option value="medium">Medium dog</option>
                <option value="bif">Big dog</option>
            </optgroup>
        </select> 
    <br>
    <label for="photo"><b class="p-text">Photo of your pet</b></label>
    <input type="file" placeholder="Photo of your pet" name="photo" id="Photo" required>
    <br>
    <br>
    <label  for="photo"><b class="p-text">Image of the Vaxination plan</b></label>
    <input type="file" placeholder="Image of the Vaxination plan" name="vaxPlanImg" id="VaxPlanImg" required>
    <hr>
    <label for="observations"></label> <br>
    <textarea name="observations" placeholder="Something special the keeper needs to know about" id="about" cols="30" rows="10"></textarea> 
    <br>
    <input type="hidden" id="custId" name="<?php ?>" value="3487"> <!-- aca es donde iria los datos de usuario SESSION -->
    <input type="hidden" id="custId" name="custId" value="3487"> 
    <br>
    <br>


    <button type="submit" class="large-button">Add Pet</button>
  </div>
  
  <div class="container signin">
    <p class="p-text"><a href="<?php echo FRONT_ROOT.'Home/showHomeView'?>">Main Menu</a></p>
  </div>
</form>




<?php require 'footer.php'; ?>