<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/front.css">
    <title>Document</title>
</head>
<body>
 <div class="header sticky-top">
    <div class="container">
    <?php 
    ini_set('display_errors', 'On');
         session_start();
        
        //  echo $users["first_name"] ;
        //  var_dump($users);
        //  die;

        if (isset($_SESSION['user'])) {
            $users = $_SESSION['row'];
            
            ?>
            <!-- <img class="my-image img-thumbnail img-circle" src="img.png" alt="" /> -->
				<div class="btn-group my-info">
                <span style="color:#fff;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<?php echo $users["full name"] ?>
						<!-- <span class="caret"></span> -->
					</span>
					<ul class="dropdown-menu">
						<li><a href="profile.php">My Profile</a></li>
						<li><a href="newad.php">New Item</a></li>
						<li><a href="profile.php">My Items</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>

				<?php

				} else {
			?>
        <a href="login.php">Login</a>
        <?php } ?>
    </div>
 </div>
    <div class="banner">
            <div class="homepage">
             <div>
                <h1>IMG</h1>
                <P>INVENTORY MANAGEMENT SYSTEM</P>
             </div> 
              <p class="tagLine">Track your goods throughout your entire supply chain, form purchasing to production to end sales</p> 
              <div class="bunnerIcon">
                    <ul>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-apple"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-android"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-windows"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    <!-- <div class="homepag"> -->
        <div class="container homeFeatuers mt-5">
            <div class="row  text-center ">
                <div class="col-lg-4 homeFeatuer">
                    <span class="featureIcon"><i class="fa fa-gear"></i></span>
                    <h3>Editable Theme</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptate, perspiciatis!</p>
                </div>
                <div class="col-lg-4 homeFeatuer">
                    <span class="featureIcon"><i class="fa fa-star"></i></span>
                    <h3>Flat Design</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequatur, doloremque.</p>
                </div>
                <div class="col-lg-4 homeFeatuer">
                    <span class="featureIcon"><i class="fa fa-globe"></i></span>
                    <h3>Reach Your Audience</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, ab!</p>
                </div>
            </div>
        </div>
      <div class="homeNotified mt-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 emailForm">
                <h3>Get Notified Of Any Udates</h3>
                <p>Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatibus, modi natus eligendi praesentium sint ad? Vero velit eius pariatur exercitationem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur alias quas vel accusamus harum voluptatum iure maiores voluptate?</p>
                <form action="">
                   <div class="form"> 
                    <input type="text" placeholder="Email Address">
                    <button>Notify</button>
                   </div> 
                </form>
              </div>
              <div class="col-lg-6">
                <img src="img/news.png" alt="">
              </div>
            </div>
          </div> 
        </div> 
    <div class="container social text-center">
        <div class="row">
            <div class="col-lg-12">
                <h3>Say Hi & Get in Touch</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt, soluta.</p>
                <div class="col socialIcon">
                    <ul>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-google-plus"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
   <div class="footer text-center">
     <div class="row">
        <div class="col">
            <ul>
                <li class="list-inline-item"><a href="#"><span>Content</span></a></li>
                <li class="list-inline-item"><a href="#"><span>Download</span></a></li>
                <li class="list-inline-item"><a href="#"><span>Press</span></a></li>
                <li class="list-inline-item"><a href="#"><span>Email</span></a></li>
                <li class="list-inline-item"><a href="#"><span>Support</span></a></li>
                <li class="list-inline-item"><a href="#"><span>Privacy Police</span></a></li>
            </ul>
        </div>
     </div>
   </div> 
    <script src="js/jquery-1.12.1.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/front.js"></script>
</body>
</html>