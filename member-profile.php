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
    
    
//get member id from session
$memberId=$_SESSION['SESS_MEMBER_ID'];
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo APP_NAME ?>:My Profile</title>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <<li><a href="index.php">Trang chủ</a></li>
  <li><a href="foodzone.php">Khu ẩm thực</a></li>
  <li><a href="specialdeals.php">Ưu đãi đặc biệt</a></li>
  <li><a href="member-index.php">Tài khoản của tôi</a></li>
  <li><a href="contactus.php">Liên hệ</a></li>
  </ul>
  </div>
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  <div id="company_name"><?php echo APP_NAME ?> Restaurant</div>
</div>
<div id="center">
<h1>My Profile</h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<!-- <a href="member-index.php">Home</a> | <a href="cart.php">Cart[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Inbox[<?php echo $num_messages;?>]</a> | <a href="tables.php">Tables</a> | <a href="partyhalls.php">Party-Halls</a> | <a href="ratings.php">Rate Us</a> | <a href="logout.php">Logout</a> -->
<a href="member-profile.php">Hồ sơ của tôi</a> | <a href="cart.php">Giỏ hàng[<?php echo $num_items;?>]</a> |  <a href="inbox.php">hộp thư[<?php echo $num_messages;?>]</a> | <a href="tables.php">Đặt bàn</a> | <a href="partyhalls.php">Phòng tiệc</a> | <a href="ratings.php">Đánh giá</a> | <a href="logout.php">Đăng xuất</a>

<p>&nbsp;</p>
<p>Tại đây, bạn có thể thay đổi mật khẩu của mình và cũng có thể thêm địa chỉ thanh toán hoặc địa chỉ giao hàng. Địa chỉ giao hàng sẽ được sử dụng để lập hóa đơn cho các đơn đặt hàng thực phẩm của bạn cũng như cung cấp cho chúng tôi thông tin chi tiết về địa điểm giao thực phẩm của bạn. Để biết thêm thông tin <a href="contactus.php">Click Here</a> để liên hệ với chúng tôi.</p>
<hr>
<table width="870">
<tr>
<form id="updateForm" name="updateForm" method="post" action="update-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return updateValidate(this)">
<td>
  <table width="350" align="center" border="0" cellpadding="2" cellspacing="0">
  <CAPTION><h2>Thay đổi mật khẩu</h2></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
	</tr>
    <tr>
      <th width="124">Mật khẩu cũ</th>
      <td width="168"><font color="#FF0000">* </font><input name="opassword" type="password" class="textfield" id="opassword" /></td>
    </tr>
    <tr>
      <th>Mật khẩu mới</th>
      <td><font color="#FF0000">* </font><input name="npassword" type="password" class="textfield" id="npassword" /></td>
    </tr>
    <tr>
      <th>Xác nhận mật khẩu </th>
      <td><font color="#FF0000">* </font><input name="cpassword" type="password" class="textfield" id="cpassword" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Thay đổi" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form id="billingForm" name="billingForm" method="post" action="billing-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return billingValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <CAPTION><h2>Thêm địa chỉ giao hàng/hóa đơn</h2></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
	</tr>
    <tr>
      <th>Địa chỉ đường </th>
      <td><font color="#FF0000">* </font><input name="sAddress" type="text" class="textfield" id="sAddress" /></td>
    </tr>
	<tr>
      <th>Hòm thư bưu điện </th>
      <td><font color="#FF0000">* </font><input name="box" type="text" class="textfield" id="box" /></td>
    </tr>
    <tr>
      <th>Thành phố</th>
      <td><font color="#FF0000">* </font><input name="city" type="text" class="textfield" id="city" /></td>
    </tr>
    <tr>
      <th width="124">Điện thoại di động</th>
      <td width="168"><font color="#FF0000">* </font><input name="mNumber" type="text" class="textfield" id="mNumber" /></td>
    </tr>
    <tr>
      <th>Điện thoại cố dịnh</th>
      <td>&nbsp;&nbsp;&nbsp;<input name="lNumber" type="text" class="textfield" id="lNumber" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Thêm" /></td>
    </tr>
  </table>
</td>
</form>
</tr>
</table>
<p>&nbsp;</p>
</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>