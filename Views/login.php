
<?php require 'header.php'; ?>

          <header class="">
               <h1>PET HERO</h1>
          </header>

          <form style="text-align: center;" action="<?php echo FRONT_ROOT."Home/login"?>" method="post">
               <div class="imgcontainer">
               <img src=" <?php echo FRONT_ROOT.IMG_PATH."cheems.png"?>" alt="Avatar" class="avatar">
               </div>

               <p class="p-text" style="font-size: 30px;">Log in</p>
               <div class="container">
               <label for="email"></label> 
               <input type="email" placeholder="Enter email" name="email" id="email" required>
               <br>
               <label for="pass"></label>
               <input type="password" placeholder="Enter Password" name="pass" required>
               <br>
               <br>
               <br>
               <button type="submit" class="large-button">Login</button>
             
               </div>


          </form>
          <div class="container">
               <form action="<?php echo FRONT_ROOT."Home/showRegisterView"?>">
                    <button type="submmit" class="large-button">Register</button>
               </form>
          </div>


<?php require 'footer.php'; ?>