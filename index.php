<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
$foodid=$_POST['foodid'];
$userid= $_SESSION['fdsuserid'];
$query=mysqli_query($con,"insert into tbl_orders(userId,foodId) values('$userid','$foodid') ");
if($query)
{
 echo "<script>alert('Food has been added in to the cart');</script>";   
} else {
 echo "<script>alert('Something went wrong.');</script>";      
}
}


  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>FoodXpress</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
	
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>

<body class="home">
    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <?php include_once('includes/header.php');?>
            <!-- /.navbar -->
        </header>
        <!-- banner part starts -->
        <section class="hero bg-image" data-image-src="images/food2.jpg">
            <div class="hero-inner">
                <div class="container text-center hero-text font-white">
                    <h1>Your favourite food delivered hot and fresh</h1>
                    <!--<h5 class="font-white space-xs">Your favourite food delivered hot and fresh</h5>-->
                    <div class="banner-form">
                        <form class="form-inline" method="post" name="search" action="search-food.php">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount"></label>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="exampleInputAmount"  name="searchdata" id="searchdata" placeholder="eg: Italian, Burger, Sushi...."> </div>
                            </div>
                            <button onclick="location.href='search-food.php'" type="submit" name="search" class="btn theme-btn btn-lg">Search</button>
                        </form>
                    </div>
                    <!--<div class="steps">
                        <div class="step-item">
						<h4><span>1. </span>Choose Location</h4> 
					    </div>
                        <div class="step-item">
                            <h4><span>2. </span>Order Food</h4>
						</div>
						<div class="step-item">
                            <h4><span>3. </span>Delivery</h4> 
						</div>
                    </div>-->
                    <!-- end:Steps -->
                </div>
            </div>
            <!--end:Hero inner -->
        </section>
        <!-- banner part ends -->
        <!-- location match part starts -->
        <div class="location-match text-xs-center">
            <div class="container"> <span>Popular Delicious Foods Here: <span class="primary-color">All over Penang</span> </span>
            </div>
        </div>
        <!-- location match part ends -->
        <!-- Popular block starts -->
        <section class="popular">
            <div class="container">
                <div class="title text-xs-center m-b-30">
                    <h2>Penang's food culture that will delight your taste buds!</h2>
                    <p class="lead">Enjoy delicious food in Penang from best restaurants</p>
                </div>


                <div class="row">
                    <!-- Each popular food item starts -->
                    <?php

                    
$ret=mysqli_query($con,"select * from tbl_food order by rand() limit 9");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                    <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                        <div class="food-item-wrap">
                            <div class="figure-wrap bg-image"><img src="admin/itemimages/<?php echo $row['image'];?>" width="400" height="180">
                                
                                
                            </div>
                            <div class="content">
							    <h5 style="font-weight:600">From Restaurant: <?php echo $row['restName'];?></h5>
                                <h5><a href="food-detail.php?fid=<?php echo $row['id'];?>"><?php echo $row['itemName'];?></a></h5>
                                <div class="product-name"><?php echo substr($row['itemDesc'],0,40);?></div>
                                <div class="price-btn-block"> <span class="price">RM <?php echo $row['itemPrice'];?></span>


<?php if($_SESSION['fdsuserid']==""){?>
<a href="login.php" class="btn theme-btn-dash pull-right">Order Now</a>
<?php } else {?>
    <form method="post"> 
    <input type="hidden" name="foodid" value="<?php echo $row['id'];?>">   
<button type="submit" name="submit" class="btn theme-btn-dash pull-right">Order Now</button>
  </form> 
<?php }?> </div>
                            </div>
                            
                        </div>
                    </div>
                      <?php } ?>
                    <!-- Each popular food item starts -->
                    <!-- Each popular food item starts -->
                    
                </div>
            </div>
        </section>
        <!-- Popular block ends -->
        <!-- How it works block starts -->
        <section class="how-it-works">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <p class="pay-info">Pay by Cash on delivery</p>
                    </div>
                </div>
            <!--</div>-->
        </section>
        <!-- How it works block ends -->
        <!-- Featured restaurants starts -->
        
        <!-- Featured restaurants ends -->
        
        <!-- start: FOOTER -->
        <?php include_once('includes/footer.php');?>
        <!-- end:Footer -->
    </div>
    <!--/end:Site wrapper -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>