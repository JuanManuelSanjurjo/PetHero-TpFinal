
<?php require 'header.php'; ?>
<main class="">
     <div class="login-screen">
          <header class="h2-login">
               <h2 >Pet Hero</h2>
          </header>

          <form action="" method="post">
               <div class="imgcontainer">
               <img src="" alt="Avatar" class="avatar">
               </div>

               <div class="container">
               <label for="uname"><b>Email</b></label>
               <input type="mail" placeholder="Enter email" name="email" required>

               <label for="pass"><b>Password</b></label>
               <input type="password" placeholder="Enter Password" name="pass" required>
                    
               <button type="submit">Login</button>
               <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
               </label>
               </div>

               <div class="container" style="background-color:#f1f1f1">
               <button type="button" class="cancelbtn">Cancel</button>
               <span class="psw">Forgot <a href="#">password?</a></span>
               </div>
          </form>






<!-- 
          <form class="form" action="" method="post" class="">
               <div class="form-input">
                    <label class="label" for="">Usuario</label>
                    <input type="text" name="username" class="input-text-login" placeholder="Ingresar usuario">
               </div>
               <div class="form-input">
                    <label class="label" for="">Contraseña</label>
                    <input type="text" name="password" class="input-text-login" placeholder="Ingresar constraseña">
               </div>
               <button class="" type="submit">Iniciar Sesión</button>
          </form>
-->
     </div>
</main>

<?php require 'footer.php'; ?>