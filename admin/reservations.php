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
	
	
//selecting all records from the reservations_details table based on table ids. Return an error if there are no records in the table
$tables=mysqli_query($conn,"SELECT members.firstname, members.lastname, reservations_details.ReservationID, reservations_details.table_id, reservations_details.Reserve_Date, reservations_details.Reserve_Time, tables.table_id, tables.table_name FROM members, reservations_details, tables WHERE members.member_id = reservations_details.member_id AND tables.table_id=reservations_details.table_id")
or die("There are no records to display ... \n" . mysqli_error()); 

//selecting all records from the reservations_details table based on partyhall ids. Return an error if there are no records in the table
$partyhalls=mysqli_query($conn,"SELECT members.firstname, members.lastname, reservations_details.ReservationID, reservations_details.partyhall_id, reservations_details.Reserve_Date, reservations_details.Reserve_Time, partyhalls.partyhall_id, partyhalls.partyhall_name FROM members, reservations_details, partyhalls WHERE members.member_id = reservations_details.member_id AND partyhalls.partyhall_id=reservations_details.partyhall_id")
or die("There are no records to display ... \n" . mysqli_error()); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Đặt phòng</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Quản lý đặt trước </h1>
<!-- <a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="reservations.php">Reservations</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a> -->
<a href="index.php">Trang chủ</a> | <a href="categories.php">Danh mục</a> | <a href="foods.php">Thực phẩm</a> | <a href="accounts.php">Tài khoản</a> | <a href="orders.php">Đơn hàng</a> | <a href="reservations.php">Đặt trước</a> | <a href="specials.php">Đặc biệt</a> | <a href="allocation.php">Nhân viên</a> | <a href="messages.php">Tin nhắn</a> | <a href="options.php">Tùy chọn</a> | <a href="logout.php">Đăng xuất</a>

</div>
<div id="container">
<table border="0" width="900" align="center">
<CAPTION><h3>Bàn đặt chỗ</h3></CAPTION>
<tr>
<th>ID đặt bàn</th>
<th>Họ</th>
<th>Tên</th>
<th>Tên bàn</th>
<th>Ngày đặt</th>
<th>Giờ đặt</th>
<th>Hành động</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($tables)){
echo "<tr>";
echo "<td>" . $row['ReservationID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['table_name']."</td>";
echo "<td>" . $row['Reserve_Date']."</td>";
echo "<td>" . $row['Reserve_Time']."</td>";
echo '<td><a href="delete-reservation.php?id=' . $row['ReservationID'] . '">Xóa đặt chỗ</a></td>';
echo "</tr>";
}
mysqli_free_result($tables);
//mysqli_close($conn);
?>
</table>
<hr>
<table border="0" width="900" align="center">
<CAPTION><h3>Phòng riêng đặt chỗ</h3></CAPTION>
<tr>
<th>ID đặt phòng</th>
<th>Họ</th>
<th>Tên</th>
<th>Tên phòng</th>
<th>Ngày đặt</th>
<th>Giờ đặt</th>
<th>Hành động</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($partyhalls)){
echo "<tr>";
echo "<td>" . $row['ReservationID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['partyhall_name']."</td>";
echo "<td>" . $row['Reserve_Date']."</td>";
echo "<td>" . $row['Reserve_Time']."</td>";
echo '<td><a href="delete-reservation.php?id=' . $row['ReservationID'] . '">Xóa đặt phòng</a></td>';
echo "</tr>";
}
mysqli_free_result($partyhalls);
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