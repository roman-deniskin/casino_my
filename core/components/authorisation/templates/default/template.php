<?if(!core\auth\auth::authCheck()):?>
	<div class="index_form_wrapper clearfix">
	<div class="auth_form_wrapper">
		<div class="form_title">Авторизация:</div>
		<form class="auth_form" name="auth" action="#" method="post">
			<input type="hidden" value="auth" name="type">
			<div class="index_form_string">
				<input class="index_form_input" type="text"  name="login" placeholder="Login:" required>
			</div>
			<div class="index_form_string">
				<input class="index_form_input" type="text"  name="pass" placeholder="Password:" required>
			</div>
			<div class="index_form_string">
				<input class="index_form_submit auth" type="submit" value="Login">
			</div>
		</form>
	</div>
	<div class="auth_form_wrapper">
		<div class="form_title">Регистрация:</div>
		<form class="auth_form" name="reg" action="#" method="post">
			<input type="hidden" value="reg" name="type">
			<div class="index_form_string">
				<input class="index_form_input" type="text"  name="name" placeholder="Name:" required>
			</div>
			<div class="index_form_string">
				<input class="index_form_input" type="text"  name="login" placeholder="Login:" required>
			</div>
			<div class="index_form_string">
				<input class="index_form_input" type="text"  name="pass1" placeholder="Password:" required>
			</div>
			<div class="index_form_string">
				<input class="index_form_input" type="text"  name="pass2" placeholder="Confirm password:" required>
			</div>
			<div class="index_form_string">
				<input class="index_form_submit reg" type="submit" value="Register">
			</div>
		</form>
	</div>
</div>
<?else:?>
	<div class="authorisation_message">Вы уже авторизованы. Перейдите в кабинет для розыгрыша приза.</div>
<?endif;?>