<?php
	require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Profile</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Hồ sơ</h1>
<a href="index.php">Trang chủ</a> | <a href="categories.php">Danh mục</a> | <a href="foods.php">Thực phẩm</a> | <a href="accounts.php">Tài khoản</a> | <a href="orders.php">Đơn hàng</a> | <a href="reservations.php">Đặt trước</a> | <a href="specials.php">Đặc biệt</a> | <a href="allocation.php">Nhân viên</a> | <a href="messages.php">Tin nhắn</a> | <a href="options.php">Tùy chọn</a> | <a href="logout.php">Đăng xuất</a>
</div>
<div id="container">
<table align="center">
<tr>
<form id="updateForm" name="updateForm" method="post" action="update-exec.php?id=<?php echo $_SESSION['SESS_ADMIN_ID'];?>" onsubmit="return updateValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0">
  <CAPTION><h3>Thay đổi mật khẩu quản trị</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
	</tr>
    <tr>
      <th width="124">Mật khẩu hiện tại</th>
      <td width="168"><font color="#FF0000">* </font><input name="opassword" type="password" class="textfield" id="opassword" /></td>
    </tr>
    <tr>
      <th>Mật khẩu mới</th>
      <td><font color="#FF0000">* </font><input name="npassword" type="password" class="textfield" id="npassword" /></td>
    </tr>
    <tr>
      <th>Xác nhận mật khẩu mới </th>
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
<form id="staffForm" name="staffForm" method="post" action="staff-exec.php" onsubmit="return staffValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <CAPTION><h3>Thêm nhân viên</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
	</tr>
    <tr>
      <th>Họ</th>
      <td><font color="#FF0000">* </font><input name="fName" type="text" class="textfield" id="fName" /></td>
    </tr>
	<tr>
      <th>Tên </th>
      <td><font color="#FF0000">* </font><input name="lName" type="text" class="textfield" id="lName" /></td>
    </tr>
	 <tr>
      <th>Địa chỉ </th>
      <td><font color="#FF0000">* </font><input name="sAddress" type="text" class="textfield" id="sAddress" /></td>
    </tr>
    <tr>
      <th>Số điện thoại </th>
      <td><font color="#FF0000">* </font><input name="mobile" type="text" class="textfield" id="mobile" /></td>
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
<hr>
</div>
<?php
  include 'footer.php';
?>
</div>
</body>
</html>
