 <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
           
        </div>
 <p style="font-size: 20px;padding-top:1%" ><strong>FoodXpress</strong></p>
        
            <ul class="nav navbar-top-links navbar-right">
                                <?php
$ret1=mysqli_query($con,"select tbl_user.firstName,tbl_orderdetails.id,tbl_orderdetails.orderNumber from tbl_orderdetails join tbl_user on tbl_user.id=tbl_orderdetails.userId where tbl_orderdetails.orderFinalStatus is null");
$num=mysqli_num_rows($ret1);

?>   
                
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary"><?php echo $num;?></span>
                    </a>

                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html" class="dropdown-item">
                                <div>
                                 
                                    <?php if($num>0){
while($result=mysqli_fetch_array($ret1))
{
            ?>
            <a class="dropdown-item" href="viewfoodorder.php?orderid=<?php echo $result['orderNumber'];?>">   <i class="fa fa-envelope fa-fw"></i>  #<?php echo $result['orderNumber'];?> Order Received from <?php echo $result['firstName'];?></a>
<?php }} else {?>
    <a class="dropdown-item" href="view-allorderfood.php">No New Order Received</a>
        <?php } ?>
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>


                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                
            </ul>

        </nav>
        </div>