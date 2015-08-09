<?php
ob_start ();
require 'inc/conn.php';

$login = $_POST ['login'];
$admin_no = $_POST ['admin_no'];
$password = $_POST ['password'];

if ($login != "") {
	
	$admin_type = 0;
	$query = "SELECT password FROM teacher WHERE tno='$admin_no'";
	$result = mysql_query ( $query ) or die ( 'SQL语句有误：' . mysql_error () );
	if (! mysql_num_rows ( $result )) {
		$query = "SELECT * FROM student";
		$result = mysql_query ( $query ) or die ( 'SQL语句有误：' . mysql_error () );
		$admin_type = 1;
	}
	$users = mysql_fetch_array ( $result );
	
	if (! mysql_num_rows ( $result )) {
		echo "<Script language=JavaScript>alert('抱歉，用户名或者密码错误。');history.back();</Script>";
		exit ();
	} else {
		$passwords = $users ['password'];
		if (md5 ( $password ) != $passwords) {
			echo "<Script language=JavaScript>alert('抱歉，用户名或者密码错误。');history.back();</Script>";
			exit ();
		}
		setcookie ( 'user_type', $admin_type, 0, '/' );
		setcookie ( 'user', $admin_no, 0, '/' );
		echo "<script>this.location='?r=index'</script>";
		exit ();
	}
	exit ();
}
ob_end_flush ();
?>

<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title>登录 - 学生学籍管理系统</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="telephone=no">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="alternate icon" type="image/png" href="assets/i/favicon.png">
<link rel="stylesheet" href="assets/css/amazeui.min.css" />
<style>
.header {
	text-align: center;
}

.header h1 {
	font-size: 200%;
	color: #333;
	margin-top: 30px;
}

.header p {
	font-size: 14px;
}
</style>
</head>
<body>
	<div class="header">
		<hr />
	</div>
	<div class="am-g">
		<div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
			<h1>中北大学 - 学生学籍管理系统</h1>
			<hr>
			<div class="am-btn-group"></div>
			<br> <br>

			<form method="post" action="" enctype="multipart/form-data"
				class="am-form">
				<label for="email">教师号 / 学号:</label> <input type="text"
					name="admin_no" id="admin" value="" placeholder="请输入教师号 / 学号"> <br>
				<label for="password">密码:</label> <input type="password"
					name="password" id="password" value="" placeholder="请输入密码"> <br> <label
					for="remember-me"></label> <br />
				<div class="am-cf">
					<input type="submit" name="login" value="登 录"
						class="am-btn am-btn-primary am-btn-sm am-fr">
				</div>
			</form>
			<hr>
		</div>
	</div>
</body>
</html>