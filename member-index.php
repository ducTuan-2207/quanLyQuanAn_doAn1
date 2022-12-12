<?php
	require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');
//Connect to mysqli server
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
	if(!$conn) {
		die('Failed to connect to server: ' . mysqli_error());
	}
	
	//Select database
	
//get member id from session
$memberId=$_SESSION['SESS_MEMBER_ID'];

//selecting all records from the orders_details table. Return an error if there are no records in the table
$result=mysqli_query($conn,"SELECT * FROM orders_details o inner join cart_details c on c.cart_id = o.cart_id inner join quantities q on q.quantity_id = c.quantity_id WHERE o.member_id='$memberId' ")
or die("There are no records to display ... \n" . mysqli_error()); 
?>
<?php
    //retrieving all rows from the cart_details table based on flag=0
    $flag_0 = 0;
    $items=mysqli_query($conn,"SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
    or die("Something is wrong ... \n" . mysqli_error()); 
    //get the number of rows
    $num_items = mysqli_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
    $messages=mysqli_query($conn,"SELECT * FROM messages")
    or die("Something is wrong ... \n" . mysqli_error()); 
    //get the number of rows
    $num_messages = mysqli_num_rows($messages);
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysqli_query($conn,"SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo APP_NAME; ?>:Member Home</title>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <li><a href="member-index.php">Trang chủ</a></li>
  <li><a href="foodzone.php">Khu ẩm thực</a></li>
  <li><a href="specialdeals.php">Ưu đãi đặc biệt</a></li>
  <li><a href="member-index.php">Tài khoản của tôi</a></li>
  <li><a href="contactus.php">Liên hệ</a></li>
  </ul>
  </div>
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  <div id="company_name"><?php echo APP_NAME; ?> Restaurant</div>
</div>
<div id="center">
<h1>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?></h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<a href="member-profile.php">Hồ sơ của tôi</a> | <a href="cart.php">Giỏ hàng[<?php echo $num_items;?>]</a> |  <a href="inbox.php">hộp thư[<?php echo $num_messages;?>]</a> | <a href="tables.php">Đặt bàn</a> | <a href="partyhalls.php">Phòng tiệc</a> | <a href="ratings.php">Đánh giá</a> | <a href="logout.php">Đăng xuất</a>
<p>&nbsp;</p>
<p>Tại đây bạn có thể xem lịch sử đặt hàng và xóa các đơn đặt hàng cũ khỏi tài khoản của mình. Hóa đơn có thể được xem từ lịch sử đặt hàng. Bạn cũng có thể đặt bàn trong tài khoản của mình. Để biết thêm thông tin <a href="contactus.php">bấm vào đây</a> để liên hệ với chúng tôi.
<h3><a href="foodzone.php">Đặt thêm đồ ăn!</a></h3>
<hr>
<table border="0" width="910" style="text-align:center;">
<CAPTION><h2>Lịch sử đơn hàng</h2></CAPTION>
<tr>
<th>ID đơn hàng</th>
<th>Ảnh món ăn</th>
<th>Tên món ăn</th>
<th>Danh mục thực phẩm</th>
<th>Giá</th>
<th>Số lượng</th>
<th>Tổng chi phí</th>
<th>Ngày giao hàng</th>
<th>hành động</th>
</tr>

<?php
//loop through all table rows
$symbol=mysqli_fetch_assoc($currencies); //gets active currency
while ($row=mysqli_fetch_array($result)){
  $lt = $row['lt'];
  if($lt =='food'){
    $qry = "SELECT * FROM food_details f inner join categories c on c.category_id = f.food_category where food_id = {$row['food_id']}";
  }else{
    $qry = "SELECT * FROM specials where special_id = {$row['food_id']}";
  }
  // echo $qry.'\n';
  $res = mysqli_fetch_array(mysqli_query($conn,$qry));
echo "<tr>";
echo "<td>" . $row['order_id']."</td>";
echo '<td><a href=images/'. $res[$lt.'_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $res[$lt.'_photo']. ' width="80" height="70"></a></td>';
echo "<td>" . $res[$lt.'_name']."</td>";
echo "<td>" . ($lt == 'food'? $res['category_name'] : 'Special Deals')."</td>";
echo "<td>" . $res[$lt.'_price']. "" . $symbol['currency_symbol']."</td>";
echo "<td>" . $row['quantity_value']."</td>";
echo "<td>" . $row['total']. "" . $symbol['currency_symbol']."</td>";
echo "<td>" . $row['delivery_date']."</td>";
echo '<td><a href="delete-order.php?id=' . $row['order_id'] . '">Hủy đơn hàng</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
mysqli_close($conn);
?>
</table>
</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>
