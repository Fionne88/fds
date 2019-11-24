<?php
session_start();
error_reporting(0);
include_once('includes/dbconnection.php');
if (strlen($_SESSION['fdsuserid']==0)) {
  header('location:logout.php');
  } else{ 
//placing order

if(isset($_POST['placeorder'])){
//getting address
$fnaobno=$_POST['flatbldgnumber'];
$street=$_POST['streename'];
$area=$_POST['area'];
$city=$_POST['city'];
$userid=$_SESSION['fdsuserid'];
//genrating order number
$orderno= mt_rand(100000000, 999999999);
$query="update tbl_orders set orderNumber='$orderno',isOrderPlaced='1' where userId='$userid' and isOrderPlaced is null;";
$query.="insert into tbl_orderdetails(userId,orderNumber,buildingNo,streetName,area, city) values('$userid','$orderno','$fnaobno','$street','$area','$city');";

$result = mysqli_multi_query($con, $query);
if ($result) {

echo '<script>alert("Your order placed successfully. Order number is "+"'.$orderno.'")</script>';
echo "<script>window.location.href='my-order.php'</script>";

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
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>

<body>
    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
          <?php include_once('includes/header.php');?>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <!-- top Links -->
            <div class="top-links">
                
            </div>
            <!-- end:Top links -->
            <!-- start: Inner page hero -->

            <!-- end:Inner page hero -->
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                        <div class="sidebar clearfix m-b-20">
                            <div class="main-block">
                                <div class="sidebar-title white-txt">
                                    <h6>Food Categories</h6> <i class="fa fa-cutlery pull-right"></i> </div>
                                    <?php
      
      $query=mysqli_query($con,"select * from  tbl_category");
              while($row=mysqli_fetch_array($query))
              {
              ?>    
              
                               <ul>
                                            
                                            <li>
                                                <label class="custom-control custom-checkbox">
                                                    <span class="custom-control-description"><a href="viewfood-categorywise.php?catid=<?php echo $row['categoryName'];?>"><?php echo $row['categoryName'];?></a></span> </label>
                                            </li>
                                    
                                        
                                        </ul>
                                        <?php } ?>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end:Sidebar nav -->
                            
                        </div>
                        <!-- end:Left Sidebar -->
                        
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                        <div class="menu-widget m-b-30">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                              Your Order of Delicious hot food! <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular" aria-expanded="true">
                              <i class="fa fa-angle-right pull-right"></i>
                              <i class="fa fa-angle-down pull-right"></i>
                              </a>
                           </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in" id="1">
                                <div class="food-item white">

<?php 
$userid= $_SESSION['fdsuserid'];
$query=mysqli_query($con,"select tbl_food.image,tbl_food.itemName,tbl_food.itemDesc,tbl_food.itemPrice,tbl_food.itemQty,tbl_orders.foodId from tbl_orders join tbl_food on tbl_food.id=tbl_orders.foodId where tbl_orders.userId='$userid' and tbl_orders.isOrderPlaced is null");
$num=mysqli_num_rows($query);
if($num>0){
while ($row=mysqli_fetch_array($query)) {
 

?>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#"><img src="admin/itemimages/<?php echo $row['image']?>" width="100" height="80" alt="<?php echo $row['itemName']?>"></a>
                                            </div>
                                            <!-- end:Logo -->
                                            <div class="rest-descr">
<h6><a href="food-detail.php?fid=<?php echo $_SESSION['fid']=$row['foodId'];?>"><?php echo $row['itemName']?>  </a></h6>
                                                <p> <?php echo $row['itemDesc']?></p>
                                            </div>
                                            <!-- end:Description -->
                                        </div>
                                        <!-- end:col -->
                                        <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info"> <span class="price pull-left">RM <?php echo $total=$row['itemPrice']?></span></div>
                                    </div>
                                    <!-- end:row -->

                                <?php 
$grandtotal+=$total;
                            } 

} else {

    echo "You cart is empty.";
}
                            ?>
                                </div>
                          
                            </div>
                            <!-- end:Collapse -->
                        </div>
                        <!-- end:Widget menu -->
                      
                        <!--/row -->
                    </div>
                    <!-- end:Bar -->
                    <?php if($num>0){?>
                        <form method="post">
                    <div class="col-xs-12 col-md-12 col-lg-3">
                        <div class="sidebar-wrap">
                            <div class="widget widget-cart">
                                <div class="widget-heading">
                                    <h3 class="widget-title text-dark">
                                 Your Shopping Cart
                              </h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-row bg-white">
                                    <div class="widget-body">
                                 
                                        <div class="form-group row no-gutter">
                                            <div class="col-lg-12">
<input type="text" name="flatbldgnumber"  placeholder="Flat or Building Number" class="form-control" required="true">
<input type="text" name="streename" placeholder="Street Name" class="form-control" required="true">       
<input type="text" name="area"  placeholder="Area" class="form-control" required="true">
<input type="text" name="city" placeholder="City" class="form-control">                 
                                          
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            
                          
                                <div class="widget-body">
                                    <div class="price-wrap text-xs-center">
                                        <p>TOTAL</p>
                                        <h3 class="value"><strong><?php echo $grandtotal;?></strong></h3>
                                        <button  type="submit" name="placeorder" class="btn theme-btn btn-lg">Place order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:Right Sidebar -->
                </div>
            </form>
            <?php } ?>
                <!-- end:row -->
            </div>
            <!-- end:Container -->
          
            <!-- start: FOOTER -->
        <?php include('includes/footer.php');?>
            <!-- end:Footer -->
        </div>
        <!-- end:page wrapper -->
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
<?php } ?>