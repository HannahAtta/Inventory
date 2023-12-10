<?php
	session_start();

    // if(isset($_SESSION['user'])) header('location: dashbord.php');

	include 'conn.php';
    
	// Check If User Coming From HTTP Post Request

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$username = $_POST['username'];
		$password = $_POST['password'];
        $passhash =

		// Check If The User Exist In Database

		$stmt = $conn->prepare("SELECT 
									*
								FROM 
									user 
								WHERE 
									email = ? 
								AND 
									password = ?
                                AND
                                    groupId = 1    
                                    LIMIT 1 ");

		$stmt->execute(array($username, $password));
		$row = $stmt->fetchAll()[0];
		$count = $stmt->rowCount();
		// If Count > 0 This Mean The Database Contain Record About This Username

		if ($count > 0) {
            $_SESSION['row'] = $row;
            // var_dump($_SESSION['row']);
            // die;
		    // $_SESSION['username'] = $username; // Register Session Name
			header('Location: dashboard.php'); // Redirect To Dashboard Page
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
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/back.css">
    <title>Login</title>
</head>
<body id="login">
    <div class="container text-center">
          <div class="loginHeader">
            <h1 class="mt-5">IMS</h1>
            <p>Inventory Management System</p>
          </div>
        <div class="loginBody">
            <form class="login mt-5" action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="POST">
                <div class="input-container">
                    <label for="">Username</label>
                    <input 
                        class="form-control" 
                        type="text" 
                        name="username" 
                        autocomplete="off"
                        placeholder="Username" 
                        required />
                </div>
                <div class="input-container">
                    <label for="">Password</label>
                    <input 
                        class="form-control" 
                        type="password" 
                        name="password" 
                        autocomplete="new-password"
                        placeholder="Password" 
                        required />
                </div>
                <input class="btn btn-block  col-12 mx-auto d-grid gap-2" name="login" type="submit" value="Login" />
            </form>
        </div>
     </div>    
</body>
</html>