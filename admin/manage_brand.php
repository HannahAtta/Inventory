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
            <th scope="col">Brand</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
            
            </tr>
            </thead>
        <tbody id="get_cat" class="table-group-divider">
            <?php
               include("conn.php");

               $stmt = $conn->prepare("SELECT * FROM brand LIMIT $start_from,$num_per_page");
               $stmt->execute();
               $rows = $stmt->fetchAll();
               $n = 0;
               foreach($rows as $row){?>
               <tr>
                <th scope="row"><?php echo $row['brand_id'] ?></th>
                <td><?php echo $row['brand_name'] ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td><a href="process.php?brand_id=<?php echo $row['brand_id'] ?>" class="btn btn-danger btn-sm deletuser confirm"><i class=''></i>Delete</a>
                    <a href="#" class="btn btn-info btn-sm">Edit</a>
                </td>
                </tr>

              <?php }
            ?>
            <tr>
            <td colspan = "5"> <?php
          $query = $conn->prepare("SELECT * FROM brand");
          $query->execute();
          $querys = $query->fetchAll();
          $count = $query->rowCount();
          
          $total_page = ceil($count/$num_per_page);

          if($page>1){

            echo "<a href='manage_brand.php?page=".($page-1)."' class='btn btn-default bton'> Pref </a>";

          }

          for($i=1; $i<$total_page; $i++){

            echo "<a href='manage_brand.php?page=".$i."' class='btn btn-default bton active'> $i </a>";

          }
          if($i>$page){

            echo "<a href='manage_brand.php?page=".($page+1)."' class='btn btn-default bton'> next </a>";

          }
        ?>
              </td>
            </tr>
          </tbody>
        </table> 
       </div>
      </div>
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