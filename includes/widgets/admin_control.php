<!-- 'display aside when user logged in user settings bar' -->
<style type="text/css">
	.widget_list:hover{
     background-color:#faadd11;
	}
	a{
	    color:#116573;
	}

</style>
<div>

<h2 style="font-weight: 200">hello,<?php echo xss($user_data['first_name']); ?>!</h2>

	<li class="widget_list">
		<a href="logged_out.php">&nbsp;logout</a>
	</li>
	<li class="widget_list">
		<a href="change_password.php">&nbsp;change password</a>
	</li>
	<li class="widget_list">
		<a href="settings.php">&nbsp;Settings</a>
	</li>
	<li class="widget_list">
		<a href="mail_users.php">&nbsp;Announcement</a>
	</li>
	<li class="widget_list">
		<a href="new_post.php">&nbsp;new post</a>
	</li>
	

</div>
