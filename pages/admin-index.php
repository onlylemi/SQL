<?php
require 'inc/conn.php';
require 'inc/checklogin.php';

$query = "SELECT * FROM student ORDER BY id DESC LIMIT 15";
$result = mysql_query ( $query ) or die ( 'SQL语句有误：' . mysql_error () );

?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>首页- 学生学籍管理系统</title>
<link rel="icon" type="image/png" href="assets/i/favicon.png">
<link rel="stylesheet" href="assets/css/amazeui.min.css" />
<link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
	<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

	<!-- header start -->
	<header class="am-topbar admin-header">
		<?php require 'template/header.php';?>
	</header>
	<!-- header end -->

	<div class="am-cf admin-main">
		<!-- sidebar start -->
		<?php require 'template/sidebar.php';?>
		<!-- sidebar end -->

		<!-- content start -->
		<div class="admin-content">

			<div class="am-cf am-padding">
				<div class="am-fl am-cf">
					<strong class="am-text-primary am-text-lg">首页</strong>
				</div>
			</div>
			<ul
				class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
				<?php 
				$result_t = mysql_query("SELECT tno FROM teacher");
				$result_c = mysql_query("SELECT cno FROM course");
				?>
				<li><a href="" class="am-text-success"><span></span><br />老师<br /><?php echo mysql_num_rows($result_t)?></a></li>
				<li><a href="" class="am-text-warning"><span></span><br />课程<br /><?php echo mysql_num_rows($result_t)?></a></li>
				<li><a href="?r=stus" class="am-text-secondary"><span></span><br />学生<br /><?php echo mysql_num_rows ( $result )?></a></li>
			</ul>

			<div class="am-g">
				<div class="am-u-sm-12">
					<div class="am-form">
						<table class="am-table am-table-striped am-table-hover table-main">
							<thead>
								<tr>
									<th class="table-id"></th>
									<th>学号</th>
									<th>姓名</th>
									<th>性别</th>
									<th>年龄</th>
									<th>系别</th>
									<th>状况</th>
								</tr>
							</thead>
							<tbody>
							<?php
							while ( $stus = mysql_fetch_array ( $result ) ) {
								?>
								<tr>
									<td></td>
									<td><?php echo $stus['sno']?></td>
									<td><a href="#"><?php echo $stus['sname']?></a></td>
									<td><span class="am-badge am-badge-success"><?php echo $stus['ssex']?></span></td>
									<td><?php echo $stus['sage']?></td>
									<td><?php echo $stus['sdept']?></td>
									<td><?php echo $stus['status']?></td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<div class="am-cf">
							<?php echo "最新 ".mysql_num_rows($result)." 条记录"?>
						</div>
						<hr />
					</div>
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
