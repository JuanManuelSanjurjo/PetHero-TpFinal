<?php  include('header.php'); ?>


<h1>Chats</h1>
<table class="table">
          <thead>
            <tr>
              <th style="width: 15%;">Number</th>
              <th style="width: 30%;">Name</th>
              <th style="width: 30%;">Surname</th>
              <th style="width: 20%;">Chat</th>
            </tr>
          </thead>
          <tbody>
              <?php  foreach($list as $chat){
                  ?>
              <tr>
                  <td class="first-td">  <?php echo $chat->getOwner()->getUserName();     ?></td>
                  <td class="first-td">  <?php echo $chat->getOwner()->getName();     ?></td>
                  <td class="first-td">  <?php echo $chat->getOwner()->getSurname();     ?></td>
                <td >          
                    <form action="<?php echo FRONT_ROOT."Chat/showChat"?>" method="post"> <!-- cambiar el CONTROLLER -->
                    <input type="hidden" id="id" name="keeper" value="<?php echo $chat->getKeeper()->getId()  ?>"></input>
                    <input type="hidden" id="id" name="owner" value="<?php echo $chat->getOwner()->getId()  ?>"> </input>
                    <button type="submit"  class="large-button" style="padding: 20px 20px;">Chat</button>
                </form>
                
            </td>
        </tr>
            <?php  };  ?>

          </tbody>
        </table>


   <div class="container">
    <br>
    <a  href="<?php echo FRONT_ROOT.'Keeper/showHomeView'?>"><button class="medium-button">go back</button></a>
   </div>


<?php    include('footer.php'); ?>