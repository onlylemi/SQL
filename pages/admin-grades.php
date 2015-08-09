<?php
require 'inc/conn.php';
require 'inc/checklogin.php';
include 'inc/page.class.php';

if ($user_type == 0) {
	echo "<script>history.back()</script>";
}

// 查询 成绩 信息
$query = "SELECT * FROM grade WHERE sno='{$users['sno']}'";
$result = mysql_query ( $query );

// 搜索查询
$search = $_POST ['search'];
$searchkeys = $_POST ['searchkeys'];
$query = "SELECT * FROM grade WHERE sno='{$users['sno']}' AND cno=ANY(SELECT cno FROM course WHERE cname LIKE '%{$searchkeys}%')";

?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>学生成绩 - 学生学籍管理系统</title>
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
					<strong class="am-text-primary am-text-lg">成绩 列表</strong>
				</div>
			</div>

			<div class="am-g">
				<div class="am-u-md-6 am-cf">
					<div class="am-fl am-cf">
						<div class="am-btn-toolbar am-fl">
							<div class="am-btn-group am-btn-group-xs"></div>
						</div>
					</div>
				</div>
				<div class="am-u-md-3 am-cf">
					<div class="am-fr">
						<form method="post" action="" enctype="multipart/form-data">
							<div class="am-input-group am-input-group-sm">
								<input type="text" class="am-form-field" name="searchkeys"
									placeholder="请输入课程名中的关键字" value=""> <span
									class="am-input-group-btn">
									<button class="am-btn am-btn-default" type="submit"
										name="search">搜索</button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="am-g">
				<div class="am-u-sm-12">
					<div class="am-form">
						<table class="am-table am-table-striped am-table-hover table-main">
							<thead>
								<tr>
									<th class="table-id"></th>
									<th>课程号</th>
									<th>课程名</th>
									<th>老师</th>
									<th>学分</th>
									<th>成绩</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$bignum = 10;
							$da_num = mysql_num_rows ( $result );
							$page = new Page ( $da_num, $bignum );
							$query .= " {$page->limit}";
							$result = mysql_query ( $query ) or die ( '分页出错:' . mysql_error () );
							
							while ( $stu_grade = mysql_fetch_array ( $result ) ) {
								
								$courses = mysql_fetch_array ( mysql_query ( "SELECT * FROM course WHERE cno='{$stu_grade['cno']}'" ) );
								$tnames = mysql_fetch_array ( mysql_query ( "SELECT tname FROM teacher WHERE tno='{$courses['tno']}'" ) );
								?>
								<tr>
									<td></td>
									<td><?php echo $stu_grade['cno']?></td>
									<td><?php echo $courses['cname']?></td>
									<td><?php echo $tnames['tname']?></td>
									<td><?php echo $courses['score']?></td>
									<td><?php echo $stu_grade['grade']?></td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<div class="am-cf">
							<?php echo $page->getMessage()?>
							<div class="am-fr">
								<ul class="am-pagination">
									<li><a href="<?php echo $page->startPage()?>">首页</a></li>
									<li><a href="<?php echo $page->prevPage()?>">«</a></li>
									<li><a href="<?php echo $page->nextPage()?>">»</a></li>
									<li><a href="<?php echo $page->endPage()?>">尾页</a></li>
								</ul>
							</div>
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
