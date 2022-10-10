<?php 
 include('header.php');
 include('nav-bar.php');
?>
<!-- ################################################################################################ 

<div class="wrapper row2 bgded" style="background-image:url('../images/demo/backgrounds/1.png');">
  <div class="overlay">
    <div id="breadcrumb" class="clear"> 
      <ul>
      <li><a href="<?php echo FRONT_ROOT.require_once VIEWS_PATH."add-cellphone.php" ?>">Home</a></li>
        <li><a href="<?php echo FRONT_ROOT."Cellphone/add" ?>">Add</a></li>
        <li><a href="<?php echo FRONT_ROOT."Cellphone/showPhoneList" ?>">List - Remove</a></li>
      </ul>
    </div>
  </div>
</div>
 ################################################################################################ -->
<div class="wrapper row4">
<main class="container clear"> 
    <div class="content"> 
      <div id="comments" >
        <h2>ADD NEW CELLPHONE</h2>
        <form action= "<?php  echo FRONT_ROOT."Cellphone/add"  ?> " method="post"  style="background-color: #EAEDED;padding: 2rem !important;">
          <table> 
            <thead>
              <tr>
                <th>Code</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                <td style="max-width: 100px;">
                  <input type="number" name="Code" min="1" max="999" size="30" required>
                </td>
                <td>
                  <input type="text" name="Brand" size="20" required>
                </td>
                <td>
                  <input type="text" name="Model" size="20" required>
                </td>     
                <td>
                  <input type="text" name="Price" size="10" required>
                </td>         
              </tr>
              </tbody>
          </table>
          <div>
            <input type="submit" class="btn" value="Agregar" style="background-color:#DC8E47;color:white;"/>
          </div>
        </form>
      </div>
    </div>
  </main>
</div>
<!-- ################################################################################################ -->

<?php 
  include('footer.php');
?>