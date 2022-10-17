<?php require 'header.php'; ?>


<form action="<?php echo FRONT_ROOT."Pet/registerPet"?>" method="post" enctype="multipart/form-data">
  <div class="container">
    <h1>Register Pet</h1>
    <p class="p-text">Fill in this form to add a Pet</p>
    <br>    
    <br>
    <label for="name"><b></b></label>
    <input type="text" placeholder="Enter name" name="name" id="Name" required>
    <br>
    <label for="breed"><b></b></label>
    <input type="text" placeholder="Enter the breed" name="breed" id="Breed" required>
    <br>
    <label for="role" class="p-text">Size</label>
     <br>
        <select class="dog-select"   name="size" id="role" required>
            <optgroup label="Dog Size" >
                <option value="small">Small dog</option>
                <option value="medium">Medium dog</option>
                <option value="big">Big dog</option>
            </optgroup>
        </select> 
    <br>
    <!--
    <label for="photo"><b class="p-text">Photo of your pet</b></label>
    <input type="file" placeholder="Photo of your pet" name="photo" id="Photo" required>
    <br>
    <label for="vaxPlanImg"><b class="p-text">Image of Vaxination schedule</b></label>
    <input type="file" placeholder="Image of the Vaxination plan" name="vaxPlanImg" id="VaxPlanImg" >
    <br>
    <label for="video"><b class="p-text">Upload a video of your pet</b></label>
    <input type="file" placeholder="Video of your pet" name="video" id="Video"  > 
    <br>
    <hr>
    <br>
-->
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
    <a  href="<?php echo FRONT_ROOT.'Home/showHomeView'?>"><button class="medium-button">go back</button></a>
  </div>


<?php require 'footer.php'; ?>