<?php
  $pageTitle = 'adduser';
  session_start();
  if(!isset($_SESSION['row'])) header('location: login.php');
  $user = $_SESSION['row'];
  $_SESSION['table'] = 'users';
  $users = include('showuser.php');

  // var_dump($rows);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/back.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="dashaPage">
        <?php   $pageTitle = 'adduser'; include('sidebar.php')?>
        <div class="content" id="content">
           <div class="contentNav">
             <a href="#" id="toggle"><i class="fa fa-navicon"></i></a>
             <a href="logout.php" id="logout"><i class="fa fa-power-off"></i> Logout</a>
           </div>
           <div class="contentBody">
             <div class="contentMain">
                <div class="container">
                    <div class="row">
                      <div class="col-lg-6">
                        <h5><i class="fa fa-plus"></i> Insert User</h5>
                        <form action="add.php" method="POST" class="appform mt-5">
                          <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" class="form-control" name="first_name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Name">
                            </div>
                            <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" type="email"  name="email" autocomplete="off" placeholder="Username" required />
                            </div>
                            <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control"  id="password" type="password" name="password" autocomplete="new-password"placeholder="Password" required />
                            </div>
                            <div>
                                <!-- <input type="hidden" name="table" value="users"> -->
                                <button type="submit" value="submit"class="btn float-right"><i class="fa fa-plus"></i> Add User</button>
                            </div>
                        </form>
                        <?php 
                          // if($_SESSION['response']){
                          //   $resmessage = $_SESSION['response']['message'];
                          //   $ressuss = $_SESSION['response']['success'];  
                        ?>
                        <div class="message">
                          <!-- <p class="<?= $ressuss ? 'message_success' : 'message_error' ?>"> -->
                             <?= $resmessage ?>
                          </p>
                        </div>
                        <?php unset($_SESSION['response']); 
                        // }
                         ?>
                      </div>
                      <div class="col-lg-6">
                        <h5><i class="fa fa-list"></i> List of Users</h5>
                        <div class="section">
                          <p><?php echo $count; ?> users </p>
                          <div class="users table-responsive">
                            <table class="text-center table table-bordered">
                              <tr>
                                <th>Full Name</th>
                                <!-- <th>Last Name</th> -->
                                <th>Email</th>
                                <!-- <th>Careated at</th> -->
                                <th>Action</th>
                                <!-- <th>updated at</th> -->
                              </tr>
                              <?php 
                              foreach($rows as $row){
                               echo "<tr>";
                               echo "<td class='firstName'>" . $row['full name'] . "</td>";
                              //  echo "<td class='lastName'>" . $row['last_name'] . "</td>";
                               echo "<td>" . $row['email'] . "</td>";
                              //  echo "<td>" .date('M d,y h:i:s', strtotime($row['created_at']))  . "</td>";
                               echo "<td>
                               <a href='' class='btn btn-success updateuser btn-sm'><i class=''></i>Edit</a>
                               <a href='' class='btn btn-danger deletuser btn-sm' data-userid=".$row['id']."
                               data-fname=".$row['full name']."><i class=''></i> Delete </a>";
                             echo "</td>";
                              //  echo "<td>" . $row['updated_at'] . "</td>";
                               echo "</tr>";
                              } ?>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
             </div>
           </div>
        </div>
    </div>
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/back.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script>
      function script(){
        
       this.initialize = function(){
        this.registerEvents();
       
      },
      
      this.registerEvents = function(){
          document.addEventListener('click', function(e){
               targetElment = e.target;
               classList =  targetElment.classList;


              if(classList.contains('deletuser')){
                  e.preventDefault();
                  userId =  targetElment.dataset.userid;
                  fname  =  targetElment.dataset.fname;
                  lname  =  targetElment.dataset.lname;

                  if(window.confirm('Are you sure to delete '+ fname +'?')){
                    $.ajax({
                      method: 'POST',
                      data: {
                         user_id: userId,
                         f_name: fname,
                         l_name: lname,
                      },
                      url: 'deleteuser.php',
                      dataType: 'json',
                      success: function(data){
                        if(data.success){
                          if(window.confirm(data.message)){
                            location.reload();
                          }
                        }else{
                          window.alert(data.message);
                        }
                      }
                    })
                  }else{
                    console.log('no');
                  }
             
            }
            if(classList.contains('updateuser')){
                   e.preventDefault();

                 firstName = targetElment.closest('tr').querySelector('td.firstName').innerHTML;
                 lastName  = targetElment.closest('tr').querySelector('td.lastName').innerHTML;
                  // email     = targetElment.closest('tr').querySelector('td.email').innerHTML;
                   
                BootstrapDialog({
                  title: 'Are you suer',
                 });
            }
          });
      }
    }
      var script = new script;
      script.initialize();

    </script>

</body>
</html>