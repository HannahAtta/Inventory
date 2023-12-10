<?php
ini_set('display_errors', 'On');
	session_start();
  if (isset($_SESSION['user'])) {
		header('Location: index.php');
	}
    // if(isset($_SESSION['user'])) header('location: dashbord.php');

	include 'conn.php';
    
	// Check If User Coming From HTTP Post Request

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$email = $_POST['email'];
		$password = $_POST['password'];

    // echo $email;
    // echo $password;

		// Check If The User Exist In Database

		$stmt = $conn->prepare("SELECT 
                      *
                    FROM 
                      user 
                    WHERE 
                      email = ? 
                    AND 
                      password = ?

                      LIMIT 1 ");

		$stmt->execute(array($email, $password));
		$row = $stmt->fetchAll()[0];
		$count = $stmt->rowCount();
		// If Count > 0 This Mean The Database Contain Record About This Username

		if ($count > 0) {
       $_SESSION['user'] = $email; 
          //  var_dump($_SESSION['user']);
          //   die;
      $_SESSION['row'] = $row;
          //  var_dump($_SESSION['row']);
          //  die;
		     // $_SESSION['username'] = $username; // Register Session Name
			header('Location: index.php'); // Redirect To Dashboard Page
		    exit();
		}
			// echo $count;        
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/front.css">
    <title>Document</title>
</head>
<body>
  <div class="overlay"><div class="loader"></div></div>
<div class="header ">
    <div class="container">
       <p></p>
        <!-- <a href="login.php"></a> -->
    </div>
 </div>   
  <div class="container login-page">
    <div class="card mx-auto mt-5" style="width: 30rem;">
       <div class="card-header">
          <h1 class="text-center">
            <span>Login
            </span>
          </h1>
        </div>
        <!-- <img class="card-img-top mx-auto" style="width: 100%;" src="img/meeting.PNG" alt="card img"> -->
        <div class="card-body">
          <form id="form" method="POST" action="login.php">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <div class="input-container">
            <input 
              class="form-control" 
              type="email" 
              name="email" 
              placeholder="Email" />
          </div>
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <div class="input-container mb-3">
            <input 
              minlength="4"
              class="form-control" 
              type="password" 
              name="password" 
              autocomplete="new-password"
              placeholder="Password" 
              required />
          </div>
            <!-- <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" aria-describedby="emailHelp"  autocomplete="off">
            <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" autocomplete="off">
            </div> -->
            <button type="submit" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Login</button>
            <span><a href="register.php">Register</a></span>
          </form>
        </div>
        <div class="card-footer"><a href="#">Forget Password?</a></div>
    </div>
  </div>  
  
  <script src="js/jquery-1.12.1.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/front.js"></script>
</body>
</html>