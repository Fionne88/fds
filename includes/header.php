<nav class="navbar navbar-dark">
               <div class="container">
                  <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                  <a class="navbar-brand" href="index.php"> FoodXpress </a>
                  <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                     <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                     
                        <li class="nav-item"> <a class="nav-link" href="food_results.php?pageno=1">Food Menu</a> </li>


  <?php if (strlen($_SESSION['fdsuserid']==0)) {?>                      
<!--<li class="nav-item"> <a class="nav-link" href="registration.php">Sign up</a> </li>
<li class="nav-item"> <a class="nav-link" href="login.php">Sign in</a></li>-->
<li class="nav-item"> <a class="nav-link" href="track-order-on.php">Track Order</a> </li> 
<!--<li class="nav-item"><a class="dropdown-item" href="login.php">Login</a></li>-->
<?php } ?>

 <?php if (strlen($_SESSION['fdsuserid']>0)) {?>
                            <li class="nav-item"><a class="nav-link" href="my-order.php" style="color: red"><strong> My Orders</strong> </a> </li>
                        <li class="nav-item"><a class="nav-link" href="cart.php" style="color: red"><strong> Cart</strong> </a> </li>
                        <?php } ?>



                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">My Account</a>
                           <div class="dropdown-menu">
                              <a class="dropdown-item" href="changepassword.php">Setting</a> <a class="dropdown-item" href="profile.php">Profile</a>  
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="logout.php">Logout</a>
                           </div>
                                                
                        </li>

                       
                     </ul>
                  </div>
               </div>
            </nav>