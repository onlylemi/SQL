<div class="am-topbar-brand">
	<strong>NUC</strong> <small>中北大学 学生学籍管理系统</small>
</div>
<button
	class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
	data-am-collapse="{target: '#topbar-collapse'}">
	<span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span>
</button>
<div class="am-collapse am-topbar-collapse" id="topbar-collapse">
	<ul
		class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
		<li class="am-dropdown" data-am-dropdown><a class="am-dropdown-toggle"
			data-am-dropdown-toggle href="javascript:;"> <span
				class="am-icon-users"></span> <?php echo $username?> <span
				class="am-icon-caret-down"></span>
		</a>
			<ul class="am-dropdown-content">
			<?php
			switch ($user_type) {
				case 0 :
					$href = "?r=tedit&tno={$users['tno']}";
					break;
				case 1 :
					$href = "?r=stuedit&sno={$users['sno']}";
					break;
			}
			?>
				<li><a href="<?php echo $href?>"><span class="am-icon-user"></span>
						资料</a></li>
				<li><a href="?r=outlogin"><span class="am-icon-power-off"></span> 退出</a></li>
			</ul></li>
	</ul>
</div>
