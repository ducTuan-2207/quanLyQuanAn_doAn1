<?php
//checking connection and connecting to a database
require_once('connection/config.php');
error_reporting(1);
//Connect to mysqli server
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
    if(!$conn) {
        die('Failed to connect to server: ' . mysqli_error());
    }
    
  
    
//retrieve questions from the questions table
$questions=mysqli_query($conn,"SELECT * FROM questions")
or die("Something is wrong ... \n" . mysqli_error());
?>
<?php
//setting-up a remember me cookie
    if (isset($_POST['Submit'])){
        //setting up a remember me cookie
        if($_POST['remember']) {
            $year = time() + 31536000;
            setcookie('remember_me', $_POST['login'], $year);
        }
        else if(!$_POST['remember']) {
            if(isset($_COOKIE['remember_me'])) {
                $past = time() - 100;
                setcookie(remember_me, gone, $past);
            }
        }
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo APP_NAME; ?>:Home</title>
<link href="stylesheets/user_styles.css"  rel="stylesheet" type="text/css">

<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <li><a href="index.php">Trang chủ</a></li>
  <li><a href="foodzone.php">Khu ẩm thực</a></li>
  <li><a href="specialdeals.php">Ưu đãi đặc biệt</a></li>
  <li><a href="member-index.php">Tài khoản của tôi</a></li>
  <li><a href="contactus.php">Liên hệ</a></li>
  </ul>
</div>
<div id="header" class="stretchX">
    <div id="logo"> <a href="index.php" class="blockLink"></a></div>
    <div id="company_name">Restaurant nhóm 5</div>
</div>
<div id="center">
  <h1><center>CHÀO MỪNG BẠN ĐẾN VỚI HỆ THỐNG QUẢN LÝ NHÀ HÀNG KHÁCH SẠN  CỦA NHÓM 5!</center></h1>
      <div class="body_text">
      Đặt món ăn của bạn ngay hôm nay từ Khu ẩm thực và nó sẽ được giao đến tận cửa nhà bạn. Tham gia các ưu đãi đặc biệt hàng tuần của chúng tôi trong menu Ưu đãi đặc biệt. Đăng ký tài khoản với chúng tôi để tận hưởng dịch vụ đặt hàng, giao hàng tận nơi nhanh chóng và thanh toán thuận tiện cho món ăn của bạn. Bắt đầu ngay bây giờ bằng cách đăng nhập bên dưới hoặc đăng ký nếu bạn chưa có tài khoản với chúng tôi:
  </div>
<table align="center" width="100%">
    <tr align="center">
        <td style="text-align:center;">
            <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
            <form id="loginForm" name="loginForm" method="post" action="login-exec.php" onsubmit="return loginValidate(this)">
              <table width="290" border="0" align="center" cellpadding="2" cellspacing="0">
                <tr>
                    <td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
                </tr>
                <tr>
                  <td width="112"><b>Email</b></td>
                  <td width="188"><font color="#FF0000">* </font><input name="login" type="text" class="textfield" id="login" /></td>
                </tr>
                <tr>
                  <td><b>Password</b></td>
                  <td><font color="#FF0000">* </font><input name="password" type="password" class="textfield" id="password" /></td>
                </tr>
                <tr>
                      <td><input name="remember" type="checkbox" class="" id="remember" value="1" onselect="cookie()" <?php if(isset($_COOKIE['remember_me'])) {
                        echo 'checked="checked"';
                    }
                    else {
                        echo '';
                    }
                    ?>/>Nhớ tài khoản</td>
                      <td><a href="JavaScript: resetPassword()">Quên mật khẩu?</a></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="reset" value="Clear Fields"/>
                  <input type="submit" name="Submit" value="Login" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
              </table>
            </form>
            </div>
        </td>
        <hr>
        <td style="text-align:center;">
            <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px;">
            <form id="loginForm" name="loginForm" method="post" action="register-exec.php" onsubmit="return registerValidate(this)">
              <table width="450" border="0" align="center" cellpadding="2" cellspacing="0">
                <tr>
                    <td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
                </tr>
                <tr>
                  <th>Họ </th>
                  <td><font color="#FF0000">* </font><input name="fname" type="text" class="textfield" id="fname" /></td>
                </tr>
                <tr>
                  <th>Tên </th>
                  <td><font color="#FF0000">* </font><input name="lname" type="text" class="textfield" id="lname" /></td>
                </tr>
                <tr>
                  <th width="124">Email</th>
                  <td width="168"><font color="#FF0000">* </font><input name="login" type="text" class="textfield" id="login" /></td>
                </tr>
                <tr>
                  <th>Mật khẩu</th>
                  <td><font color="#FF0000">* </font><input name="password" type="password" class="textfield" id="password" /></td>
                </tr>
                <tr>
                  <th>Xác nhận mật khẩu </th>
                  <td><font color="#FF0000">* </font><input name="cpassword" type="password" class="textfield" id="cpassword" /></td>
                </tr>
                <!-- <tr>
                  <th>Câu hỏi bảo mật</th>
                    <td><font color="#FF0000">* </font><select name="question" id="question">
                    <option value="select">- Chọn câu hỏi -
                    <?php 
                    //loop through quantities table rows
                    while ($row=mysqli_fetch_array($questions)){
                    echo "<option value=$row[question_id]>$row[question_text]"; 
                    }
                    ?>
                    </select></td>
                </tr>
                <tr>
                  <th>Câu trả lời</th>
                  <td><font color="#FF0000">* </font><input name="answer" type="text" class="textfield" id="answer" /></td>
                </tr> -->
                <tr>
                <td colspan="2"><input type="reset" value="Clear Fields"/>
                <input type="submit" name="Submit" value="Đăng ký" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
              </table>
            </form>
            </div>
        </td>
    </tr>
</table>
<hr>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>
