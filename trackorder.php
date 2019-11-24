<?php
session_start();

include_once 'includes/dbconnection.php';
 ?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Track Order</title>
 <script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.19.0.min.js"></script>
    <link rel="stylesheet" href="css/map.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script></head>
<body>

<div style="margin-left:50px;">
<?php  

$orderid=intval($_GET['oid']);
$ret=mysqli_query($con,"select tbl_foodtracking.orderCancelled,tbl_foodtracking.remark,tbl_foodtracking.status as status,tbl_foodtracking.statusDate from tbl_foodtracking where tbl_foodtracking.orderId ='$orderid'");
$cnt=1;


 ?>
<table border="1"  cellpadding="10" style="border-collapse: collapse; border-spacing:0; width: 100%; text-align: center;">
  <tr align="center">
   <th colspan="4" >Food Tracking History of #<?php echo  $orderid;?></th> 
  </tr>
  <tr>
    <th>#</th>
    <th>Remark</th>
    <th>Status</th>
    <th>Time</th>
   </tr>
<?php  
while ($row=mysqli_fetch_array($ret)) { 
  $cancelledby=$row['orderCancelled'];
  ?>
<tr>
  <td><?php echo $cnt;?></td>
  <td><?php  echo $row['remark'];?></td> 
  <td><?php  echo $row['status']; 
if($cancelledby==1){
echo "("."by user".")";
} else {

echo "("."by Resturants".")";
}

  ?></td> 
   <td><?php  echo $row['statusDate'];?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>
     
     <p >
      <input name="Submit2" type="submit" class="txtbox4" value="Close" onClick="return f2();" style="cursor: pointer;"  />   <input name="Submit2" type="submit" class="txtbox4" value="Print" onClick="return f3();" style="cursor: pointer;"  /></p>
      <?php  
        $orderid=intval($_GET['oid']);
		$ret=mysqli_query($con,"select * from tbl_foodtracking where status='Order Confirmed' and orderId='$orderid'");
		$cnt=1;

		while ($row=mysqli_fetch_array($ret)) {
		?>
          <div id="map-canvas" style="height:350px;width:615px;border: 1px solid #056af7;"></div>
   
		<?php 
		$cnt=$cnt+1;
		}?>

</div>
 <script>
    window.lat = 5.3953;
    window.lng = 100.2898;

    var map;
    var mark;
    var lineCoords = [];
      
    var initialize = function() {
      map  = new google.maps.Map(document.getElementById('map-canvas'), {center:{lat:lat,lng:lng},zoom:12});
      mark = new google.maps.Marker({position:{lat:lat, lng:lng}, map:map});
    };

    window.initialize = initialize;

    var redraw = function(payload) {
      if(payload.message.lat){
      lat = payload.message.lat;
      lng = payload.message.lng;

      map.setCenter({lat:lat, lng:lng, alt:0});
      mark.setPosition({lat:lat, lng:lng, alt:0});
      
      lineCoords.push(new google.maps.LatLng(lat, lng));

      var lineCoordinatesPath = new google.maps.Polyline({
        path: lineCoords,
        geodesic: true,
        strokeColor: '#2E10FF'
      });
      
      lineCoordinatesPath.setMap(map);}
    };

    var pnChannel = "raspberrypi-tracker";

    var pubnub = new PubNub({
      publishKey:   'pub-c-60aa1325-9402-43eb-ad41-c65259ef6440',
      subscribeKey: 'sub-c-576f4860-0db0-11ea-a2de-b207d7d0b791'
    });
        
    document.querySelector('#action').addEventListener('click', function(){
        var text = document.getElementById("action").textContent;
        if(text == "Start Tracking"){
            pubnub.subscribe({channels: [pnChannel]});
            pubnub.addListener({message:redraw});
            document.getElementById("action").classList.add('btn-danger');
            document.getElementById("action").classList.remove('btn-success');
            document.getElementById("action").textContent = 'Stop Tracking';
        }
        else{
            pubnub.unsubscribe( {channels: [pnChannel] });
            document.getElementById("action").classList.remove('btn-danger');
            document.getElementById("action").classList.add('btn-success');
            document.getElementById("action").textContent = 'Start Tracking';
        }
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCwrmwJMbyGOUqq_iFPdP8y9jYKnoGrzyk&callback=initialize"></script>
</body>
</html>

     