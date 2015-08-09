<?php
require 'inc/conn.php';
require 'inc/checklogin.php';
include 'inc/page.class.php';

$delete = $_GET ['delete'];
if ($delete != "") {
	mysql_query ( "DELETE FROM student WHERE sno='$delete'" );
	echo "<script>alert('学号 $delete 学生已成功删除！');location.href='?r=stus'</script>";
}

// 查询 学生 信息
$query = "SELECT * FROM student";

// 排名
$grade = $_GET ['grade'];
if ($grade == 1 && $user_type == 0) {
	$stu_teacher = mysql_fetch_array ( mysql_query ( "SELECT cno,cname FROM course WHERE tno='{$users['tno']}'" ) );
	
	$query = "SELECT student.sno sno,student.sname sname,student.ssex ssex,student.sage sage,student.sdept sdept,student.status status,grade.grade grade FROM student,grade WHERE student.sno=grade.sno AND grade.cno='{$stu_teacher['cno']}' ORDER BY grade DESC";
}

// 搜索查询
$search = $_POST ['search'];
$searchkeys = $_POST ['searchkeys'];
if ($search != "" && $searchkeys != "") {
	$query = "SELECT * FROM student WHERE sno='$searchkeys' OR sname LIKE '%{$searchkeys}%' ORDER BY id DESC";
}

$result = mysql_query ( $query ) or die ( 'SQL语句有误：' . mysql_error () );
?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>学生管理 - 学生学籍管理系统</title>
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
					<strong class="am-text-primary am-text-lg">所有学生</strong>
				</div>
			</div>

			<div class="am-g">
				<div class="am-u-md-6 am-cf">
					<div class="am-fl am-cf">
						<div class="am-btn-toolbar am-fl">
							<div class="am-btn-group am-btn-group-xs"></div>
							<?php
							if ($user_type == 0) {
								echo "<a href='?r=stunew'><button
										class='am-btn am-btn-default'>新增学生</button></a> ";
								echo "<a href='?r=stus&grade=1'><button
										class='am-btn am-btn-default'>排名</button></a> ";
							}
							?>
						</div>
					</div>
				</div>
				<div class="am-u-md-3 am-cf">
					<div class="am-fr">
						<form method="post" action="" enctype="multipart/form-data">
							<div class="am-input-group am-input-group-sm">
								<input type="text" class="am-form-field" name="searchkeys"
									placeholder="请输入学号 / 姓名" value=""> <span
									class="am-input-group-btn">
									<button class="am-btn am-btn-default" type="submit"
										name="search" value="yes">搜索</button>
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
									<th>学号</th>
									<th>姓名</th>
									<th>性别</th>
									<th>年龄</th>
									<th>系别</th>
									<th>状况</th>
									<?php
									if ($user_type == 0) {
										echo "<th>成绩</th>";
									}
									?>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$bignum = 20;
							$da_num = mysql_num_rows ( $result );
							$page = new Page ( $da_num, $bignum );
							$query .= " {$page->limit}";
							$result = mysql_query ( $query ) or die ( '分页出错:' . mysql_error () );
							
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
									<?php
								if ($user_type == 0) {
									$stu_tea = mysql_fetch_array ( mysql_query ( "SELECT cno,cname FROM course WHERE tno='{$users['tno']}'" ) );
									$stu_grade = mysql_fetch_array ( mysql_query ( "SELECT * FROM grade WHERE sno='{$stus['sno']}' AND cno='{$stu_tea['cno']}'" ) );
									echo "<td>{$stu_grade['grade']}</td>";
									
									?>
									<td><a href="?r=stuedit&sno=<?php echo $stus['sno']?>"
										class="am-btn-xs"><i class="am-icon-pencil-square-o"></i>编辑</a>
										<a class="am-btn am-btn-xs"> </a> <a
										href="?r=stus&delete=<?php echo $stus['sno']?>"
										onClick="return confirm('操作警告：\n\n请注意，删除后无法恢复，请谨慎操作\n\n您确定要删除吗？') "
										class="am-btn-xs am-text-danger"> <i class="am-icon-trash-o"></i>删除
									</a></td>
									<?php }?>
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
