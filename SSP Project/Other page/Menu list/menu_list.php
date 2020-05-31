<?php
// ob_get_clean();
require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';


  if(!isLogIn()){
    redirect("../Login/login.php");
  }

// ob_start();

if(isset($_GET['edit'])){?>

<?php 
        
        // $menuQuery = $conn -> query("SELECT * FROM `menu`");
        // $menuResult = mysqli_fetch_assoc($menuQuery);
        $error = array();

        // if (isset($_GET['edit'])){
          $menuIDEdit = (int)$_GET['edit']; 
          $menuQuery = $conn -> query("SELECT * FROM `menu` WHERE id = $menuIDEdit ");
          $menuResult = mysqli_fetch_assoc($menuQuery);

          $name = (isset($_POST['name']))?$_POST['name']:$menuResult['name'];
          $desc= (isset($_POST['desc']))?$_POST['desc']:$menuResult['description'];
          $price= (isset($_POST['price']))?$_POST['price']:$menuResult['price'];
          $category= (isset($_POST['category']))?$_POST['category']:$menuResult['category'];
          $pictSrc = (isset($_POST['pict']))?$_POST['pict']:$menuResult['pictSrc'];
          // $flag = false;
          // echo $menuIDEdit;

          $pictBefore = ($pictSrc!="")?$pictSrc:"";
          $fullPath = $pictBefore;
          if($_POST){
            // $name = (isset($_POST['name']))?$_POST['name']:$menuResult['name'];
            // $desc= (isset($_POST['desc']))?$_POST['desc']:$menuResult['description'];
            // $price= (isset($_POST['price']))?$_POST['price']:$menuResult['price'];
            // $category= (isset($_POST['category']))?$_POST['category']:$menuResult['category'];
            // echo $name.$desc.$price.$category;
            
            $conn->query("UPDATE `menu` SET `category` = '$category',`name` = '$name', `price` = '$price', `description` = '$desc' WHERE `id` = '$menuIDEdit' ");
            $flag=true;

            // var_dump($_FILES['pict']);
            if(!empty($_FILES)){
              // var_dump($_FILES);
              $pict = $_FILES['pict']; 
              $pictName = $pict['name'];
              $pictNameArr = explode('.', $pictName);
              $fileName = $pictNameArr[0];
              $fileExt = $pictNameArr[1];
              $tmpLoc = $pict['tmp_name'];
              $fileSize = $pict['size'];
              $allowed = array('png', 'jpg', 'jpeg', 'gif');
              $destNameArr = explode(" ",$name);
              $destName = implode("-",$destNameArr);
              $uploadName = $destName.".".$fileExt;
              $uploadPath = $_SERVER['DOCUMENT_ROOT'].'/SSP Project/MenuPict/'.$uploadName;
              $fullPath = '../MenuPict/'.$uploadName;

              if(!in_array($fileExt, $allowed)){
                  $_SESSION['error_flash'] = "File not allowed, allowed file: png, jpg, jpeg, or gif";
              }else{
                  "";
              }
              
              if($fileSize > 10000000){
                  $_SESSION['error_flash'] = "The file size must be under 10MB";
              }else{
                  "";
              }
              // echo $fullPath;
          }
      
      
          if(!empty($_FILES)){
            move_uploaded_file($tmpLoc, $fullPath);
            // $conn->query("UPDATE `menu` SET `pictSrc` = '$fullPath' WHERE `id` = '$menuIDEdit' ");
            $conn->query("UPDATE `menu` SET `category` = '$category',`name` = '$name', `price` = '$price', `description` = '$desc' , `pictSrc` = '$fullPath' WHERE `id` = '$menuIDEdit' ");
            
          }
            
            // header('Location: menuList.php');
            $_SESSION['success_flash'] = "Changes has been made successfully";
          }
          
          
        // }
      ?>

<!-- EDIT PAGE -->

  <div class="modal-header">                        
    <h5 class="modal-title">Edit</h5>
      <a href="menuList.php" class="close">X</a>
      </div>
      
      <div class="modal-body">
        <?php 
          // if(!$flag){
          //   echo "<form method='post'>";
          // }else{
          //   echo "<form action = '../admin/menuList.php' method='post'>";
          // }
        ?>
        <form method='post' enctype="multipart/form-data">
            <?php
            if(isset($_SESSION['success_flash'])){
              echo "<div class='bg-success text-white text-center'><p>".$_SESSION['success_flash']."</p></div>";
              unset($_SESSION['success_flash']);
            }
            if(isset($_SESSION['error_flash'])){
              echo "<div class='bg-danger text-white text-center'><p>".$_SESSION['error_flash']."</p></div>";
              unset($_SESSION['error_flash']);
            }

            if(isset($_GET['delPict'])){
              $pictIDDel = (int)$_GET['edit'];
              $conn->query("UPDATE menu SET pictSrc='' WHERE id = $pictIDDel");
              // header("Location: menuList.php");
              
            }
            ?>
          
          <div class="form-group">
            <label for="name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value='<?=$menuResult['name'];?>'>
          </div>
          <div class="form-group">
            <label for="desc" class="col-form-label">Description:</label>
            <textarea class="form-control" id="desc" value='<?=$description?>' name='desc'><?=$desc?></textarea>
          </div>
          <div class="form-group">
            <label for="price" class="col-form-label">Price:</label>
            <input type="text" class="form-control" id="price" name="price" value='<?=$price?>'>
          </div>
          <div class="form-group">
            <label for="cat" class="col-form-label">Category:</label>
            <input type="text" class="form-control" id="cat" name="category" value='<?=$category?>'>
          </div>
          <!-- <div class="form-group">
            <label for="pic" class="col-form-label">Picture:</label>
            <?php if($pictBefore != ""): ?>
                <div class="text-center">
                  <img style = "height:300px;" src="<?= $pictBefore?>" alt="<?=$pictSrc?>">
                    <a href="menuList.php?delPict&edit=<?=$menuResult['id']?>" class="btn btn-danger ">Delete Image</a>
                </div>
            <?php else: ?>
              <input type="file" class="form-control" id="pic" name="pict" >
            <?php endif ?>
            
            
            
          </div> -->
          <div class="modal-footer">
            <!-- <a href="menuList.php" class="btn btn-secondary">Close</a> -->
            <!-- <a href="menuList.php?edit=" class="btn btn-primary btn-rounded btn-sm my-0" data-toggle="modal" data-target="#editPopUp">Save Changes</a> -->
            <input type="submit" class="btn btn-primary" value="Save Changes">
          </div>
        </form>
      </div>
      
      
    </div>
  </div>

<!-- END OF EDIT PAGE -->
<?php }else{?>

<?php 

if(isset($_GET['add'])){
  $menuIDAdd = (int)$_GET['add'];
  $conn->query("DELETE FROM menu WHERE id = $menuIDAdd");
  // header("Location: menuList.php");
}

?>

<form method='post'>
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Menu List</h3>
  <div class="card-body">
    <div class='col-md-12 text-right'>
      <?php
        if($userData['privilege'] == "all"):
      ?>
      <a href="menuAdd.php" class="btn btn-success btn-rounded btn-sm my-0" data-target="#editPopUp">Add</a>
      <?php endif?>
    </div>
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></div></a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Description</th>
            <th class="text-center">Price</th>
            <th class="text-center">Category</th>
            <?php 
              global $userData;
              if($userData['privilege'] == "all"):
            ?>
              <th class="text-center">Edit</th>
            <?php endif ?>
            <?php 
              global $userData;
              if($userData['privilege'] == "all"):
            ?>
              <th class="text-center">Remove</th>
            <?php endif ?>
          </tr>
        </thead>
        <tbody>
          
          <?php 

            if(isset($_GET['delete'])){
              $menuIDDel = (int)$_GET['delete'];
              $conn->query("DELETE FROM menu WHERE id = $menuIDDel");
              // header("Location: menuList.php");
            }
            
            $itemsQuery = $conn -> query("SELECT * FROM menu ORDER BY `name`");
            while($items = mysqli_fetch_assoc($itemsQuery)):
          ?>
          <tr>
            <td class="pt-3-half" name="name"><?=$items['name']?></td>
            <td class="pt-3-half" name="desc"><?=$items['description']?></td>
            <td class="pt-3-half" name="price">$<?=$items['price']?></td>
            <td class="pt-3-half" name="category"><?=$items['category']?></td>


            <!--
            EDITABLE CONTENT
             <td class="pt-3-half" contenteditable="true" name="name"><?=$items['name']?></td>
            <td class="pt-3-half" contenteditable="true" name="desc"><?=$items['description']?></td>
            <td class="pt-3-half" contenteditable="true" name="price">$<?=$items['price']?></td>
            <td class="pt-3-half" contenteditable="true" name="category"><?=$items['category']?></td> -->
            <!-- <td class="pt-3-half">
              <span class="table-up"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-up"
                    aria-hidden="true"></i></a></span>
              <span class="table-down"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-down"
                    aria-hidden="true"></i></a></span>
            </td> -->
            

            <?php
              if($userData['privilege'] == "all"):
            ?>
            <!-- <form method='post' action="menuList.php?<?= (isset($_GET['edit']))?"edit=".$items['id']:"" ?>"> -->
              <td>
                <a href="menuList.php?edit=<?=$items['id']?>" class="btn btn-primary btn-rounded btn-sm my-0" data-target="#editPopUp">Edit
                  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editPopUp">Edit</button> -->
                </a>
                
                
              </td>
              <!-- </form> -->
            <?php endif ?>
            <?php
              if($userData['privilege'] == "all"):
            ?>
              <td>
                <a href="menuList.php?delete=<?= $items['id'] ?>" class="btn btn-danger btn-rounded btn-sm my-0">Remove</a>
              </td>
            <?php endif ?>
          </tr>
          
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</form>

<?php }?>


<!-- <div class="card-deck mb-3" >
<?php 
  // if(isset($_GET['delete'])){
  //   $menuIDDel = (int)$_GET['delete'];
  //   $conn->query("DELETE FROM menu WHERE id = $menuIDDel");
  //   // header("Location: menuList.php");
  // }

  $counter = 0;
  $itemsQuery = $conn -> query("SELECT * FROM menu");
  while($items = mysqli_fetch_assoc($itemsQuery)):
?>
  <div class="card">
    <img class="card-img-top" src="<?=$items['pictSrc']?>" alt="<?=$items['pictSrc']?>">
    <div class="card-body">
      <h5 class="card-title" <?php if($userData['privilege']=='all'){ echo 'contenteditable="true"';}?>><?=$items['name']?></h5>
      <p class="card-text" <?php if($userData['privilege']=='all'){ echo 'contenteditable="true"';}?>><?=$items['description']?></p>
    </div>
    <div class="card-footer">
      <small class="text-muted" <?php if($userData['privilege']=='all'){ echo 'contenteditable="true"';}?>>
      Last updated 3 mins ago
      </small>
      <a href="menuList.php?delete=<?= $items['id'] ?>" class="btn btn-danger btn-rounded btn-sm my-0">Remove</a>
    </div>
  </div>
  <?php
    $counter++;
    if($counter%4==0){
      echo "</div>".'<div class="card-deck mb-3">';
    }
  ?>
  <?php endwhile; ?>
</div> -->

