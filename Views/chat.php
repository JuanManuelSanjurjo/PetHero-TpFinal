<?php

use Models\Owner;

 require 'header.php'; ?>

<!--
  <div class="nav-bar" >
  <?php   if($user instanceof Owner) {?>
      <a style="display: inline-block;" href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>"><button class="medium-button" style="width: 10%;" >go back</button></a>
      <?php }else{?>
      <a style="display: inline-block;" href="<?php echo FRONT_ROOT.'Keeper/showHomeView'?>"><button class="medium-button" style="width: 10%;"  >go back</button></a>
  <?php }?>  
  <form class="" style="display: inline-block;" action="<?php echo FRONT_ROOT."Home/logout"?>" method="post" > 

  <button type="submmit" class="cancelbtn" style="width: 10%;align-items: center">Log Out</button>
</form>
</div> 
      -->

<div class="container" style="padding: 0;">
  <form class="nav-bar" action="<?php echo FRONT_ROOT."Home/logout"?>" method="post" > 
  <p class="p-text" style="font-size: 30px; margin: 0"><a style="text-decoration:none" href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>" >PET HERO </a> </p>
  <div style="width: 77%; display:inline-block"></div>

  <button type="submmit" class="cancelbtn" style="width: 10%;">Log Out</button>
</form>
</div> 
<?php   if($user instanceof Owner) {?>
      <a  href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>"><button class="medium-button" style="width: 10%;" >go back</button></a>
      <?php }else{?>
      <a  href="<?php echo FRONT_ROOT.'Keeper/showHomeView'?>"><button class="medium-button" style="width: 10%;"  >go back</button></a>
  <?php }?>

<div class="container">
  <h1 style="margin: 5px;padding: 10px;">Chat between <?php echo $chat->getKeeper()->getUserName()  ?> and <?php echo $chat->getOwner()->getUserName()  ?></h1>
  <form action="<?php echo FRONT_ROOT."Chat/sendMessage"?>" method="post" >
  <textarea name="message"  maxlength="1000" placeholder="Message to send the keeper" id="Observations" cols="30" rows="10" required></textarea> 
    <br>
    <button type="submit"  value="submit"  class="medium-button">Send Message</button>
    <input  class="medium-button"  type="reset" value="Clear">
    <br>
  </div>
  <input type="hidden" id="idChat" name="idChat" value="<?php echo $chat->getId()?>">
  <input type="hidden" id="to" name="keeper" value="<?php echo $chat->getKeeper()->getId() ?>"> 
  <input type="hidden" id="to" name="owner" value="<?php echo $chat->getOwner()->getId() ?>"> 
  <br>
  <table class="table" style="width: 100%;">
    <?php  
          foreach($textList as $text){    
            if($text->getMessage()){
          ?>
          <thead>
            <tr>
              <th style="width: 90%; text-align:left;padding-left: 10px"><?php echo $text->getSender()   ?></th>  
              <th style="width: 10%; text-align:center;">  <?php echo $text->getTextDate()    ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="width: 80%; text-align:left; padding: 10px" class="first-td">  <?php echo $text->getMessage()    ?></td>
            </tr>
          </tbody>
          <?php  }};  ?>
        </table>
      </form>



<?php require 'footer.php'; ?>