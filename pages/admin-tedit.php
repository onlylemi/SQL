<?php
require 'inc/conn.php';
require 'inc/checklogin.php';

if ($user_type == 1) {
	echo "<script>history.back()</script>";
}

/* 更新 学生 信息 */
$submit = $_POST ['submit'];
$tea_no = $_POST ['tea-no'];
$tea_name = $_POST ['tea-name'];
$tea_sex = $_POST ['tea-sex'];
$tea_word = $_POST ['tea-word'];
if ($submit != "") {
	if ($tea_name == "") {
		echo "<script>alert('请输入 姓名！');history.back()</script>";
		exit ();
	}
	if ($tea_sex == "") {
		echo "<script>alert('请输入 性别！');history.back()</script>";
		exit ();
	}
	
	if ($tea_word != "") {
		$query1 = "UPDATE teacher SET tname='$tea_name',tsex='$tea_sex',password=md5($tea_word) WHERE tno='$tea_no'";
	} else {
		$query1 = "UPDATE teacher SET tname='$tea_name',tsex='$tea_sex' WHERE tno='$tea_no'";
	}
	mysql_query ( $query1 );
	echo "<script>alert('信息已更改！');location.href='?r=tedit&tno=$tea_no'</script>";
	exit ();
}

?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>编辑老师 - 学生学籍管理系统</title>
<link rel="icon" type="image/png" href="assets/i/favicon.png">
<link rel="stylesheet" href="assets/css/amazeui.min.css" />
<link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
	<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

	<header class="am-topbar admin-header">
		<?php require 'template/header.php';?>
	</header>

	<div class="am-cf admin-main">
		<!-- sidebar start -->
		<?php require 'template/sidebar.php';?>
		<!-- sidebar end -->

		<!-- content start -->
		<div class="admin-content">
			<div class="am-cf am-padding">
				<div class="am-fl am-cf">
					<strong class="am-text-primary am-text-lg">编辑 教职工号为<?php echo $users['tno']?> 老师</strong>
				</div>
			</div>

			<hr />
			<div class="am-g">
				<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8"></div>
				<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
					<form class="am-form am-form-horizontal" role="form" method="post"
						action="" enctype="multipart/form-data">
						<div class="am-form-group">
							<label for="tea-no" class="am-u-sm-3 am-form-label">教职工号</label>
							<div class="am-u-sm-9">
								<input type="text" name="tea-no" placeholder="请输入教职工号"
									value="<?php echo $users['tno']?>" readonly="true">
							</div>
						</div>

						<div class="am-form-group">
							<label for="tea-name" class="am-u-sm-3 am-form-label">姓名</label>
							<div class="am-u-sm-9">
								<input type="text" name="tea-name" placeholder="输入你的姓名"
									value="<?php echo $users['tname']?>">
							</div>
						</div>

						<div class="am-form-group">
							<label for="tea-sex" class="am-u-sm-3 am-form-label">性别</label>
							<div class="am-u-sm-9">
								<input type="text" name="tea-sex" placeholder="性别"
									value="<?php echo $users['tsex']?>">
							</div>
						</div>

						<div class="am-form-group">
							<label for="tea-word" class="am-u-sm-3 am-form-label">登录密码</label>
							<div class="am-u-sm-9">
								<input type="password" name="tea-word"
									placeholder="若修改密码，请直接输入新密码。否则，无需填写该项！" value="">
							</div>
						</div>

						<div class="am-form-group">
							<div class="am-u-sm-9 am-u-sm-push-3">
								<button type="submit" name="submit" value="yes"
									class="am-btn am-btn-primary">保存修改</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- content end -->

	</div>

	<!--[if lt IE 9]>
<script src="assets/js/jquery1.11.1.min.js"></script>
<script src="assets/js/modernizr.js"></script>
<script src="assets/js/polyfill/rem.min.js"></script>
<script src="assets/js/polyfill/respond.min.js"></script>
<script src="assets/js/amazeui.legacy.js"></script>
<![endif]-->

	<!--[if (gte IE 9)|!(IE)]><!-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/amazeui.min.js"></script>
	<!--<![endif]-->
	<script src="assets/js/app.js"></script>
</body>
</html>
