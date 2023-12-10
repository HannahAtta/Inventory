<?php
    session_start();
    include("conn.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$formErrors = array();

    $fname    	= $_POST['firstname'];
    $lname	    = $_POST['lastname'];
    $password 	= $_POST['password'];
    $email		= $_POST['email'];

    if (isset($fname)) {

        $filterdUser = filter_var($fname, FILTER_SANITIZE_STRING); //filtter variable Show for string only

        if (strlen($filterdUser) < 4) {

            $formErrors[] = 'fname Must Be Larger Than 4 Characters';

        }

    }
    
    if (isset($lname)) {

        $filterdUser = filter_var($lname, FILTER_SANITIZE_STRING); //filtter variable Show for string only

        if (strlen($filterdUser) < 4) {

            $formErrors[] = 'lastname Must Be Larger Than 4 Characters';

        }

    }

    // if (isset($password) && isset($password2)) {

    //     if (empty($password)) {

    //         $formErrors[] = 'Sorry Password Cant Be Empty';

    //     }

    //     if (sha1($password) !== sha1($password2)) {

    //         $formErrors[] = 'Sorry Password Is Not Match';

    //     }

    // }

    if (isset($email)) {

        $filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true) {

            $formErrors[] = 'This Email Is Not Valid';

        }

    }

    // Check If There's No Error Proceed The User Add

    if (empty($formErrors)) {

        $stm = $conn->prepare("SELECT 
									email
								FROM 
									users 
								WHERE 
									email = ? 
                                    ");

		$stm->execute(array($email));
		$row = $stm->fetchAll();
		$count = $stm->rowCount();

        if ($count > 0) {
         
            $formErrors[] = 'Sorry This User Is Exists';

        }else{

            $stmt = $conn->prepare("INSERT INTO 
                                    users(first_name, last_name , password,  email, created_at,updated_at)
                                VALUES(:fuser, :luser, :zpass, :zmail, now(), now())");
            $stmt->execute(array(

                'fuser' => $fname,
                'luser' => $lname,
                'zpass' => sha1($password),
                'zmail' => $email

            ));

            // Echo Success Message
            // header('Location: login.php');
            $succesMsg = 'Congrats You Are Now Registerd User';

        }

    }
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
    <link rel="stylesheet" href="css/front.css">
    <title>Register</title>
</head>
<body>
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
		<span>Register</span>
	</h1>
</div>
  <div class="card-body">    
	<!-- Start Signup Form -->
	<form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<div class="input-container">
			<input 
				pattern=".{4,}"
				title="firstname Must Be Between 4 Chars"
				class="form-control" 
				type="text" 
				name="firstname" 
				autocomplete="off"
				placeholder="First Name" 
				required />
		</div>
        <div class="input-container">
			<input 
				pattern=".{4,}"
				title="lastname Must Be Between 4 Chars"
				class="form-control" 
				type="text" 
				name="lastname" 
				autocomplete="off"
				placeholder="Last Name" 
				required />
		</div>
		<div class="input-container">
			<input 
				minlength="4"
				class="form-control" 
				type="password" 
				name="password" 
				autocomplete="new-password"
				placeholder="Password" 
				required />
		</div>
		<div class="input-container">
			<input 
				class="form-control" 
				type="email" 
				name="email" 
				placeholder="Email" />
		</div>
		<input class="btn btn-defult btn-block" name="register" type="submit" value="Register" />
	</form>
    <div class="the-errors text-center" >
		<?php 

			if (!empty($formErrors)) {

				foreach ($formErrors as $error) {

					echo '<div class="msg error">' . $error . '</div>';

				}

			}

			if (isset($succesMsg)) {

				echo '<div class="msg success">' . $succesMsg . '</div>';

			}
		

		?>
	</div>
    </div>
    </div>
  </div>
 </body>
</html>