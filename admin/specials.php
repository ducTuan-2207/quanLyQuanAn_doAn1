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
	
	
//retrive promotions from the specials table
$result=mysqli_query($conn,"SELECT * FROM specials")
or die("There are no records to display ... \n" . mysqli_error()); 
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Đặc biệt</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Quản lý khuyến mãi đặc biệt </h1>
<!-- <a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="reservations.php">Reservations</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a> -->
<a href="index.php">Trang chủ</a> | <a href="categories.php">Danh mục</a> | <a href="foods.php">Thực phẩm</a> | <a href="accounts.php">Tài khoản</a> | <a href="orders.php">Đơn hàng</a> | <a href="reservations.php">Đặt trước</a> | <a href="specials.php">Đặc biệt</a> | <a href="allocation.php">Nhân viên</a> | <a href="messages.php">Tin nhắn</a> | <a href="options.php">Tùy chọn</a> | <a href="logout.php">Đăng xuất</a>

</div>
<div id="container">
<table width="850" align="center">
<CAPTION><h3>Quản lý khuyến mãi</h3></CAPTION>
<form name="specialsForm" id="specialsForm" action="specials-exec.php" method="post" enctype="multipart/form-data" onsubmit="return specialsValidate(this)">
<tr>
    <th>Tên</th>
    <th>Mô tả</th>
    <th>Giá</th>
    <th>Ngày bắt đầu</th>
    <th>Ngày kết thúc</th>
    <th>ảnh</th>
    <th>Hành động</th>
</tr>
<tr>
    <td><input type="text" name="name" id="name" class="textfield" /></td>
    <td><textarea name="description" id="description" class="textfield" rows="2" cols="15"></textarea></td>
    <td><input type="text" name="price" id="price" class="textfield" /></td>
    <td><input type="date" name="start_date" id="start_date" class="textfield" /></td>
    <td><input type="date" name="end_date" id="end_date" class="textfield" /></td>
    <td><input type="file" name="photo" id="photo"/></td>
    <td><input type="submit" name="Submit" value="thêm" /></td>
</tr>
</form>
</table>
<hr>
<table width="950" align="center">
<CAPTION><h3>Danh sách khuyến mãi</h3></CAPTION>
<tr>
<th>Ảnh khuyến mãi</th>
<th>Tên khuyến mãi</th>
<th>Mô tả khuyến mãi</th>
<th>Giá khuyến mãi</th>
<th>Ngày bắt đầu</th>
<th>Ngày kết thúc</th>
<th>Hành động</th>
</tr>

<?php
//loop through all table rows
$symbol=mysqli_fetch_assoc($currencies); //gets active currency
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo '<td><img src=../images/'. $row['special_photo']. ' width="80" height="70"></td>';
echo "<td>" . $row['special_name']."</td>";
echo "<td width='180' align='left'>" . $row['special_description']."</td>";
echo "<td>" . $symbol['currency_symbol']. "" . $row['special_price']."</td>";
echo "<td>" . $row['special_start_date']."</td>";
echo "<td>" . $row['special_end_date']."</td>";
echo '<td><a href="delete-special.php?id=' . $row['special_id'] . '">Xóa khuyến mãi</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
mysqli_close($conn);
?>
</table>
<hr>
</div>
<?php
    include 'footer.php';
?>
</div>
</body>
</html>