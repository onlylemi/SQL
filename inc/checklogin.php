<?php
$user = $_COOKIE ['user'];
$user_type = $_COOKIE ['user_type'];

if ($user == "") {
	header ( "Location: ?r=login" );
	exit ();
} else {
	// 查到用户的个人信息，以备使用
	switch ($user_type) {
		case 0 :
			$query = "SELECT * FROM teacher WHERE tno='$user'";
			$result = mysql_query ( $query ) or die ( 'SQL语句有误：' . mysql_error () );
			$users = mysql_fetch_array ( $result );
			$username = "教师{$users ['tno']}：" . $users ['tname'];
			break;
		case 1 :
			$query = "SELECT * FROM student WHERE sno='$user'";
			$result = mysql_query ( $query ) or die ( 'SQL语句有误：' . mysql_error () );
			$users = mysql_fetch_array ( $result );
			$username = "学生{$users ['sno']}：" . $users ['sname'];
			break;
		default :
			break;
	}
}