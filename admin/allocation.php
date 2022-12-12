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
	

    //selecting all records from the staff table. Return an error if there are no records in the tables
    $staff=mysqli_query($conn,"SELECT * FROM staff")
    or die("There are no records to display ... \n" . mysqli_error()); 
?>
<?php
    //get order ids from the orders_details table based on flag=0
    $flag_0 = 0;
    $orders=mysqli_query($conn,"SELECT * FROM orders_details WHERE flag='$flag_0'")
    or die("There are no records to display ... \n" . mysqli_error()); 
?>
<?php
    //get reservation ids from the reservations_details table based on flag=0
    $flag_0 = 0;
    $reservations=mysqli_query($conn,"SELECT * FROM reservations_details WHERE flag='$flag_0'")
    or die("There are no records to display ... \n" . mysqli_error()); 
?>
<?php
    //selecting all records from the staff table. Return an error if there are no records in the tables
    $staff_1=mysqli_query($conn,"SELECT * FROM staff")
    or die("There are no records to display ... \n" . mysqli_error());
?>
<?php
    //selecting all records from the staff table. Return an error if there are no records in the tables
    $staff_2=mysqli_query($conn,"SELECT * FROM staff")
    or die("There are no records to display ... \n" . mysqli_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Staff</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Phân bổ nhân viên</h1>
<!-- <a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="reservations.php">Reservations</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a> -->
<a href="index.php">Trang chủ</a> | <a href="categories.php">Danh mục</a> | <a href="foods.php">Thực phẩm</a> | <a href="accounts.php">Tài khoản</a> | <a href="orders.php">Đơn hàng</a> | <a href="reservations.php">Đặt trước</a> | <a href="specials.php">Đặc biệt</a> | <a href="allocation.php">Nhân viên</a> | <a href="messages.php">Tin nhắn</a> | <a href="options.php">Tùy chọn</a> | <a href="logout.php">Đăng xuất</a>

</div>
<div id="container">
<table border="0" width="600" align="center">
<CAPTION><h3>Danh sách nhân viên</h3></CAPTION>
<tr>
<th>ID nhân viên</th>
<th>Họ</th>
<th>Tên</th>
<th>Địa chỉ</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($staff)){
echo "<tr>";
echo "<td>" . $row['StaffID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['Street_Address']."</td>";
echo '<td><a href="delete-staff.php?id=' . $row['StaffID'] . '">Remove Staff</a></td>';
echo "</tr>";
}
mysqli_free_result($staff);
mysqli_close($conn);
?>
</table>
<hr>
<table align="center">
<tr>
<form id="ordersAllocationForm" name="ordersAllocationForm" method="post" action="orders-allocation.php" onsubmit="return ordersAllocationValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0">
  <CAPTION><h3>Phân phối đơn hàng</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
	</tr>
    <tr>
      <th width="124">ID đơn đặt hàng</th>
      <td width="168"><font color="#FF0000">* </font><select name="orderid" id="orderid">
        <option value="select">- Chọn một tùy chọn-
        <?php 
        //loop through orders_details table rows
        while ($row=mysqli_fetch_array($orders)){
        echo "<option value=$row[order_id]>$row[order_id]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <th>ID nhân viên</th>
      <td><font color="#FF0000">* </font><select name="staffid" id="staffid">
        <option value="select">- chọn một tùy chọn -
        <?php 
        //loop through staff table rows
        while ($row=mysqli_fetch_array($staff_1)){
        echo "<option value=$row[StaffID]>$row[StaffID]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Phân bố nhân viên" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form id="reservationsAllocationForm" name="reservationsAllocationForm" method="post" action="reservations-allocation.php" onsubmit="return reservationsAllocationValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <CAPTION><h3>Phân phối đặt chỗ</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
	</tr>
    <tr>
      <th>ID đặt chỗ </th>
      <td><font color="#FF0000">* </font><select name="reservationid" id="reservationid">
        <option value="select">- chọn một tùy chọn -
        <?php 
        //loop through reservations_details table rows
        while ($row=mysqli_fetch_array($reservations)){
        echo "<option value=$row[ReservationID]>$row[ReservationID]"; 
        }
        ?>
        </select></td>
    </tr>
	<tr>
      <th>ID nhân viên</th>
      <td><font color="#FF0000">* </font><select name="staffid" id="staffid">
        <option value="select">- chọn một tùy chọn -
        <?php 
        //loop through staff table rows
        while ($row=mysqli_fetch_array($staff_2)){
        echo "<option value=$row[StaffID]>$row[StaffID]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="phân bố" /></td>
    </tr>
  </table>
</td>
</form>
</tr>
</table>
<p>&nbsp;</p>
<hr>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>