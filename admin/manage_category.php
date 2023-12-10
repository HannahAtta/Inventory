<?php
$pageTitle = 'dashboard';
  session_start();
  if(!isset($_SESSION['row'])) header('location: login.php');
  $user = $_SESSION['row'];

  include("conn.php");

 if(isset($_GET['page'])){

   $page = $_GET['page'];


 }else{

  $page = 1;

 }
  $num_per_page = 05;

  $start_from = ($page-1)*05;

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
            <div class="offset-1 col-9">
    <table class="table table-hover table-bordered">
            <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col">Parent</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
            
            </tr>
            </thead>
        <tbody id="get_cat" class="table-group-divider">
            <?php
               include("conn.php");

               $stmt = $conn->prepare("SELECT p.cat_id as id, p.cat_name as category, c.cat_name as parent, p.c_status FROM category p 
               LEFT JOIN category c ON p.parent_cat=c.cat_id LIMIT $start_from,$num_per_page");
               $stmt->execute();
               $rows = $stmt->fetchAll();
               $n = 0;
               foreach($rows as $row){?>
               <tr>
                <th scope="row"><?php echo $row['id'] ?></th>
                <td><?php echo $row['category'] ?></td>
                <td><?php echo $row['parent'] ?></td>
                <td>
                <?php if($row['c_status'] == 0) { 
                echo '<a href="process.php?approve= ' .$row['id']. '" class="btn btn-success btn-sm">Active</a>';
                 } 
									echo "</td>";
                  ?>
                <td><a href="process.php?cat_id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm confirm">Delete</a>
                    <a href="#edit_category" eid="<?php echo $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#edit_category"  class="btn btn-info btn-sm edit_cat">Edit</a>
                </td>
                </tr>

              <?php }
            ?>
            <tr>
            <td colspan = "5"> <?php
          $query = $conn->prepare("SELECT p.cat_id as id, p.cat_name as category, c.cat_name as parent, p.c_status FROM category p 
          LEFT JOIN category c ON p.parent_cat=c.cat_id ");
          $query->execute();
          $querys = $query->fetchAll();
          $count = $query->rowCount();
          
          $total_page = ceil($count/$num_per_page);

          if($page>1){
            echo "<a href='manage_category.php?page=".($page-1)."' class='btn btn-default bton'>Pref</a>";
          }

          for($i=1; $i<$total_page; $i++){
            echo "<a href='manage_category.php?page=".$i."' class='btn btn-default bton active'> $i </a>";
          }
          if($i>$page){
            echo "<a href='manage_category.php?page=".($page+1)."' class='btn btn-default bton'> next</a>";
          }
        ?></td>
            </tr>
            <!-- <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td><a href="#" class="btn btn-danger btn-sm">Delete</a>
                    <a href="#" class="btn btn-info btn-sm">Edit</a>
                </td>
                </tr> -->
        </tbody>

        </table> 
        </div>
        </div>
    </div>  

        </div>
    </div>
   </div>
 </div>
 <?php
 
  
  ?>
 <div class="modal fade" id="edit_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="" id="update_categoary_form" onsubmit="return false">
      <input type="hidden" name="cid" id="cid" value="">
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Category Name</label>
              <input type="text"  id="category_name" name="cat" class="form-control" aria-describedby="emailHelp" 
              value="">
          </div> 
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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