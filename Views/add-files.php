<?php require 'header.php'; ?>


<form action="<?php echo FRONT_ROOT."Pet/uploadFile"?>" method="post" enctype="multipart/form-data">
  <div class="container">
    <h1>Register Pet</h1>
    <p class="p-text">Fill in this form to add a Pet</p>
    <br>    
    <br>
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
    <br>
    <button type="submit" value="submit"  class="large-button">Add Pet</button>
  </div>
</form>

<div class="container">
    <br>  <!-- !!!!!PONER UNA CONDICION DE QUE SI SE VA PARA ATRAS BORRA EL PET SIN FOTOS!!!!!!-->
    <form action="<?php echo FRONT_ROOT."Pet/cancelPetRegister"?>" method="post">
    <input type="hidden" name="idPet" value="<?php echo $pet->getId() ?>">
    <button type="submit" class="cancelbtn" >Cancel</button></a>
    </form>
  </div>


<?php require 'footer.php'; ?>