<?php
function setActive($name){
  global $pageTitle;
  if (isset($pageTitle) && $pageTitle == $name){
    echo"class = 'active'" ;
  }
}

?>
<div class="sidebar" id="sidebar">
            <h3 class="logo" id="logo">IMS</h3>  
            <div class="sidebarUser">
              <img src="img/activity-01.png" alt="">
              <span><?php echo $user["full name"] ?></span>
            </div>
            <div class="sidebarMenu">
               <ul class="menuList">
                  <li <?php setActive('dashboard') ?> >
                      <a href="dashboard.php"><i class="fa fa-dashboard Icon"></i><span class="menuIcon">Dashbord</span></a>
                  </li>
                  <li  <?php setActive('adduser') ?> >
                      <a href="adduser.php"><i class="fa fa-user-plus Icon"></i><span class="menuIcon">Add User</span></a>
                  </li>
                  <!-- <li>
                    <a href="#"><i class="fa fa-dollar Icon"></i><span class="menuIcon">Revenue Management</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-book Icon"></i><span class="menuIcon">Accounts Recenable</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-gears Icon"></i><span class="menuIcon">Configuration</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-line-chart Icon"></i><span class="menuIcon">Configuration</span></a>
                </li> -->
               </ul>
            </div>
          </div>