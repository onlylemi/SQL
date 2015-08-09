<?php
require 'inc/conn.php';
require 'inc/checklogin.php';

$str = "";
if ($user_type == 1) {
	$str = "true";
	$str = "readonly='$str'";
}

$sno = $_GET ['sno'];
if ($sno == "" || ($user_type == 1 && $sno != $users ['sno'])) {
	echo "<script>history.back()</script>";
}

// 查询学生信息
$query_stu = "SELECT * FROM student WHERE sno='$sno'";
$result_stu = mysql_query ( $query_stu );
$stu = mysql_fetch_array ( $result_stu );

$stu_tea = mysql_fetch_array ( mysql_query ( "SELECT cno,cname FROM course WHERE tno='{$users['tno']}'" ) );

/* 更新 学生 信息 */
$submit = $_POST ['submit'];
$stu_no = $_POST ['stu-no'];
$stu_name = $_POST ['stu-name'];
$stu_age = $_POST ['stu-age'];
$stu_sex = $_POST ['stu-sex'];
$stu_dept = $_POST ['stu-dept'];
$stu_word = $_POST ['stu-word'];
$stu_status = $_POST ['stu-status'];
$stu_course = $_POST ['stu-course'];
$stu_select_course = $_POST ['stu-select-course'];

if ($submit != "") {
	if ($user_type == 1) {
		if ($stu_select_course == "选修") {
			echo "<script>alert('请选择 选修课程！');history.back()</script>";
			exit ();
		}
		$select_course = mysql_query("SELECT * FROM grade WHERE sno='$stu_no' AND cno='$stu_select_course'");
		if (mysql_num_rows($select_course) != 0) {
			echo "<script>alert('该课程 你已选修！');history.back()</script>";
			exit ();
		}
		
		if ($stu_word != "") {
			mysql_query("INSERT INTO grade(sno,cno) VALUES('$stu_no','$stu_select_course')");
			
			mysql_query ( "UPDATE student SET password=md5($stu_word) WHERE sno='$stu_no'" );
			echo "<script>alert('您的信息已成功 更新！');location.href='?r=stuedit&sno=$sno'</script>";
			exit ();
		}
		echo "<script>alert('请输入密码！');history.back()</script>";
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
	if ($stu_status == "") {
		echo "<script>alert('请输入 状态！');history.back()</script>";
		exit ();
	}
	if ($stu_course != "") {
		mysql_query ( "UPDATE grade SET grade='$stu_course' WHERE sno='$stu_no' AND cno='{$stu_tea['cno']}'" );
	}
	
	if ($stu_word != "") {
		$query1 = "UPDATE student SET sname='$stu_name',ssex='$stu_sex',sage='$stu_age',sdept='$stu_dept',status='$stu_status',password=md5($stu_word) WHERE sno='$stu_no'";
	} else {
		$query1 = "UPDATE student SET sname='$stu_name',ssex='$stu_sex',sage='$stu_age',sdept='$stu_dept',,status='$stu_status' WHERE sno='$stu_no'";
	}
	mysql_query ( $query1 );
	echo "<script>alert('信息已更改！');location.href='?r=stuedit&sno=$stu_no'</script>";
	exit ();
}

?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>编辑学生 - 学生学籍管理系统</title>
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
					<strong class="am-text-primary am-text-lg">编辑 学号为<?php echo $sno?> 学生</strong>
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
								<input type="text" name="stu-no" placeholder="学号"
									value="<?php echo $stu['sno']?>" readonly="true">
							</div>
						</div>

						<div class="am-form-group">
							<label for="stu-name" class="am-u-sm-3 am-form-label">姓名</label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-name" placeholder="输入你的姓名"
									value="<?php echo $stu['sname']?>" <?php echo $str?>>
							</div>
						</div>

						<div class="am-form-group">
							<label for="stu-age" class="am-u-sm-3 am-form-label">年龄</label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-age" placeholder="输入你的年龄"
									value="<?php echo $stu['sage']?>" <?php echo $str?>>
							</div>
						</div>

						<div class="am-form-group">
							<label for="stu-sex" class="am-u-sm-3 am-form-label">性别</label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-sex" placeholder="性别"
									value="<?php echo $stu['ssex']?>" <?php echo $str?>>
							</div>
						</div>

						<div class="am-form-group">
							<label for="stu-dept" class="am-u-sm-3 am-form-label">系别</label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-dept" placeholder="请输入你的系别"
									value="<?php echo $stu['sdept']?>" <?php echo $str?>>
							</div>
						</div>

						<div class="am-form-group">
							<label for="stu-status" class="am-u-sm-3 am-form-label">状况</label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-status"
									placeholder="请输入你的状况（在校/留级/休学）"
									value="<?php echo $stu['status']?>" <?php echo $str?>>
							</div>
						</div>
						
						<?php
						if ($user_type == 1) {
							$result_courses = mysql_query ( "SELECT * FROM course " );
							?>
							<div class="am-form-group">
							<label for="stu-select-course" class="am-u-sm-3 am-form-label">选修课程</label>
							<div class="am-u-sm-9">
								<select name="stu-select-course" data-placeholder="请选择 选修课程">
									<option value="选修">请选择 选修课程</option>
										<?php
							while ( $courses = mysql_fetch_array ( $result_courses ) ) {
								?>
								<option value="<?php echo $courses['cno']?>"><?php echo $courses['cname']?></option>
								<?php }?>
								</select>
							</div>
						</div>
						<?php }?>
						
						<?php
						if ($user_type == 0) {
							$stu_grade = mysql_fetch_array ( mysql_query ( "SELECT * FROM grade WHERE sno='$sno' AND cno='{$stu_tea['cno']}'" ) );
							?>
							<div class="am-form-group">
							<label for="stu-course" class="am-u-sm-3 am-form-label"><?php echo $stu_tea['cname']?></label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-course" placeholder="请输入 该课程 成绩"
									value="<?php echo $stu_grade['grade']?>">
							</div>
						</div>
						<?php }?>
						
						<div class="am-form-group">
							<label for="stu-word" class="am-u-sm-3 am-form-label">登录密码</label>
							<div class="am-u-sm-9">
								<input type="text" name="stu-word"
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
