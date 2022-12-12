<?php require_once('connection/config.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo APP_NAME; ?>:Contacts</title>
<script type="text/javascript" src="swf/swfobject.js"></script>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
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

  <h1>Liên hệ với chúng tôi</h1>
  
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
  <table width="500" height="50">
  <tr><td rowspan="11"><img width="400" height="400" src="images/pizza-inn-map4-mombasa-road.png" /></td></tr>
  <tr><td rowspan="">
    <img src="images/uneti.png" alt="" class="uneti_logo"> <p class="nhom_five">Nhóm 5 Đồ án 1</p>
  </td></tr>
  <tr><td><?php echo APP_NAME ?> Restaurant</td></tr>
  <!-- <tr><td>P.O. Box: 45640-00100</td></tr> -->
  <tr><td>255 Lĩnh Nam , Hoàng Mai ,Hà Nội</td></tr><br/>
  <!-- <tr><td>số tài khoản: 19036617438017 ngân hàng Techcombank</td></tr> -->
  <tr><td>Mobile: 0982650467</td></tr>
  <tr><td>Email: tuanhypc02@gmail.com

  </td></tr>
  </table>
  </div>
</div>
<?php include 'footer.php'; ?>
</div>

</body>
</html>
