

<form method='post'>
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Menu List</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
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
          
            $itemsQuery = $conn -> query("SELECT * FROM menu");
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
                <a href="menuList.php?edit=<?=$items['id']?>" class="btn btn-primary btn-rounded btn-sm my-0" data-target="#editPopUp" data-toggle='modal'>Edit
                  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editPopUp">Edit</button> -->
                </a>
                <div class="modal fade" id="editPopUp" tabindex="-1" role="dialog" aria-labelledby="modalLabel" >
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">                        
                        <h5 class="modal-title">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        
                      </div>
                      <?php 
                        require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';

                        $menuQuery = $conn -> query("SELECT * FROM `menu`");
                        $menuResult = mysqli_fetch_assoc($menuQuery);

                        // $name = (isset($_POST['name']))?$_POST['name']:"";
                        // $desc= (isset($_POST['desc']))?$_POST['desc']:"";
                        // $price= (isset($_POST['price']))?$_POST['price']:"";
                        // $category= (isset($_POST['category']))?$_POST['category']:"";
                        // echo "hihihi";
                        if (isset($_GET['edit'])){
                          $menuIDEdit = (int)$_GET['edit']; 
                          $menuQuery = $conn -> query("SELECT * FROM menu WHERE id = '$menuIDEdit' ");
                          $menuResult = mysqli_fetch_assoc($menuQuery);

                          $name = (isset($_POST['name']))?$_POST['name']:$menuResult['name'];
                          $desc= (isset($_POST['desc']))?$_POST['desc']:$menuResult['description'];
                          $price= (isset($_POST['price']))?$_POST['price']:$menuResult['price'];
                          $category= (isset($_POST['category']))?$_POST['category']:$menuResult['category'];
                          // echo $menuIDEdit;
                          // echo $name.$desc.$price.$category;
                          // $conn->query("UPDATE `menu` SET `category` = '$category',`name` = '$name', `price` = '$price', `description` = '$desc' WHERE `id` = '$menuIDEdit' ");
                          // header('Location: ../../admin/menuList.php');
                        }
                      ?>
                      <div class="modal-body">
                        <form method='post'>
                          <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value='<?=$name;?>'>
                          </div>
                          <div class="form-group">
                            <label for="desc" class="col-form-label">Description:</label>
                            <textarea class="form-control" id="desc" value='<?=$description?>'><?=$description?></textarea>
                          </div>
                          <div class="form-group">
                            <label for="price" class="col-form-label">Price:</label>
                            <input type="text" class="form-control" id="price" name="price" value='<?=$price?>'>
                          </div>
                          <div class="form-group">
                            <label for="cat" class="col-form-label">Category:</label>
                            <input type="text" class="form-control" id="cat" name="category" value='<?=$category?>'>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <a href="menuList.php?edit=<?= $items['id'] ?>" class="btn btn-primary btn-rounded btn-sm my-0" data-toggle="modal" data-target="#editPopUp">Save Changes</a> -->
                        <button type="button" class="btn btn-primary">Save Changes</button>
                      </div>
                      
                    </div>
                  </div>
                </div>
                
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


<div class="card-deck mb-3" >
<?php 
  if(isset($_GET['delete'])){
    $menuIDDel = (int)$_GET['delete'];
    $conn->query("DELETE FROM menu WHERE id = $menuIDDel");
    // header("Location: menuList.php");
  }

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
</div>

