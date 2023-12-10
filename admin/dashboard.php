<?php
  session_start();
  if(!isset($_SESSION['row'])) header('location: login.php');
  $user = $_SESSION['row'];
  $pageTitle = 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/back.css">
    <title>Dashboard</title>
</head>
<body>
  <div class="container-{breakpoint}">
<div class="dashaPage">
            <?php include('sidebar.php') ?>
  <div class="content" id="content">
      <div class="contentNav">
             <a href="#" id="toggle"><i class="fa fa-navicon"></i></a>
             <a href="logout.php" id="logout"><i class="fa fa-power-off"></i>Logout</a>
      </div>
    <div class="contentBody">
      <div class="contentMain">
         <div class="container">
           <div class="row">
            <div class="col-md-4">
                  <div class="card ma-auto mt-5" style="height:90%">
                  <img class="card-img-top mx-auto" src="img/meeting.PNG" alt="card-img"  style="width: 60%;">
                  <div class="card-body">
                    <h4 class="card-title">Profile Info</h4>
                    <p class="card-text"><i class="fa fa-user">&nbsp;</i>Hannah</p>
                    <p class="card-text"><i class="fa fa-user">&nbsp;</i>Admin</p>
                    <p class="card-text">Last Login : <label for=""><?php echo date("y-m-d"); ?></label></p>
                    <a href="" class="btn btn-default btton"><i class="fa fa-edit">&nbsp;</i>Edit Profil</a>
                  </div>
              </div>   
            </div>
            <div class="col-md-8">
              <div class="jumbotron mt-5" style="width:100%; height:90%; background: #eee; padding:20px;">
                <h1>Welcom Admin,</h1>
                <p>Have a nice day</p>
                <div class="row">
                  <div class="col-sm-6">
                   <iframe src="http://free.timeanddate.com/clock/i616j2aa/n1993/szw160/szh160/cf100/hncelead6" frameborder="0" width="160" height="160"></iframe>
                  </div>
                  <div class="col-sm-6">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">New Orders</h4>
                        <p class="card-text">Here you can make invoices and create new orders</p>
                        <a href="new_order.php" class="btn btn-default bton">New Orders</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>  
          </div> 
       </div>
       <div class="container">
          <div class="row">
            <div class="col-lg-4">
               <div class="card mt-5">
                  <div class="card-body">
                        <h4 class="card-title">Catogories</h4>
                        <p class="card-text">Here you can add and manage catogories</p>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#form_category" class="btn btn-default bton"><i class="fa fa-plus"></i> Add</a>
                        <a href="manage_category.php" class="btn btn-default btton">manage</a>
                  </div>
                </div>
              </div>
            <div class="col-lg-4">
            <div class="card mt-5">
                  <div class="card-body">
                        <h4 class="card-title">Brands</h4>
                        <p class="card-text">Here you can add and manage Brands</p>
                        <a href="#"  data-bs-toggle="modal" data-bs-target="#form_brand" class="btn btn-default bton"><i class="fa fa-plus"></i> Add</a>
                        <a href="manage_brand.php" class="btn btn-default btton">manage</a>
                      </div>
                </div>
              </div>
            <div class="col-lg-4">
            <div class="card mt-5">
                  <div class="card-body">
                    <h4 class="card-title">Products</h4>
                    <p class="card-text">Here you can add and manage products</p>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#form_product"  class="btn btn-default bton"><i class="fa fa-plus"></i> Add</a>
                    <a href="manage_product.php" class="btn btn-default btton">manage</a>
                    <!-- <span></span> -->
                  </div>
                </div>
              </div>
             </div>
            </div>
          </div>
         </div> 
      </div>
    </div>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="form_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="" id="form-cat">
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Category Name</label>
            <input type="text"  id="cat-name" name="cat" class="form-control" aria-describedby="emailHelp" placeholder="Category Name"  autocomplete="off">
            <div id="emailHelp" class="form-text"></div>
            </div>
            <div id="cat-error"></div>
            <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Parent Category</label>
            <select class="form-control" name="parent_cat" id="parent_cat">
              <option value="0"><span>Select Category</span></option>
                <?php
                include("conn.php");
                $stmt = $conn->prepare("SELECT * FROM  category 	WHERE 
                parent_cat = 0");

                  $stmt->execute(array());
                  $rows = $stmt->fetchAll();
                  // $count = $stmt->rowCount();
                  // echo $count;
                  foreach($rows as $row) { ?>
                    <option value="<?php echo $row["cat_id"] ?>"><?php echo $row["cat_name"] ?></option>
                 <?php }
                ?>
            </select>
            </div>
            <?php
            //  var_dump($rows);
             ?>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="form_brand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brand</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="" id="brand_form">
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Brand Name</label>
            <input type="text"  id="brand_name" name="brand_name" class="form-control" aria-describedby="emailHelp" placeholder="Brand Name"  autocomplete="off">
            </div>
            <div id="brand_error" class="form-text text-muted"></div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="form_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form class="row g-3" id="product_form" onsubmit="return false">
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Date</label>
              <input type="text" class="form-control" id="added_date" name="added_date" value="<?php echo date("y-m-d"); ?>" readonly/>
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name" required>
            </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Category</label>
              <select class="form-select" name="select_cat" id="select_cat" required>
              <option value="0"><span>Select Category</span></option>
                    <?php
                    include("conn.php");
                    $stmt = $conn->prepare("SELECT * FROM  category 	WHERE 
                    parent_cat = 0");

                      $stmt->execute(array());
                      $rows = $stmt->fetchAll();
                      // $count = $stmt->rowCount();
                      // echo $count;
                      foreach($rows as $row) { ?>
                        <option value="<?php echo $row["cat_id"] ?>"><?php echo $row["cat_name"] ?></option>
                    <?php }
                    ?>
              </select>
            </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Brand</label>
              <select class="form-select" name="select_brand" id="select_brand" required>
                <option value="0">Select Brand</option>
                    <?php
                    include("conn.php");
                    $stmt = $conn->prepare("SELECT * FROM  brand ");

                      $stmt->execute(array());
                      $rows = $stmt->fetchAll();
                      // $count = $stmt->rowCount();
                      // echo $count;
                      foreach($rows as $row) { ?>
                        <option value="<?php echo $row["brand_id"] ?>"><?php echo $row["brand_name"] ?></option>
                    <?php }
                    ?>
              </select>
            </div>
            <div class="col-12">
              <label for="inputAddress2" class="form-label">Product Price</label>
              <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Price of Product">
            </div>
            <div class="col-12">
              <label for="inputCity" class="form-label">Quantity</label>
              <input type="text" class="form-control" id="product_qty" name="product_qty" placeholder="Enter Quantity">
            </div>
            <!-- <div class="col-md-4">
              <label for="inputState" class="form-label">State</label>
              <select id="inputState" class="form-select">
                <option selected>Choose...</option>
                <option>...</option>
              </select>
            </div> -->
            <!-- <div class="col-md-2">
              <label for="inputZip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="inputZip">
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                  Check me out
                </label>
              </div>
            </div> -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Add Product</button>
            </div>
          </form>
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
</div>

    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/back.js"></script>
    <script>
    var sidebarOpen = true;

      toggle.addEventListener('click', (e)=>{
        // alert('hi');
        e.preventDefault();

      if(sidebarOpen){
        sidebar.style.width = '10%';
        sidebar.style.transition = '0.3s all';
        content.style.width = '90%';
        logo.style.fontSize = '40px';
        logo.style.marginTop = '10px';

        menuIcon = document.getElementsByClassName('menuIcon');
        for(var i=0; i < menuIcon.length; i++){
          menuIcon[i].style.display = 'none';
        }
        sidebarOpen = false;
      }else{
        sidebar.style.width = '20%';
        content.style.width = '80%';
        logo.style.fontSize = '60px';

        menuIcon = document.getElementsByClassName('menuIcon');
        for(var i=0; i < menuIcon.length; i++){
          menuIcon[i].style.display = 'inline-block';
        }
        sidebarOpen = true;
      }
        
      });
    </script>  
  </body>
</html>