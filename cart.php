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
    
   
//define default values for flag_0
$flag_0 = 0;
    
//get member_id from session
$member_id = $_SESSION['SESS_MEMBER_ID'];

//selecting particular records from the food_details and cart_details tables. Return an error if there are no records in the tables
$result1=mysqli_query($conn,"SELECT food_name,food_description,food_price,food_photo,cart_id,quantity_value,total,flag,category_name,lt FROM food_details,cart_details,categories,quantities WHERE cart_details.member_id='$member_id' AND cart_details.flag='$flag_0' AND cart_details.food_id=food_details.food_id AND food_details.food_category=categories.category_id AND cart_details.quantity_id=quantities.quantity_id AND cart_details.lt ='food'")
or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
$result = array();
while($row = mysqli_fetch_assoc($result1)){
    $result[]=$row;
}
$result2=mysqli_query($conn,"SELECT * FROM cart_details c inner join specials s on s.special_id = c.food_id inner join quantities q on q.quantity_id = c.quantity_id WHERE c.lt = 'special' and c.member_id ='$member_id' ")
or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours.");
while($row = mysqli_fetch_assoc($result2)){
    $result[]=$row;
}
// var_dump($result);
// exit;
?>
<?php
    if(isset($_POST['Submit'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
global $conn;
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysqli_real_escape_string($conn,$str);
        }
        //get category id
        $id = clean($_POST['category']);
        
        //selecting all records from the food_details table based on category id. Return an error if there are no records in the table
        $result=mysqli_query($conn,"SELECT * FROM food_details WHERE food_category='$id'")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
    }
?>
<?php
    //retrieving quantities from the quantities table
    $quantities=mysqli_query($conn,"SELECT * FROM quantities")
    or die("Something is wrong ... \n" . mysqli_error()); 
?>
<?php
    //retrieving cart ids from the cart_details table
    //define a default value for flag_0
    $flag_0 = 0;
    $items=mysqli_query($conn,"SELECT * FROM cart_details WHERE member_id='$member_id' AND flag='$flag_0'")
    or die("Something is wrong ... \n" . mysqli_error()); 
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysqli_query($conn,"SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo APP_NAME ?>:Shopping Cart</title>
<script type="text/javascript" src="swf/swfobject.js"></script>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
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
 <h1>Giỏ hàng của tôi</h1>
    <hr>
        <h3><a href="foodzone.php">Tiếp tục mua sắm!</a></h3>
            <form name="quantityForm" id="quantityForm" method="post" action="update-quantity.php" onsubmit="return updateQuantity(this)">
                 <table width="560" align="center">
                     <tr>
                        <td>ID mặt hàng</td>
                        <td><select name="item" id="item">
                            <option value="select">- Lựa chọn-
                            <?php 
                            //loop through cart_details table rows
                            while ($row=mysqli_fetch_array($items)){
                            echo "<option value=$row[cart_id]>$row[cart_id]"; 
                            }
                            ?>
                            </select>
                        </td>
                        <td>Số lượng</td>
                        <td><select name="quantity" id="quantity">
                            <option value="select">- Thay đổi -
                            <?php
                            //loop through quantities table rows
                            while ($row=mysqli_fetch_assoc($quantities)){
                            echo "<option value=$row[quantity_id]>$row[quantity_value]"; 
                            }
                            ?>
                            </select>
                        </td>
                        <td><input type="submit" name="Submit" value="Thay đổi số lượng" /></td>
                     </tr>
                 </table>
            </form>
            <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
          <table width="910" height="auto" style="text-align:center;">
            <tr>
                <th>ID mặt hàng</th>
                <th>Ảnh món ăn</th>
                <th>Tên món ăn</th>
                <th>Mô tả món ăn</th>
                <th>Danh mục món ăn</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng chi phí</th>
                <th>Hành động</th>
            </tr>

            <?php
                //loop through all table rows
                $symbol=mysqli_fetch_assoc($currencies); //gets active currency
                foreach ($result as $row){
                    $lt = $row['lt'];
                    echo "<tr>";
                    echo "<td>" . $row['cart_id']."</td>";
                    echo '<td><a href=images/'. $row[$lt.'_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row[$lt.'_photo']. ' width="80" height="70"></a></td>';
                    echo "<td>" . $row[$lt.'_name']."</td>";
                    echo "<td>" . $row[$lt.'_description']."</td>";
                    echo "<td>" . ($lt == 'food'?$row['category_name']:'SPECIAL DEALS')."</td>";
                    echo "<td>" . $symbol['currency_symbol']. "" . $row[$lt.'_price']."</td>";
                    echo "<td>" . $row['quantity_value']."</td>";
                    echo "<td>" . $symbol['currency_symbol']. "" . $row['total']."</td>";
                    /*
                    echo "<form>";
                    echo '<td><select name="quantity" id="quantity" onchange="getQuantity(this.value)">
                    <option value="select">- select quantity -
                    <?php
                    while ($row=mysqli_fetch_assoc($quantities)){
                    echo "<option value=$row[quantity_id]>$row[quantity_value]"; 
                    //$_SESSION[SESS_CART_ID] = $row[cart_id];
                }
                ?>
                </select></td>';
                echo "</form>";
                */
                /*
                echo "<form>";
                    echo "<td><select name='quantity' id='quantity' onclick='getQuantity(this.value)'>
                    <option value='1'>select
                    <option value='2'>1
                    <option value='3'>2
                    <option value='4'>3

                
          
                </select></td>";
                echo "</form>";
                */
                echo '<td><a href="order-exec.php?id=' . $row['cart_id'] . '">Đặt hàng</a></td>';
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