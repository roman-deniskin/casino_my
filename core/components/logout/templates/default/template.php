<div class="header_logout_wrapper">
	<form class="logout_form" name="logout" action="#" method="post">
		<input type="hidden" value="logout" name="action">
		<?if(core\auth\auth::authCheck()):?>
			<input type="submit" class="header_logout_btn" value="Выйти">
		<?else:?>
			<a class="header_logout_btn login" href="/">Войти</a>
		<?endif;?>
	</form>
</div>