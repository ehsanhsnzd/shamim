<ul class="menu_members">
	<li class="first"><a href="#" class="lbox">{WORD_LOGIN}</a></li>
	<li><a href='{SITE_ROOT}members/signup.php'>{WORD_SIGNUP}</a></li>
	{if seller}
		<li><a href='{SITE_ROOT}members/signup.php?utype=seller&step=1'>{WORD_SIGNUP_SELLER}</a></li>
	{/if}
	{if affiliate}
		<li><a href='{SITE_ROOT}members/signup.php?utype=affiliate&step=1'>{WORD_SIGNUP_AFFILIATE}</a></li>
	{/if}
</ul>

<div style='display:none'>
	<div id='login_box'>
		
		<div id="lightbox_header">
			{lang.Login}
		</div>

		<div id="lightbox_content">
				<div id='login_box_social'>
					<b>{lang.Login without signup}:</b><br>
					{SOCIAL_NETWORKS}
				</div>
				<div id='login_box_content'>
					<form method='post' action='{SITE_ROOT}members/check.php' style='margin:0px'>
						<input class='ibox' type='text' name='l' style='width:100px;' placeholder="{lang.Login}">
						<input class='ibox' type='password' name='p' style='width:100px;' placeholder="{lang.Password}">
						<input type='submit' value='{lang.Enter}' class="lightbox_button">
					</form>
					<a href='{SITE_ROOT}members/forgot.php'>{lang.Forgot password}</a>	
				</div>
		</div>
		
	</div>
</div>


