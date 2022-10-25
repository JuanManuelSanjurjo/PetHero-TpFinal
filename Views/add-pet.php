<?php require 'header.php'; ?>

<form action="<?php echo FRONT_ROOT."Pet/registerPet"?>" method="post" enctype="multipart/form-data">
  <div class="container">
    <h1>Register Pet</h1>
    <p class="p-text">Fill in this form to add a Pet</p>
    <br>    
    <br>
    <input type="radio" name="petType" id="dog" value="dog" required > <p class="p-text">Add Dog</p>  
    <input type="radio" name="petType" id="cat" value="cat" required> <p class="p-text" >Add Cat</p>  
    <br>
    <label for="name"><b></b></label>
    <input type="text" placeholder="Enter name" name="name" id="Name" required>
    <label for="breed"><b></b></label>
    <input type="text" placeholder="Enter the breed" name="breed" id="Breed" required>
    <br>
    <label for="role" class="p-text">Size</label>
    <br>
        <select class="dog-select"   name="size" id="role" required>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Big">Big</option>
        </select>
    <br>
    <label for="observations"></label> <br>
    <textarea name="observations" maxlength="1000" placeholder="Something special the keeper needs to know about (up to 1000 characters)" id="Observations" cols="30" rows="10"></textarea> 
    <br>
    <br>
    <br>
    <button type="submit" value="submit"  class="large-button">Add Pet</button>
  </div>
</form>

<div class="container">
    <br>
    <a  href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>"><button class="medium-button">go back</button></a>
  </div>


<?php require 'footer.php'; ?>