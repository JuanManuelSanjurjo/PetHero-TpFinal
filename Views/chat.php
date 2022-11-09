<?php require 'header.php'; ?>


<div class="container" style="padding: 0;">
  <form class="nav-bar" action="<?php echo FRONT_ROOT."Home/logout"?>" method="post" > 
  <p class="p-text" style="font-size: 30px; margin: 0"><a style="text-decoration:none" href="<?php echo FRONT_ROOT.'Owner/showHomeView'?>" >PET HERO </a> </p>
  <div style="width: 77%; display:inline-block"></div>
  <button type="submmit" class="cancelbtn" style="width: 10%;">Log Out</button>
</form>
</div> 


<form action="<?php echo FRONT_ROOT."Chat/sendMessage"?>" method="post" enctype="multipart/form-data">
<div class="container">
    <h1 style="margin: 5px;padding: 10px;">Chat with the keeper</h1>
    <textarea name="message"  maxlength="1000" placeholder="Message to send the keeper" id="Observations" cols="30" rows="10"></textarea> 
    <br>
    <button type="submit"  value="submit"  class="medium-button">Send Message</button>
    <input  class="medium-button"  type="reset" value="Clear">
</div>
</form>
<br>
<table class="table" style="width: 100%;">
        <?php  
        $textList = ["marcos","hola c respect  comcer respectal respect  comcer algo al respect  comcer algo al respect","asd","asd","asd"];
        foreach($textList as $text){     
            ?>
          <thead>
            <tr>
              <th style="width: 90%; text-align:left;padding-left: 10px"><?php echo $text   //$text->getFrom()->getName()   ?></th>  
              <th style="width: 10%; text-align:center;">  <?php echo "20-11-2022" //$text->getDate()    ?></th>
            </tr>
          </thead>
          <tbody>
              <tr>
                  <td style="width: 80%; text-align:left; padding: 10px" class="first-td">  <?php echo $text //$text->getMessage()    ?></td>
             </tr>

            </tbody>
        <?php  };  ?>
</table>





<?php require 'footer.php'; ?>