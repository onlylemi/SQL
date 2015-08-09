<?php
require 'inc/conn.php';
require 'inc/checklogin.php';

if ($user_type == 1) {
	echo "<script>history.back()</script>";
}

/* 新增学生 信息 */
$submit = $_POST ['submit'];
$stu_no = $_POST ['stu-no'];
$stu_name = $_POST ['stu-name'];
$stu_age = $_POST ['stu-age'];
$stu_sex = $_POST ['stu-sex'];
$stu_dept = $_POST ['stu-dept'];
$stu_word = $_POST ['stu-word'];
if ($submit != "") {
	if ($stu_no == "") {
		echo "<script>alert('请输入 学号！');history.back()</script>";
		exit ();
	}
	
	if ($stu_name == "") {
		echo "<script>alert('请输入 姓名！');history.back()</script>";
		exit ();
	}
	if ($stu_age == "") {
		echo "<script>alert('请输入 年龄！');history.back()</script>";
		exit ();
	}
	if ($stu_sex == "") {
		echo "<script>alert('请输入 性别！');history.back()</script>";
		exit ();
	}
	if ($stu_dept == "") {
		echo "<script>alert('请输入 系别！');history.back()</script>";
		exit ();
	}
	
	$query1 = "INSERT INTO student(sno,sname,ssex,sage,sdept,password) VALUES('$stu_no','$stu_name','$stu_sex','$stu_age','$stu_dept',md5($stu_word))";
	mysql_query ( $query1 );
	echo "<script>alert('已添加！');location.href='?r=stus'</script>";
	exit ();
}

?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>新增学生 - 中北大学宿舍管理系统</title>
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
					<strong class="am-text-primary am-text-lg"><?php echo $dor_name['db_name']?> 新增学生</strong>
				</div>
			</div>

			<hr />
			<div class="am-g">
				<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8"></div>
				<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
					<form class="am-form am-form-horizontal" role="form" method="post"
						action="" enctype="multipart/form-data">
						<div class="am-form-group">
							<label for="stu-no" class="am-u-sm-3 am-form-label">学号</label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-no" placeholder="学号" value="">
							</div>
						</div>

						<div class="am-form-group">
							<label for="stu-name" class="am-u-sm-3 am-form-label">姓名</label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-name" placeholder="输入你的姓名" value="">
							</div>
						</div>

						<div class="am-form-group">
							<label for="stu-age" class="am-u-sm-3 am-form-label">年龄</label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-age" placeholder="输入你的年龄" value="">
							</div>
						</div>

						<div class="am-form-group">
							<label for="stu-sex" class="am-u-sm-3 am-form-label">性别</label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-sex" placeholder="性别" value="">
							</div>
						</div>

						<div class="am-form-group">
							<label for="stu-dept" class="am-u-sm-3 am-form-label">系别</label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-dept" placeholder="请输入你的系别"
									value="">
							</div>
						</div>

						<div class="am-form-group">
							<label for="stu-word" class="am-u-sm-3 am-form-label">登录密码</label>
							<div class="am-u-sm-9">
								<input type="password" name="stu-word"
									placeholder="若修改密码，请直接输入新密码。否则，无需填写该项！" value="">
							</div>
						</div>

						<div class="am-form-group">
							<div class="am-u-sm-9 am-u-sm-push-3">
								<button type="submit" name="submit" value="yes"
									class="am-btn am-btn-primary">确认 添加</button>
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
