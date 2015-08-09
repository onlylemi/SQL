<div class="admin-sidebar">
	<ul class="am-list admin-sidebar-list">
		<li><a href="?r=index"><span class="am-icon-home"></span> 首页 </a></li>
		<?php
		switch ($user_type) {
			case 0 :
				$href = "?r=tedit&tno={$users['tno']}";
				$guanli = "管理";
				break;
			case 1 :
				$href = "?r=stuedit&sno={$users['sno']}";
				break;
		}
		?>
		<li><a href='<?php echo $href?>'><span class="am-icon-pencil-square-o"></span>
				个人信息 </a></li>
		<?php
		if ($user_type == 1) {
			?>
			<li><a href="?r=grades"><span class="am-icon-table"></span> 成绩<?php echo $guanli?> </a>
		</li>
		<?php }?>
		<li><a href="?r=stus"><span class="am-icon-table"></span> 学生<?php echo $guanli?> </a></li>
	</ul>

</div>